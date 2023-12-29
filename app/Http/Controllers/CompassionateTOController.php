<?php

namespace App\Http\Controllers;

use App\Models\AnteMortem;
use App\Models\AttendanceCourt;
use App\Models\CompassionateTO;
use App\Models\DeathAnniversary;
use App\Models\FamilyReunion;
use App\Models\FilialObligation;
use App\Models\StatusCompassionateTO;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;
use League\CommonMark\Node\Block\Document;
use RealRashid\SweetAlert\Facades\Alert;

class CompassionateTOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compassionates = CompassionateTO::where('user_id',auth()->user()->id)->with('user','filialObligation','familyReunion','deathAnniversary','anteMortem','attendanceCourt','statusCompassionateTO')->get();
        return view('compassionateTO.index',compact('compassionates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::FindorFail(auth()->user()->id);

        return view('compassionateTO.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    //  if($this->attachmentCodeExist($number)){
    //     $number = mt_rand(1000000000,9999999999);
    //  }

    function generateNumber($val){
        $number = mt_rand(100000,999999);
        // $number = 765687;
        if ($this->numberExists($number,$val)){
            // dd('Sayop');
            return $this->generateNumber($val);

        }

        return $number;
    }

    function numberExists($number,$val){
        if($val == 'Death Anniversary'){
            return DeathAnniversary::where('death_cert',$number)->exists();
        }
        else if($val == 'Ante-mortem Activities'){
            return AnteMortem::where('doc_cert',$number)->exists();
        }
        else if($val == 'Attendance in court hearings'){
            return AttendanceCourt::where('court_cert',$number)->exists();
        }
    }

    public function store(Request $request)
    {
        try{
            DB::transaction(function ()use($request) {
                $compassionateTO = new CompassionateTO();
                $compassionateTO->user_id = auth()->user()->id;
                $compassionateTO->date1 = $request->date1;
                $compassionateTO->date2 = $request->date2;
                $compassionateTO->date3 = $request->date3;
                $compassionateTO->leave_days = $request->leave_days;
                $compassionateTO->save();

                    if($request->reason == 'Filial Obligations'){
                        $filialObligation = new FilialObligation();
                        $filialObligation->compassionate_t_o_id = $compassionateTO->id;
                        $filialObligation->reason = $request->reason;
                        $filialObligation->name_of_parent = $request->name_of_parent;
                        $filialObligation->name_of_sibling = $request->name_of_sibling;
                        $filialObligation->save();
                    }
                    elseif($request->reason == 'Family Reunion'){
                        $familyReunion = new FamilyReunion();
                        $familyReunion->compassionate_t_o_id = $compassionateTO->id;
                        $familyReunion->reason = $request->reason;
                        $familyReunion->save();
                    }
                    elseif($request->reason == 'Death Anniversary'){
                        // throw new Exception('Something went wrong');
                        $val = 'Death Anniversary';
                        $fn = $this->generateNumber($val);
                        $death_cert = $fn.'.'.$request->death_cert->getClientOriginalExtension();

                        $deathAnniversary = new DeathAnniversary();
                        $deathAnniversary->compassionate_t_o_id = $compassionateTO->id;
                        $deathAnniversary->reason = $request->reason;
                        $deathAnniversary->death_cert = $death_cert;
                        $deathAnniversary->save();

                        $request->death_cert->move('attachment/death_cert',$death_cert); //save file to public


                    }
                    elseif($request->reason == 'Ante-mortem Activities'){

                        $val = 'Ante-mortem Activities';
                        $fn = $this->generateNumber($val);
                        $doc_cert = $fn.'.'.$request->doc_cert->getClientOriginalExtension();


                        $anteMortem = new AnteMortem();
                        $anteMortem->compassionate_t_o_id = $compassionateTO->id;
                        $anteMortem->reason = $request->reason;
                        $anteMortem->immediate_family_member = $request->immediate_family_member;
                        $anteMortem->doc_cert = $doc_cert;
                        $anteMortem->save();

                        $request->doc_cert->move('attachment/hosp_cert',$doc_cert);
                    }
                    elseif($request->reason == 'Attendance in court hearings'){

                        $val = 'Attendance in court hearings';
                        $fn = $this->generateNumber($val);
                        $court_cert = $fn.'.'.$request->court_cert->getClientOriginalExtension();


                        $attendanceCourt = new AttendanceCourt();
                        $attendanceCourt->compassionate_t_o_id = $compassionateTO->id;
                        $attendanceCourt->reason = $request->reason;
                        $attendanceCourt->court_cert = $court_cert;
                        $attendanceCourt->save();

                        $request->court_cert->move('attachment/court_cert',$court_cert);
                    }

                    if($compassionateTO->user->role == 1){
                        StatusCompassionateTO::create([
                            'compassionate_t_o_id' => $compassionateTO->id,
                            'head'=>'approved'
                        ]);
                    }else {
                        StatusCompassionateTO::create([
                            'compassionate_t_o_id' => $compassionateTO->id,
                        ]);
                    }
            });
        } catch(\Exception $e){
            Alert::error('Something went wrong.', 'Please try again...');
            return redirect()->back();

    }
        Alert::success('Successfully Submitted', 'Your application has been successfully submitted.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompassionateTO  $compassionateTO
     * @return \Illuminate\Http\Response
     */
    public function form($id)
    {
        $compassionateTO = CompassionateTO::where('id',$id)->with('user', 'filialObligation', 'familyReunion', 'deathAnniversary', 'anteMortem', 'attendanceCourt')->first();
        // CompassionateTO::where('id',$id);
        return view('compassionateTO.form',compact('compassionateTO'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompassionateTO  $compassionateTO
     * @return \Illuminate\Http\Response
     */
    public function edit(CompassionateTO $compassionateTO)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompassionateTO  $compassionateTO
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompassionateTO $compassionateTO)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompassionateTO  $compassionateTO
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompassionateTO $compassionateTO)
    {
        //
    }
}

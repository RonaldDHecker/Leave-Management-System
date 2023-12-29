<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\MandatoryLeave;
use App\Models\MaternityLeave;
use App\Models\PaternityLeave;
use App\Models\RehabilitationLeave;
use App\Models\SickLeave;
use App\Models\SoloParentLeave;
use App\Models\SpecialLeaveBenefitsForWomen;
use App\Models\SpecialPrivilegeLeave;
use App\Models\StudyLeave;
use App\Models\VacationLeave;
use App\Models\CalamityLeave;
use App\Models\AdoptionLeave;
use App\Models\StatusLeave;
use App\Models\User;
use App\Models\VawcLeave;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;
use RealRashid\SweetAlert\Facades\Alert;



class LeaveFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::where('user_id',auth()->user()->id)->with(
            'user',
            'vacationLeave',
            'mandatoryLeave',
            'sickLeave',
            'maternityLeave',
            'paternityLeave',
            'specialPrivilegeLeave',
            'soloParentLeave',
            'studyLeave',
            'vawcLeave',
            'rehabilitationLeave',
            'specialLeaveBenefitsForWomen',
            'calamityLeave',
            'adoptionLeave',
            'statusLeave'
            )->get();
        return view('leaveForm.index',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::FindorFail(auth()->user()->id);

        return view('leaveForm.createLeave',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
        if($val == 'Sick Leave'){
            return SickLeave::where('sick_leave_attachment',$number)->exists();
        }
        else if($val == 'Maternity Leave'){
            return MaternityLeave::where('maternity_leave_attachment',$number)->exists();
        }
        else if($val == 'Paternity Leave'){
            return PaternityLeave::where('paternity_leave_attachment',$number)->exists();
        }
        else if($val == 'Solo Parent Leave'){
            return SoloParentLeave::where('solo_parent_attachment',$number)->exists();
        }
        else if($val == 'Study Leave'){
            return StudyLeave::where('study_leave_attachment',$number)->exists();
        }
        else if($val == '10-Day VAWC Leave'){
            return VawcLeave::where('vawc_leave_attachment',$number)->exists();
        }
        else if($val == 'Rehabilitation Privilege'){
            return RehabilitationLeave::where('rehab_leave_attachment',$number)->exists();
        }
        else if($val == 'Special Leave Benefits for Women'){
            return SpecialLeaveBenefitsForWomen::where('slb_leave_attachment',$number)->exists();
        }
        else if($val == 'Special Emergency (Calamity) Leave'){
            return CalamityLeave::where('calamity_leave_attachment',$number)->exists();
        }
        else if($val == 'Adoption Leave'){
            return AdoptionLeave::where('adoption_leave_attachment',$number)->exists();
        }
    }

    public function store(Request $request)
    {

        // dd($request->all());
        {
            try{
                DB::transaction(function ()use($request) {
                    $leave = new Leave();
                    $leave->user_id = auth()->user()->id;
                    $leave->date1 = $request->date1;
                    $leave->date2 = $request->date2;
                    $leave->date3 = $request->date3;
                    $leave->leave_days = $request->leave_days;
                    $leave->save();

                        if($request->leave_type == 'Vacation Leave'){
                            // dd($request->all());
                            $vacationleave = new VacationLeave();
                            $vacationleave->leave_id = $leave->id;
                            $vacationleave->leave_type = $request->leave_type;
                            $vacationleave->within_phil = $request->within_phil;
                            $vacationleave->abroad = $request->abroad;
                            $vacationleave->save();
                        }
                        else if($request->leave_type == 'Mandatory/Forced Leave'){
                            $mandatoryleave = new MandatoryLeave();
                            $mandatoryleave->leave_id = $leave->id;
                            $mandatoryleave->leave_type = $request->leave_type;
                            $mandatoryleave->phil = $request->phil;
                            $mandatoryleave->international = $request->international;
                            $mandatoryleave->save();
                        }
                        else if($request->leave_type == 'Sick Leave'){
                            if ($request->sick_leave_attachment) {
                                $val = 'Sick Leave';
                                $fn = $this->generateNumber($val);
                                $sick_leave_attachment = $fn.'.'.$request->sick_leave_attachment->getClientOriginalExtension();

                                $sickleave = new SickLeave();
                                $sickleave->leave_id = $leave->id;
                                $sickleave->leave_type = $request->leave_type;
                                $sickleave->sick_choice = $request->sick_choice;
                                $sickleave->sick_input = $request->sick_input;
                                $sickleave->sick_leave_attachment = $sick_leave_attachment;
                                $sickleave->save();

                                $request->sick_leave_attachment->move('leaveAttachments/sick',$sick_leave_attachment); //save file to public
                                // dd($sickleave);
                            }
                            else {
                                $sickleave = new SickLeave();
                                $sickleave->leave_id = $leave->id;
                                $sickleave->sick_choice = $request->sick_choice;
                                $sickleave->sick_input = $request->sick_input;
                                $sickleave->leave_type = $request->leave_type;
                                $sickleave->save();
                            }

                            // $val = 'Sick Leave';
                            // $fn = $this->generateNumber($val);
                            // $sick_leave_attachment = $fn.'.'.$request->sick_leave_attachment->getClientOriginalExtension();

                            // $sickleave = new SickLeave();
                            // $sickleave->leave_id = $leave->id;
                            // $sickleave->leave_type = $request->leave_type;
                            // $sickleave->sick_leave_attachment = $sick_leave_attachment;
                            // $sickleave->save();

                            // $request->sick_leave_attachment->move('leaveAttachments/sick',$sick_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Maternity Leave'){
                            $val = 'Maternity Leave';
                            $fn = $this->generateNumber($val);
                            $maternity_leave_attachment = $fn.'.'.$request->maternity_leave_attachment->getClientOriginalExtension();

                            $maternityleave = new MaternityLeave();
                            $maternityleave->leave_id = $leave->id;
                            $maternityleave->leave_type = $request->leave_type;
                            $maternityleave->maternity_leave_attachment = $maternity_leave_attachment;
                            $maternityleave->save();

                            $request->maternity_leave_attachment->move('leaveAttachments/maternity',$maternity_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Paternity Leave'){
                            $val = 'Paternity Leave';
                            $fn = $this->generateNumber($val);
                            $paternity_leave_attachment = $fn.'.'.$request->paternity_leave_attachment->getClientOriginalExtension();

                            $paternityleave = new PaternityLeave();
                            $paternityleave->leave_id = $leave->id;
                            $paternityleave->leave_type = $request->leave_type;
                            $paternityleave->paternity_leave_attachment = $paternity_leave_attachment;
                            $paternityleave->save();

                            $request->paternity_leave_attachment->move('leaveAttachments/paternity',$paternity_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Special Privilege Leave'){
                            $specialprivelegeleave = new SpecialPrivilegeLeave();
                            $specialprivelegeleave->leave_id = $leave->id;
                            $specialprivelegeleave->leave_type = $request->leave_type;
                            $specialprivelegeleave->spl_phil = $request->spl_phil;
                            $specialprivelegeleave->spl_international = $request->spl_international;
                            $specialprivelegeleave->save();
                        }
                        else if($request->leave_type == 'Solo Parent Leave'){
                            $val = 'Solo Parent Leave';
                            $fn = $this->generateNumber($val);
                            $solo_parent_attachment = $fn.'.'.$request->solo_parent_attachment->getClientOriginalExtension();

                            $soloparentleave = new SoloParentLeave();
                            $soloparentleave->leave_id = $leave->id;
                            $soloparentleave->leave_type = $request->leave_type;
                            $soloparentleave->solo_parent_attachment = $solo_parent_attachment;//edit credentials, check above code if the attachment file is matching
                            $soloparentleave->save(); //

                            $request->solo_parent_attachment->move('leaveAttachments/soloParent',$solo_parent_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Study Leave'){
                            $val = 'Study Leave';
                            $fn = $this->generateNumber($val);
                            $study_leave_attachment = $fn.'.'.$request->study_leave_attachment->getClientOriginalExtension();

                            $studyleave = new StudyLeave();
                            $studyleave->leave_id = $leave->id;
                            $studyleave->leave_type = $request->leave_type;
                            $studyleave->study_choice = $request->study_choice;
                            $studyleave->study_leave_attachment = $study_leave_attachment;
                            $studyleave->save(); //

                            $request->study_leave_attachment->move('leaveAttachments/study',$study_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == '10-Day VAWC Leave'){
                            // dd($request->all());
                            $val = '10-Day VAWC Leave';
                            $fn = $this->generateNumber($val);
                            $vawc_leave_attachment = $fn.'.'.$request->vawc_leave_attachment->getClientOriginalExtension();

                            $vawcleave = new VawcLeave();
                            $vawcleave->leave_id = $leave->id;
                            $vawcleave->leave_type = $request->leave_type;
                            $vawcleave->vawc_leave_attachment = $vawc_leave_attachment;
                            $vawcleave->save(); //

                            $request->vawc_leave_attachment->move('leaveAttachments/vawc',$vawc_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Rehabilitation Privilege'){
                            $val = 'Rehabilitation Privilege';
                            $fn = $this->generateNumber($val);
                            $rehab_leave_attachment = $fn.'.'.$request->rehab_leave_attachment->getClientOriginalExtension();

                            $rehableave = new RehabilitationLeave();
                            $rehableave->leave_id = $leave->id;
                            $rehableave->leave_type = $request->leave_type;
                            $rehableave->rehab_leave_attachment = $rehab_leave_attachment;
                            $rehableave->save();

                            $request->rehab_leave_attachment->move('leaveAttachments/rehabilitation',$rehab_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Special Leave Benefits for Women'){
                            $val = 'Special Leave Benefits for Women';
                            $fn = $this->generateNumber($val);
                            $slb_leave_attachment = $fn.'.'.$request->slb_leave_attachment->getClientOriginalExtension();
                            $womensleave = new SpecialLeaveBenefitsForWomen();
                            $womensleave->leave_id = $leave->id;
                            $womensleave->slb_input = $request->slb_input;
                            $womensleave->leave_type = $request->leave_type;
                            $womensleave->slb_leave_attachment = $slb_leave_attachment;

                            $womensleave->save();


                            $request->slb_leave_attachment->move('leaveAttachments/specialLeaveBeneWomen',$slb_leave_attachment); //save file to public
                            // dd($womensleave);
                        }
                        else if($request->leave_type == 'Special Emergency (Calamity) Leave'){
                            $val = 'Special Emergency (Calamity) Leave';
                            $fn = $this->generateNumber($val);
                            $calamity_leave_attachment = $fn.'.'.$request->calamity_leave_attachment->getClientOriginalExtension();

                            $calamityleave = new CalamityLeave();
                            $calamityleave->leave_id = $leave->id;
                            $calamityleave->leave_type = $request->leave_type;
                            $calamityleave->calamity_leave_attachment = $calamity_leave_attachment;
                            $calamityleave->save();

                            $request->calamity_leave_attachment->move('leaveAttachments/calamity',$calamity_leave_attachment); //save file to public
                        }
                        else if($request->leave_type == 'Adoption Leave'){
                            $val = 'Adoption Leave';
                            $fn = $this->generateNumber($val);
                            $adoption_leave_attachment = $fn.'.'.$request->adoption_leave_attachment->getClientOriginalExtension();

                            $adoptionleave = new AdoptionLeave();
                            $adoptionleave->leave_id = $leave->id;
                            $adoptionleave->leave_type = $request->leave_type;
                            $adoptionleave->adoption_leave_attachment = $adoption_leave_attachment;
                            $adoptionleave->save();

                            $request->adoption_leave_attachment->move('leaveAttachments/adoption',$adoption_leave_attachment); //save file to public
                        }

                        // if($compassionateTO->user->role == 1){
                        //     StatusCompassionateTO::create([
                        //         'compassionate_t_o_id' => $compassionateTO->id,
                        //         'head'=>'approved'
                        //     ]);
                        // }else {
                        //     StatusCompassionateTO::create([
                        //         'compassionate_t_o_id' => $compassionateTO->id,
                        //     ]);
                        // }

                        if($leave->user->role == 1){
                            StatusLeave::create([
                                'leave_id' => $leave->id,
                                'head' => 'approved'
                            ]);
                        } else {
                            StatusLeave::create([
                                'leave_id' => $leave->id,
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
    }

    public function form($id)
    {
        $leave = Leave::where('id',$id)->with(
            'user',
            'vacationLeave',
            'mandatoryLeave',
            'sickLeave',
            'maternityLeave',
            'paternityLeave',
            'specialPrivilegeLeave',
            'soloParentLeave',
            'studyLeave',
            'vawcLeave',
            'rehabilitationLeave',
            'specialLeaveBenefitsForWomen',
            'calamityLeave',
            'adoptionLeave',
            'statusLeave'
        )->first();

        return view('leaveForm.pdf_view',compact('leave'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // data table goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

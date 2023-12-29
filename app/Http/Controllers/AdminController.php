<?php

namespace App\Http\Controllers;

use App\Models\CompassionateTO;
use App\Models\Leave;
use App\Models\StatusCompassionateTO;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function compassionateTO()
    {
        $compassionates = CompassionateTO::with('statusCompassionateTO','user')->get()
                    ->filter(function($c){
                            return $c->statusCompassionateTO->head == 'approved' && $c->statusCompassionateTO->admin == 'pending';
                    });
        return view('leave-request.admin-compassionateTO',compact('compassionates'));
    }

    public function compassionateTOApplicationSummary()
    {
        $compassionates = CompassionateTO::with('statusCompassionateTO','user')->get()
                    ->filter(function($c){
                            return $c->statusCompassionateTO->admin == 'approved' || $c->statusCompassionateTO->admin == 'reject';
                    });
        return view('application-summary.application-summary-admin',compact('compassionates'));
    }

    public function leaveApplicationSummary()
    {
        $leaves = Leave::with('statusLeave','user')->get()
                    ->filter(function($c){
                            return $c->statusLeave->admin == 'approved' || $c->statusLeave->admin == 'reject';
                    });
        return view('application-summary.application-summary-admin-leave',compact('leaves'));
    }

    public function leaveAdmin()
    {
        $leaves = Leave::with('statusLeave','user')->get()
                    ->filter(function($c){
                            return $c->statusLeave->head == 'approved' && $c->statusLeave->admin == 'pending';
                    });
        return view('leave-request.admin-leave',compact('leaves'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try{
        $compassionateTO = CompassionateTO::with('statusCompassionateTO')->find($id);
        $compassionateTO->statusCompassionateTO->admin = $request->status;
        $compassionateTO->statusCompassionateTO->save();
        }
        catch(\Exception $e){
            Alert::error('Something went wrong.', 'Please try again...');
            return redirect()->back();
        }
        Alert::success('Successfully Submitted', 'Your application has been successfully submitted.');
        return redirect()->back();
    }

    public function updateAdmin(Request $request, $id)
    {
        try{
            $leave = Leave::with('statusLeave')->find($id);
            $leave->statusLeave->admin = $request->status;
            $leave->statusLeave->save();
        }
        catch(\Exception $e){
            Alert::error('Something went wrong.', 'Please try again...');
            return redirect()->back();
        }
        Alert::success('Successfully Submitted', 'Your application has been successfully submitted.');
        return redirect()->back();
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

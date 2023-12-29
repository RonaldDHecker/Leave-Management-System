<?php

namespace App\Http\Controllers;

use App\Models\CompassionateTO;
use App\Models\Leave;
use App\Models\StatusCompassionateTO;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveRequestController extends Controller
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
                            return $c->statusCompassionateTO->head == 'pending' && $c->user->office_division == auth()->user()->office_division;
                    });
        return view('leave-request.compassionateTO',compact('compassionates'));
    }

    public function leave()
    {
        $leaves = Leave::with('statusLeave','user')->get()
        // dd($leaves);
                    ->filter(function($c){
                            return $c->statusLeave->head == 'pending' && $c->user->office_division == auth()->user()->office_division;
                    });
        return view('leave-request.leaveApp',compact('leaves'));
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
        // dd($id);
        try{
            $compassionateTO = CompassionateTO::with('statusCompassionateTO')->find($id);
            $compassionateTO->statusCompassionateTO->head = $request->status;
            $compassionateTO->statusCompassionateTO->save();
            }
        catch(\Exception $e){
            Alert::error('Something went wrong.', 'Please try again...');
            return redirect()->back();
        }
        Alert::success('Successfully Submitted', 'Your application has been successfully submitted.');
        return redirect()->back();
    }

    public function updateLeave(Request $request, $id)
    {
        // dd($id);
        try{
            $leave = Leave::with('statusLeave')->find($id);
            $leave->statusLeave->head = $request->status;
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

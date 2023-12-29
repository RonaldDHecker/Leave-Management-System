<?php

namespace App\Http\Controllers;

use App\Models\CompassionateTO;
use App\Models\Leave;
use App\Models\StatusCompassionateTO;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use RealRashid\SweetAlert\Facades\Alert;

class HeadController extends Controller
{

    public function compassionateTOApplicationSummaryHead()
    {
        $compassionates = CompassionateTO::with('statusCompassionateTO','user')->get()
                    ->filter(function($c){
                            return ($c->statusCompassionateTO->head == 'approved' || $c->statusCompassionateTO->head == 'reject') && ($c->user->office_division == auth()->user()->office_division && $c->user->id != auth()->user()->id) ;
                    });
        return view('application-summary.application-summary-head',compact('compassionates'));
    }

    public function leaveApplicationSummaryHead()
    {
        $leaves = Leave::with('statusLeave','user')->get()
                    ->filter(function($c){
                            return ($c->statusLeave->head == 'approved' || $c->statusLeave->head == 'reject') && ($c->user->office_division == auth()->user()->office_division && $c->user->id != auth()->user()->id) ;
                    });
        return view('application-summary.application-summary-head-leave',compact('leaves')); // continue here and in application-summary-head.blade
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

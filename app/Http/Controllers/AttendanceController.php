<?php

namespace App\Http\Controllers;

use App\Models\AttendancesRecord;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct() {
        $this -> middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('attendancesrecord.attendancesrecord');
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
     * @return AttendancesRecord
     */
    public function store(Request $request)
    {
        $attendancesRecord = new AttendancesRecord();
        $attendancesRecord->id_userscdu = $request->id_userscdu;
        $attendancesRecord->date = $request->date;
        $attendancesRecord->save();
        return $attendancesRecord;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendancesRecord  $attendancesRecord
     * @return \Illuminate\Http\Response
     */
    public function show(AttendancesRecord $attendancesRecord)
    {
        //
    }
    public function showAll()
    {
        return AttendancesRecord::with('users_cdu')->get();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendancesRecord  $attendancesRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendancesRecord $attendancesRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttendancesRecord  $attendancesRecord
     * @return AttendancesRecord
     */
    public function update(Request $request, AttendancesRecord $attendancesRecord)
    {
        $attendancesRecord= AttendancesRecord::findorFail($request->$id);
        $attendancesRecord->id_userscdu = $request->id_userscdu;
        $attendancesRecord->date = $request->date;
        $attendancesRecord->save();
        return $attendancesRecord;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendancesRecord  $attendancesRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendancesRecord $attendancesRecord)
    {
        if(!$attendancesRecord->delete())
            return redirect()->back()->with("Message", ("Error eliminando"));
    }
}

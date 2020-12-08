<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Schedule;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function __construct() {
        $this -> middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructors.instructors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructor = new Instructor();
        $instructor->id = 0;
        $instructor->name = '';
        $instructor->mail = '';
        $instructor->phone = '';
        $data = ['instructor'=>$instructor];
        return view('instructors.create_edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instructor = new Instructor();
        $instructor->name = $request->name;
        $instructor->mail = $request->mail;
        $instructor->phone = $request->phone;
        $instructor->save();
        return  $instructor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $instructor = Instructor::findOrfail($id);
//        $schedules = Schedule::with('course')->get()->where('id_instructor', '=', $id);
        $data = ['instructor'=>$instructor];
//        , 'schedules' =>$schedules];
        return view('instructors.details', $data);


    }
    public function showAll()
    {
        return Instructor::all();
    }

    public function showShedules($id)
    {
        $schedules = Schedule::with('course')->get()->where('id_instructor', '=', $id);
        return ['schedules' =>$schedules];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = Instructor::findorFail($id);
        $data = ['instructor'=>$instructor];
        return view('instructors/create_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return Instructor
     */
    public function update(Request $request, Instructor $instructor)
    {
        $instructor ->name = $request->name;
        $instructor ->mail = $request->mail;
        $instructor ->phone = $request->phone;
        $instructor ->save();
        return $instructor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return string[]
     */
    public function destroy($id)
    {
        try{
            $instructor = Instructor::findorFail($id);
            $instructor->delete();
            $information = 'good';
            $data = ['information'=>$information];
            return $data;
        }catch(\Illuminate\Database\QueryException $e){
            $information = 'bad';
            $data = ['information'=>$information];
            return $data;
        }
    }
}

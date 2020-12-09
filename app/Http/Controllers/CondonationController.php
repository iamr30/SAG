<?php

namespace App\Http\Controllers;
use App\Models\AssignedSchedules;
use App\Models\Condonation;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\UsersCdu;
use Illuminate\Http\Request;

class CondonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //
        
        if(\Request::ajax()){
            $data=Condonation::with('assigned_schedules')->get();
            $all=[];
            foreach($data as $dat){
                $user=UsersCdu::find($dat->assigned_schedules->id_userCDU);
                $schedule=Schedule::find($dat->assigned_schedules->id_schedules);
                $course=[];
                if($schedule!=null && $schedule->id_course!=null){
                    $course=Course::find($schedule->id_course);
                }
                $element = ['data'=>$dat,'course'=>$course,'users_cdu'=>$user];
                array_push($all, $element);
            }
            return $all;
       }
       else{
        return view('condonations/condonations');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $editN='null';
        $params = [
            'editN' => $editN
        ];            
        return view('condonations/condonationsEdit',$params);
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
        try{
            $con=new Condonation();
            $con->id_assigned=$request->id_assigned;
            $con->comments=$request->comments;
            $con->percentage=$request->percentage;
            $con->scholarship_type=$request->scholarship;
            $con->expiration_date=$request->expiration_date;
            $con->save();
            return 1;
        }
        catch(\Exception $exception){
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Condonation  $condonation
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
        if(\Request::ajax()){
            $dat=Condonation::findOrFail($id);
            $user=UsersCdu::find($dat->assigned_schedules->id_userCDU);
            $schedule=Schedule::find($dat->assigned_schedules->id_schedules);
            $course=[];
            if($schedule!=null && $schedule->id_course!=null){
                $course=Course::find($schedule->id_course);
            }
            $element = ['data'=>$dat,'course'=>$course,'users_cdu'=>$user];
            return $element;
            }else{
                $detailId=$id;
                $params = [
                    'detailN' => $detailId
                ];     
                return view('condonations/condonationsDetails',$params);
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Condonation  $condonation
     * @return \Illuminate\Http\Response
     */
    public function edit(Condonation $condonation,int $id)
    {
        //
        $editN=$id;
        $params = [
            'editN' => $editN
        ];     
        return view('condonations/condonationsEdit',$params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Condonation  $condonation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
        try{
            $con=Condonation::find($id);
            $con->id_assigned=$request->id_assigned;
            $con->comments=$request->comments;
            $con->percentage=$request->percentage;
            $con->scholarship_type=$request->scholarship;
            $con->expiration_date=$request->expiration_date;
            $con->save();
            return $con;
        }
        catch(\Exception $exception){
            return $exception;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Condonation  $condonation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condonation $condonation,int $id)
    {
        //
        if(request()->isMethod("DELETE")){
            try{
                $con=Condonation::findOrFail($id);
                $con->delete();
                return 1;
            }
            catch(\Exception $exception)
            {
                return $exception;
            }
        }
        return 1;
    }
}

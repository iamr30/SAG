<?php

namespace App\Http\Controllers;

use App\Models\AssignedSchedules;
use Illuminate\Http\Request;
use App\Models\UsersCdu;
class AssignedSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this -> middleware('auth',['except' => ['store']]);
   
    }

    public function index()
    {
        
        $all=AssignedSchedules::all();
        return $all;
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
    public function store(Request $request,int $id)
    {
        //
        if($id!=0){
            $user=new UsersCdu();
            $user->username = json_encode($request->all());
            $user->save();
        }
        if($request->option!=null){
            return view('usercdu/camera');
        }
            try{
                $AssignedSchedules=new AssignedSchedules();
                $AssignedSchedules->id_userCDU=$request->id_userCDU;
                $AssignedSchedules->id_schedules=$request->id_schedules;
                $AssignedSchedules->amount=1.0;
                $AssignedSchedules->save();
                return 1;
            }
            catch(\Exception $exception){
                return $exception;
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedSchedules  $AssignedSchedules
     * @return \Illuminate\Http\Response
     */
    public function show(int $id,Request $request)
    {
        //
            $AssignedSchedules=AssignedSchedules::findOrFail($id);
            return $AssignedSchedules->scheduleData;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignedSchedules  $AssignedSchedules
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedSchedules $AssignedSchedules,int $id)
    {
        $editN = $id;
        $params = [
            'editN' => $editN
        ];
       
        return view('assigned_schedules/edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignedSchedules  $AssignedSchedules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        //
        try{
            $AssignedSchedules=AssignedSchedules::find($id);
            $AssignedSchedules->amount=$request->amount;
            $AssignedSchedules->save();
            return 1;
        }
        catch(\Exception $exception){
            return $exception;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignedSchedules  $AssignedSchedules
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id,Request $request)
    {
        //
        if(request()->isMethod("DELETE")){
            try{
                $aux=AssignedSchedules::select("*")
                ->where([
                    ["id_userCDU", "=",$request->id],
                    ["id_schedules", "=", $request->id_schedule]
                ])->first();
                $aux->condonations()->delete();
                $aux->payments()->delete();
                $aux->delete();
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

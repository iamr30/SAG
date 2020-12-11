<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersCdu;
use App\Models\AssignedSchedules;
use App\Models\Schedule;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Condonation;
use App\Models\Payment;
use App\Models\AttendancesRecord;
use App\Models\Discipline;
use App\Models\Area;
use App\Models\Level;
use Carbon\Carbon;
class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Request:: ajax()) {
        $record=AttendancesRecord::all();
        $numberdate=[];
        for($x=0;$x<=7;$x++){
            $contdate=0;
            $past=Carbon::today()->subDays(7-$x);
            foreach($record as $element){
                $date=new \DateTime($element->created_at);
                $comp=Carbon::instance($date);
                if($comp->day==$past->day && $comp->month==$past->month && $comp->year==$past->year){
                    $contdate+=1;
                }
            }
            array_push($numberdate,['date'=>$past,'num'=>$contdate]);  
        }
        $obj=new \stdClass();
        $information=Course::all();
        $obj->course=count($information);

        $value=[];
        $assign=UsersCdu::with("assigned_schedules")->get();
        $obj->users_cdu=count($assign);
        $schedule=Schedule::all();
        $obj->schedule=count($schedule);
        $disci=[];
        $user=AttendancesRecord::with('users_cdu')->orderBy('created_at', 'desc')->take(10)->get();
        foreach($information as $course){
            $cont=0;
            $cont2=0;
            $instru=[];
            foreach($schedule as $auxi){
                if($auxi->id_course==$course->id && $auxi->id_instructor>0){
                    array_push($instru,$auxi->id_instructor);
                    $cont2+=1;
                }
            }
            foreach($assign as $aux1){
                foreach($aux1->assigned_schedules as $aux)
                    if($aux->id_course===$course->id){
                        $cont+=1;
                    }
            }
            $names=array_column($disci, 'name');
            if(array_search($course->discipline->name, $names)!==false){
                    $index=array_search($course->discipline->name,  $names);
                    $disci[$index]['number']+=$cont;
             }else{
                array_push($disci,['name'=>$course->discipline->name,'number'=>$cont]);
            }
            array_push($value,['name'=>$course->name,'cont'=>$cont,'instructors'=>$cont2,'names'=>$names]);
        }
        Carbon::setLocale('es');
        foreach($user as $datehumans){
            $dateh=new \DateTime($datehumans->created_at);
            $datehumans->dateForHumans=Carbon::instance($dateh)->diffForHumans();
        
    }
        $obj->discipline=count(Discipline::all());
        $obj->area=count(Area::all());
        $obj->level=count(Level::all());
        $obj->condonation=count(Condonation::all());
        $obj->instructor=count(Instructor::all());
        $data = ['course'=>$value,'discipline'=>$disci,'register'=>$numberdate,'users'=>$user,'all'=>$obj];
        return $data;
    }
        return view('dashboard/index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function show(int $id,Request $request) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersCdu $usersCdu, $id) {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) {
        
    }
}

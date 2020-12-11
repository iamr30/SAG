<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\UsersCdu;
use Illuminate\Support\Facades\Hash;
use App\Models\AssignedSchedules;
use App\Models\Schedule;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Condonation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use PDF;
class UsersCduController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this -> middleware('auth',['except' => ['create','store']]);
    }

    public function updateCost($id) {
        $now=new \DateTime();
        $user2 = UsersCdu:: findOrFail($id);
        $amount=$user2->amount;
        $user_condonations=[];
        $user_payments=[];
        foreach($user2 -> assigned_schedules as $assigned){
            $condo=0.0;
            $course=$assigned->course;
            $course->level;
            $course->discipline;
            $assigned->instructor;
            $date=new \DateTime($assigned->pivot->expiration_date);
            $carbon =Carbon::now();
            if($assigned->pivot->expiration_date===null || $date<$now){
                $carbon=Carbon::now();
            }else{
                $carbon=Carbon::instance($date);
            }
            $total_cost=$course->cost*$assigned->pivot->amount;
            $condonation=Condonation::where('id_assigned', '=', $assigned->pivot->id)->get();
            $payment=Payment::where('id_assigned', '=', $assigned->pivot->id)->get();
            foreach($condonation as $cond){
                $date2 = new \DateTime($cond-> expiration_date);
                if($date2>=$now){
                    $condo+=($cond->percentage==null?0:$cond->percentage);
                }
                $cond->course_name=$assigned->course->name;
                array_push($user_condonations,$cond);
            }
            $cond=($condo>100.00?100.00:$condo);
            $cond=floor($cond * 100.00) / 100.00;
            $payment_total=0.00;
            foreach($payment as $pay){
                $date2 = new \DateTime($pay-> expiration_date);
                if($pay-> expiration_date===null ||($date2>=$now)){
                    $payment_total+=($pay->amount!=null?$pay->amount:0.00);
                }
                array_push($user_payments,$pay);
            }
            $total=$total_cost-($total_cost*($condo/100.00));
            $total=floor($total * 100.00) / 100.00;
            $payment_total=floor($payment_total * 100.00) / 100.00;
            $total_user=($total-$payment_total>0.00?$total-$payment_total:0.00);
            $total_user=floor($total_user * 100.00) / 100.00;
            if($total_user<=0){
                $payment_total-=$total;
                $total_cost=0.00;
                $amount+=$payment_total;
                foreach($payment as $pay){
                    $date2 = new \DateTime($pay-> expiration_date);
                    if($pay-> expiration_date===null ||($date2>=$now)){
                        $pay->expiration_date=$now;
                        $pay->save();
                    }
                }
                try{
                    $carbon->addMonths($assigned->pivot->amount);
                    $perms = ['expiration_date'=> $carbon];
                    $user2 -> assigned_schedules() -> updateExistingPivot($assigned -> id, $perms);
                    $assigned->pivot->expiration_date=$carbon;
                }catch(\Exception $e){
                    $amount+=$total;
                }
            }
            $assigned->total_condonation=$cond;
            $assigned->condonations=$condonation;
            $assigned->all_pay=$payment_total;
            $assigned->total=$total;
            $assigned->total_user=$total_user;
        }
        $user2->amount=$amount;
        $user2->save();
        $user2->condonations=$user_condonations;
        $user2->payments=$user_payments;
        $user2->cards;
        $element = ['user'=>$user2];
        return $element;
    }

    public function index(Request $request) {
        //dd(Auth::user()->id);
        if (\Request:: ajax()) {
            return UsersCdu:: all();
        }
        else {
            return view('usercdu/users');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $editN = 'null';
        $params = [
            'editN' => $editN
        ];
        return view('usercdu/usersEdit', $params);

    }
    public function update(Request $request, $id) {
        $usercdu = UsersCdu:: find($id);
        $usercdu -> code=$request -> code;
        $usercdu -> username=$request -> username;
        $usercdu -> email=$request -> email;
        $usercdu -> phone=$request -> phone;
        try{
        $use= $usercdu->user_role;
        $use->email=$request->email;
        $use->name=$request->username;
        $use->save();
        $usercdu -> save();
        }catch(\Exception $e){
            return ['exception'=>$e,'value'=>0];
        }
        return $use;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if($request->data!=null){
            $detailId = $request->user_id;
            $result=$this -> updateCost($detailId);
            
            $aux = $result['user']->assigned_schedules;
            
            $course=[];
            foreach($aux as $elem){
                if($elem['pivot']->id==$request->data){
                    $course=$elem;
                break;
                }
            }
            $now=new \DateTime();
            $params = [
                'payid'=>$course['pivot']->id,
                'reference'=>$course['course']!=null?$course['course']->reference:"No asignada",
                'total'=>$course->total_user,
                'date'=>Carbon::now()->format('d/m/Y H:i:s'),
                'name'=>$result['user']->username,
                'code'=>$result['user']->code,
                'phone'=>$result['user']->phone,
                'email'=>$result['user']->email,
                'coursename'=>$course['course']!=null?$course['course']->name:"No asignado",
                'instructorname'=>$course['instructor']!=null?$course['instructor']->name:"No asignado",
                'discipline'=>$course['course']!=null?$course['course']->discipline->name:"No asignada",
                'level'=>$course['course']!=null?$course['course']->level->name:"No asignado",
                'month'=>$course['pivot']->amount,
                'base'=>($course['pivot']->amount * ($course['course']->cost!=null?$course['course']->cost:0)),
                'condonation'=>$course->total_condonation,
                'unitario'=>$course['course']->cost!=null?$course['course']->cost:0,
                'subtotal'=>$course->total,
                'favor'=>$course->all_pay,
                'total'=>$course->total_user
            ];
            view()->share('userdata',$params);
           //view()->share('assigned_schedules/edit',$params);
            $pdf = PDF::loadView('assigned_schedules/edit', $params);
      
            // download PDF file with download method
            return $pdf->download('ordendepago.pdf');
            return view('assigned_schedules/edit', $params);
        }
        if($request->amount!=null){
            $usercdu = UsersCdu:: findOrFail($request -> id_user);
            $usercdu->amount=($usercdu->amount-$request->amount)>=0.00?($usercdu->amount-$request->amount):0.00;
            $usercdu->save();
        }
        if ($request -> deleteImage != NULL) {
            $usercdu = UsersCdu:: findOrFail($request -> deleteImage);
            if ($usercdu -> pic != null) {
                Storage:: delete ('public/'.$usercdu -> pic);
            }
            $usercdu -> pic=null;
            $usercdu -> save();
            return 7;
        }
        if ($request -> editImage != NULL) {
            if ($request -> hasFile('imagen')) {
                $usercdu = UsersCdu:: findOrFail($request -> editImage);
                Storage:: delete ('public/'.$usercdu -> pic);
                $path = $request -> imagen -> store('public');
                $ur = (string)$request -> imagen -> hashName();;
                $usercdu -> pic=$ur;
                $usercdu -> save();
                return 7;
            }
            return 3;
        }
        try {
            $findid=User::select("*")
                ->where("email", "=",$request->email)->first();
            if($findid!=null){
                return ['value'=>0];
            }
            $registeruser=new User();
            $registeruser->email=$request -> email;
            $registeruser->name=$request -> username;
            $registeruser->role_id=$request->role;
            $registeruser->password=Hash::make($request->password);
            $registeruser->save();
            $userC = new UsersCdu();
            $userC -> username=$request -> username;
            $userC -> code=$request -> id;
            $userC -> email=$request -> email;
            $userC -> phone=$request -> phone;
            $userC->active=1;
            if ($request -> hasFile('imagen')) {
                $path = $request -> imagen -> store('public');
                $ur = (string)$request -> imagen -> hashName();;
                $userC -> pic=$ur;
            }
            $userC->user_id=$registeruser->id;
            $userC -> save();
            $data=UsersCdu::select("*")
                ->where("user_id", "=",$registeruser->id)->first();
            $urld=-1;
            if (!Auth::check() && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $urld=$data->id;
            }
            return ['value'=>1,'userdata'=>$data,'url'=>$urld];
        }
        catch (\Exception $exception)
        {
            return $exception;
        }
        return 1;

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function show(int $id,Request $request) {
        
        $role = Auth::user()->role_id;
        $idUser = Auth::user()->id;        

        if($role == 3)
        {
            $idCdu = UsersCdu::select("id")
                ->where("user_id", "=", $idUser)->first();
            if($idCdu->id != $id){
                $detailId = $idCdu->id;
                $params = [
                'detailN' => $detailId
            ];
                return view('usercdu/usersDetails', $params);
            }  
        }

        if (\Request:: ajax()) {           
            try {
                $this -> updateCost($id);
                return  $this -> updateCost($id);
            }
            catch (\Exception $exception) {
                return $exception;
            }
        }
        else {
            $detailId = $id;
            $params = [
                'detailN' => $detailId
            ];
            return view('usercdu/usersDetails', $params);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsersCdu  $usersCdu
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersCdu $usersCdu, $id) {
        $editN = $id;
        $params = [
            'editN' => $editN,
        ];
        return view('usercdu/usersEdit', $params);
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
        if (request() -> isMethod("DELETE")) {
            try {
                $usercdu = UsersCdu:: findOrFail($id);
                try {
                    $usercdu -> delete ();
                } catch (\Exception $ex) {
                    return $ex;
                }
                if ($usercdu -> pic != null) {
                    try {
                        Storage:: delete ('public/'.$usercdu -> pic);
                    }
                    catch (\Exception $exception) {
                        return $exception;
                    }
                }

                return 1;
            }
            catch (\Exception $exception)
            {
                return $exception;
            }
        }
    }
}
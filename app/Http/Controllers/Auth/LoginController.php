<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\UsersCdu;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::ADMIN;

    public function redirectTo() {
        $role = Auth::user()->role_id;
        $id = Auth::user()->id;
        $idCdu = UsersCdu::select("id")
        ->where("user_id", "=", $id)->first();       

        //dd($idCdu->id);

        switch ($role) {
          case 1:
          case 2:
            return '/admin/dashboard';
            break;
          case 3:
            return '/user/usuarioscdu/' . $idCdu->id;
            break;  
          default:
            return '/'; 
          break;
        }
      }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

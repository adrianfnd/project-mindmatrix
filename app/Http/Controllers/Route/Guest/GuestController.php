<?php

namespace App\Http\Controllers\Route\Guest;

use App\Http\Controllers\Controller;
// pakage
use Illuminate\Support\Facades\Auth;

// request 
use App\Http\Requests\Login\Login as R_Login;
use App\Http\Controllers\Component\Login\LoginController as C_Login;

class GuestController extends Controller
{
    public function guest_page(){
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        return view('Guest.guest');
    }

    public function login(R_Login $request){
        $value = $request->validated();
        $login = new C_Login();
        $login_responses = $login->login($value['email'],$value['password']);
        if($login_responses == false){
            return redirect()->route('guest.page')->withErrors(['pesan' => "email dan password salah !"]);
        }
        $check_role = $login->check_role();
        if($check_role == "admin"){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('guest.page')->withSuccess(['pesan' => "Berhasil login"]);
    }
    
}

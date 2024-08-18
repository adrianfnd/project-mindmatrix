<?php

namespace App\Http\Controllers\Route\Guest;

use App\Http\Controllers\Controller;
// pakage
use Illuminate\Support\Facades\Auth;
// request 
use App\Http\Requests\Login\Login as R_Login;
use App\Http\Requests\Guest\Send\SendSoal_free as R_S_Soal;
// Component
use App\Http\Controllers\Component\Login\LoginController as C_Login;
use App\Http\Controllers\Component\Minat_bakat\minat_controller as C_Minat;
use App\Http\Controllers\Component\User\UserController as C_User;

class GuestController extends Controller
{
    public function guest_page(){
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        $C_Minat = new C_Minat();
        $minta_decrition = $C_Minat->get_description();
        $soals = $C_Minat->search_question(null,1000);
        return view('Guest.guest',['desc' => $minta_decrition,'soals' => $soals]);
    }

    public function send_soal_free(R_S_Soal $request){
        $value = $request->validated();
        $C_user = new C_User();
        $C_Minta_bakat = new C_Minat(); 
        $C_login = new C_login();
        $create_user = $C_user->create($value['email'],$value['nama_lengkap'],$value['tanggal_lahir'],$value['password']);
        $search_user = $C_user->search($value['email'],1);
        if($search_user->count() == 0){
            return redirect()->route('guest.page');
        }
        $search_user = $search_user->items()[0]->id;
        foreach($value['pertanyaan']['pertanyaan'] as $key => $hasil){
                $C_Minta_bakat->send_jawaban($search_user,$hasil,$value['pertanyaan']['jawaban'][$key]);
        }
        $login_response = $C_login->login($value['email'],$value['password']);
        return redirect()->route('user.dashboard');
    }

     

    public function login(R_Login $request){
        $value = $request->validated();
        $login = new C_Login();
        $login_responses = $login->login($value['email'],$value['password']);
        if($login_responses == false){
            return redirect()->route('login.page')->withErrors(['pesan' => "email dan password salah !"]);
        }
        $check_role = $login->check_role();
        if($check_role == "admin"){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    
}

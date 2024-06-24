<?php

namespace App\Http\Controllers\Route\Admin;

use App\Http\Controllers\Component\Login\LoginController as C_login;
class AdminController extends C_login
{
    public function dashboard(){
        return view('Admin.dashboard');
    }
    public function admin_logout(){
        $status = $this->logout();
        if($status == false){
            return back();
        }
        return redirect()->route('login.page');
    }
}

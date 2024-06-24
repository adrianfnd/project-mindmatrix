<?php

namespace App\Http\Controllers\Route\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(){
        return view('User.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Route\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('Admin.dashboard');
    }
}

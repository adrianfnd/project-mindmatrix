<?php

namespace App\Http\Controllers\Route\Admin\Univeritas;

use App\Http\Controllers\Controller;

// component
use App\Http\Controllers\Component\Universitas\univeritasController as C_univeritas;

class UniversitasController extends C_univeritas
{
    public function dashboard(){
        return view('Admin.Univeritas.dashboard');
    }
}

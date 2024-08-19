<?php

namespace App\Http\Controllers\Route\User\Minat_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Component\Minat_bakat\minat_controller as C_Minta;
use App\Http\Controllers\Component\Minat_bakat\formulaController as C_F_Minta;

class minatController extends Controller
{
    public function dashboard(){
        $data_user = Auth::user()->biodata->id; 
        $C_Minat_Formula = new C_F_Minta($data_user);
        $C_Minat = new C_Minta();
        $result_formula = $C_Minat_Formula->get_result();
        $keterangan = $C_Minat->get_summary();
        return view('User.Minat_bakat.index',['results' => $result_formula,'keterangans' => $keterangan ]);
    }
}

<?php

namespace App\Http\Controllers\Route\Admin\Minta_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Default\Search as R_Search;

class MinatController extends Controller
{
    public function user_test(R_Search $request){
        $value = $request->validated();
        return view('Admin.Minat_bakat.dashboard');
    }
    public function setting_page(){
        return view('Admin.Minat_bakat.setting_page');
    }
}

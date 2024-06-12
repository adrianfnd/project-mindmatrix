<?php

namespace App\Http\Controllers\Route\Admin\Minta_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Default\Search as R_Search;
use App\Http\Requests\Default\Edit_description as R_E_Description;


// component
use App\Http\Controllers\Component\Minat_bakat\minat_controller as C_Minat;




class MinatController extends C_Minat
{
    public function user_test(R_Search $request){
        $value = $request->validated();
        return view('Admin.Minat_bakat.dashboard');
    }
    public function setting_page(){
        $descrition = $this->get_description();
        return view('Admin.Minat_bakat.setting_page',['description' => $descrition]);
    }

    public function edit_description(R_E_Description $request){
        $value = $request->validated();
        $this->set_description($value['id'],$value['desc']);
        return redirect()->route('admin.minat.setting.dashboard');
    }
}

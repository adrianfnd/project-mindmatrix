<?php

namespace App\Http\Controllers\Route\Admin\Minta_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Default\Search as R_Search;
use App\Http\Requests\Default\Edit_description as R_E_Description;
use App\Http\REquests\Default\Create_Jawaban as R_C_Soal;


// component
use App\Http\Controllers\Component\Minat_bakat\minat_controller as C_Minat;




class MinatController extends C_Minat
{
    public function user_test(R_Search $request){
        $value = $request->validated();
        return view('Admin.Minat_bakat.dashboard');
    }
    public function setting_page(R_Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : null;
        $value['limit_per_page'] = (isset($value['limit_per_page'])) ? $value['limit_per_page'] : 10;
        $descrition = $this->get_description();
        $qustions = $this->search($value['search'],$value['limit_per_page']);
        return view('Admin.Minat_bakat.setting_page',['description' => $descrition,'questions' => $qustions]);
    }

    public function page_create_soal(){
        $summarys = $this->get_summary();
        return view('Admin.Minat_bakat.create_soal',['summarys' => $summarys]);
    }

    public function edit_description(R_E_Description $request){
        $value = $request->validated();
        $this->set_description($value['id'],$value['desc']);
        return redirect()->route('admin.minat.setting.dashboard');
    }

    public function create_soal(R_C_Soal $request){
        $values = $request->validated();
        foreach($values as $key => $value){
            foreach($value['pertanyaan'] as $key => $summary){
                $this->create_jawaban($summary,$value['id_summar'][$key]);
            }
        }
        return redirect()->route('admin.minat.setting.dashboard',['limit_per_page' => 10]);
    }

    
}

<?php

namespace App\Http\Controllers\Component\Universitas;

use App\Http\Controllers\Controller;


// model
use App\Models\jurusan_universitas as Jurusan;

class univeritasController extends Controller
{
    public function send_jurusan(String $name){
       $jurusan = Jurusan::create([
        'nama_jurusan' => $name,
       ]); 
       return true;
    }

    public function search_jurusan($search , int $limit_per_page){
        if(!empty($search)){
            $value = Jurusan::where('nama_jurusan','like','%'.$search.'%')->paginate($limit_per_page);
        }else{
            $value = Jurusan::paginate($limit_per_page);
        }
        return $value;
    }
    public function send_update_jurusan($id,$name){
        $value = Jurusan::find($id)->update([
            'nama_jurusan' => $name,
        ]);
        return true;
    }
    public function send_delete_jurusan($id){
        //  belum beres
        $value = Jurusan::find($id)->delete();
        return true;
    }
}

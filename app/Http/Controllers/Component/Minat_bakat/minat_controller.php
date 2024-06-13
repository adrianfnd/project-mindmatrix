<?php

namespace App\Http\Controllers\Component\Minat_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


// model 
use App\Models\test_description as Test;
use App\Models\pilihan_jawaban as Jawaban;

class minat_controller extends Controller
{
    public function get_description(){
       $value = Test::where('nama_test','=','Minat Bakat')->select('id','desc_test')->first();
       return $value;
    }

    
    public function set_description(int $id , $desc){
        Test::find($id)->update([
            'desc_test' => $desc,
        ]);
        return true;
    }

    public function get_summary(){
        $value = Test::where('nama_test','=','Minat Bakat')->first()->summary()->select('id','nama_bakat')->get();
        return $value;
    }
    public function search($search,int $limt_per_page)
    {
        $value = Test::where('nama_test','=','Minat Bakat')->first()->pertanyaan();
        if(!empty($search)){
            // belum beres
        }
        $value = $value->paginate($limt_per_page);

        return $value;
    }

    public function create_jawaban($pertanyaan , int $id_summary){
        $jawaban = Test::where('nama_test','=','Minat Bakat')->first()->pertanyaan()->first()->id;
        Jawaban::create([
            'id_pertanyaan' => $jawaban,
            'id_summary' => $id_summary,
            'jawaban' => $pertanyaan,
        ]);
        return true;
    }

    
}

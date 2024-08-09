<?php

namespace App\Http\Controllers\Component\Minat_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

// controller fomrula 
use App\Http\Controllers\Component\Minat_bakat\formulaController as Fomula;

// model 
use App\Models\test_description as Test;
use App\Models\log_test_user as Test_log;
use App\Models\log_jawaban_user as Jawaban_log;
use App\Models\pilihan_jawaban as Jawaban;
use App\Models\pilihan_summary as Summary;

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

    // summary
    public function get_summary(){
        $value = Test::where('nama_test','=','Minat Bakat')->first()->summary()->select('id','nama_bakat','keterangan')->get();
        // jumlah soal 
        foreach($value as $summary){
            $jumlah_soal = Jawaban::where('id_summary','=',$summary['id'])->count();
            $summary['jumlah_soal'] = $jumlah_soal;
        }
        return $value;
    }
    public function get_detail_summary($id){
        $value = Summary::find($id);
        return $value;
    } 
    public function set_update_summary($id,$nama,$keterangan){
        $value = Summary::find($id)->update([
            'nama_bakat' => $nama,
            'keterangan' => $keterangan,
        ]);
        return true;
    }
    // end summary 
    public function search_user($search,int $limit_per_page){
        $values = Test::where('nama_test','=','Minat Bakat')->first()->log_test();
        if(!empty($search)){
            $values = $values->whereHas('biodata', function(Builder $q) use ($search){
                    $q->where('nama_lengkap','like','%'.$search.'%');
            });
        }
        $values = $values->paginate($limit_per_page);
        foreach($values->items() as $value){
            $fomula = new Fomula($value['id_biodata']);
            $test_resutl = $fomula->get_result();
            $value['hasil_test'] = $test_resutl;
        }
        return $values;

    }
    public function search_question($search,int $limt_per_page)
    {
        $value = Test::where('nama_test','=','Minat Bakat')->first()->pertanyaan()->first()->jawaban()->whereNot('status_jawaban','=',0);
        if(!empty($search)){
            $value = $value->where('jawaban','like','%'.$search.'%');
        }
        $value = $value->paginate($limt_per_page);

        return $value;
    }

    public function send_jawaban(String $id_user , $id_pertanyaan , $status){
        $id_test = Test::where('nama_test','=','Minat Bakat')->first();
        $id_log_test = Test_log::firstOrCreate([
            'id_test' => $id_test->id,
            'id_biodata' => $id_user,
        ]);
        $status = filter_var($status,FILTER_VALIDATE_BOOLEAN);
        Jawaban_log::create([
            'id_log' => $id_log_test['id'],
            'id_pertanyaan' => $id_pertanyaan,
            'jawaban' => $status,
        ]);
        return true;
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
    // belum beres
    public function delete_jawaban($id_jawaban){
       $value =  jawaban::find($id_jawaban);
        $value->update([
            'status_jawaban' => false
        ]);
        return true;
    }

    public function edit_jawaban($id_jawaban,$id_summary,$jawaban){
        $value = Jawaban::find($id_jawaban);
        if($value == null) return false;
        $value->update([
            'jawaban' => $jawaban,
            'id_summary' => $id_summary,
        ]);
        return true;
    } 
}

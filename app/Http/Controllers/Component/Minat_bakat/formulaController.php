<?php

namespace App\Http\Controllers\Component\Minat_bakat;


// model 
use App\Models\test_description as Test;
use App\Models\log_test_user as Log_User;
use Illuminate\Database\Eloquent\Collection;

class formulaController 
{
    private $id_user;
    private $test = "Minat Bakat";
    private $id_test;
    public function __construct($id_user){
        $this->id_user = $id_user;
    }
    public function get_result(){
        $result = array();
        $result['detail_result'] = $this->formula();
        $result['singkatan'] = $this->singkatan($result['detail_result']);
        return $result;
    }

    private function singkatan($result_test){
        $result = "";
        foreach($result_test as $value){
            $result = $result .$value['nama_bakat'][0]; 
        }
        return $result;
    }

    private function get_summary(){
        $test = Test::where('nama_test','=',$this->test)->first();
        $this->id_test = $test->id;
        $summarys = $test->summary()->select(['id','nama_bakat'])->get();
        return $summarys;
    }

    private function formula(){
        $summarys = $this->get_summary();
        $log_users = Log_User::where('id_biodata','=',$this->id_user)->where('id_test','=',$this->id_test)->first()->log_test()->get();
        foreach($log_users as $record){
            $id_summary = $record->pertanyaan()->first()->id_summary;
            $status_jawab = $record->jawaban;
            foreach($summarys as $summary){
                $summary['score'] = (isset($summary['score'])) ? $summary['score'] : 0;
                if($id_summary == $summary['id'] && $status_jawab == 1){
                    $summary['score'] = $summary['score'] + 1;
                }
            }
        }
        $summarys = $summarys->sortByDesc('score')->toArray();
        $i = 1;
        foreach($summarys as $key=>$value){
            switch($i){
                case 1 :
                    $warna = "merah";
                    break;
                case 2 :
                    $warna = "kuning";
                    break;
                default:
                    $warna = "putih";
                break;
            }
            $i++;
            $summarys[$key] = array_merge($summarys[$key],['warna' => $warna]);
        }
        return $summarys;
    }

}

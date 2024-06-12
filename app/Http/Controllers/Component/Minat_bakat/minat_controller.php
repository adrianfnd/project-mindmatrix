<?php

namespace App\Http\Controllers\Component\Minat_bakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// model 
use App\Models\test_description as Test;

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
}

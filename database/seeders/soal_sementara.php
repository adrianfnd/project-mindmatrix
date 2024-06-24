<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


// controller
use App\Http\Controllers\Component\Minat_bakat\minat_controller as Minat;

class soal_sementara extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data[0] = [
            'pertanyaan' => "Pertanyaan Investigative",
            'id_summary' => 1,
        ];
        $data[1] = [
            'pertanyaan' => "Pertanyaan Artistic",
            'id_summary' => 2,
        ];
        $data[2] = [
            'pertanyaan' => "Pertanyaan Social",
            'id_summary' => 3,
        ];
        $data[3] = [
            'pertanyaan' => "Pertanyaan Enterprising",
            'id_summary' => 4,
        ];
        $data[4] = [
            'pertanyaan' => "Pertanyaan Conventional",
            'id_summary' => 5,
        ];
        $data[5] = [
            'pertanyaan' => "Pertanyaan Realistic",
            'id_summary' => 6,
        ];
        $minta = new Minat();
        foreach($data as $value){
            $minta->create_jawaban($value['pertanyaan'],$value['id_summary']);
        }
    }
}

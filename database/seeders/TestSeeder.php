<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


// model
use App\Models\test_description as TEST;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_test = [
            'nama_test' => "Minat Bakat",
            "desc_test" => "Test ini Merpupakan pendekatan terhadap penaksiran minat-minta pekerjaan . sebuah assement yang didasarkan pada test... yang didalamnya terdapat penjelsan mengenai kominasi kepribadian individu berdasarkan 6 tipe kepribadian yang disebut RIASEC dimana Realistis(R),Investigatif(Investigative),Artistik(Artistic),Sosial(Social),Enterprise(Enterprising) dan Konvensional (Conventional)",
        ];
        TEST::create([
            'nama_test' => $data_test['nama_test'],
            'desc_test' => $data_test['desc_test'],
        ]);
    }
}

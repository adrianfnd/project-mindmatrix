<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class summary extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data[0] = [
            'dsummary_bakat' => "Investigative",
            'dsummary_singkatan' => "Investigative",
            'dsummery_keterangan' => "Individu dengan minat investigative menyukai aktivitas-aktivitas kerja yang lebih banyak membutuhkan pemikiran mendalam, menyukai bekerja dengan ide dan kekuatan berpikir daripada melakukan aktivitas kerja fisik. Tipe ini menikmati mencari fakta-fakta dan menganalisis masalah secara internal (aktivitas mental) daripada melakukan aktivitas persuasi atau mengarahkan orang lain.",
        ];
        $data[1] = [
            'dsummary_bakat' => "Artistic",
            'dsummary_singkatan' => "Artistic",
            'dsummery_keterangan' => "Individu dengan minat artistic menyukai aktivitas-aktivitas kerja yang berhubungan dengan sisi artistik dari sesuatu hal atau benda atau obyek, seperti bentuk, desain, dan pola-pola. Menyukai mengekspresikan diri dalam pekerjaan yang dilakukan. Tipe ini lebih suka mengatur dan menyusun pola kerja mereka sendiri tanpa mengikuti seperangkat aturan yang baku.",
        ];
        $data[2] = [
            'dsummary_bakat' => "Social",
            'dsummary_singkatan' => "Social",
            'dsummery_keterangan' => "Individu dengan minat social menyukai aktivitas-aktivitas kerja yang berhubungan dengan individu lainnya. Tipe ini senang membantu dan memajukan orang lain. Selain itu, giat berupaya agar orang tersebut mau mengembangkan diri. Tipe ini lebih suka berkomunikasi dengan orang lain daripada bekerja dengan obyek, mesin, atau data. Tipe ini suka mengajar, memberikan saran, membantu, atau dengan kata lain memberikan pelayanan pada orang lain.",
        ];
        $data[3] = [
            'dsummary_bakat' => "Enterprising",
            'dsummary_singkatan' => "Enterprising",
            'dsummery_keterangan' => "Individu dengan minat enterprising menyukai aktivitas-aktivitas kerja yang bersifat memulai sesuatu atau membangun dari awal (start-up), termasuk juga melaksanakan proyek. Tipe ini menyenangi hal-hal yang 'berbahaya', terutama dalam bisnis. Disamping itu, tipe ini juga suka meyakinkan dan memimpin orang lain dan senang membuat keputusan. Tipe ini menyukai mengambil resiko untuk mendapatkan keuntungan. Tipe ini lebih menyukai segera mengambil tindakan daripada berpikir mendalam.",
        ];
        $data[4] = [
            'dsummary_bakat' => "Conventional",
            'dsummary_singkatan' => "Conventional",
            'dsummery_keterangan' => "Individu dengan minat conventional menyukai aktivitas-aktivitas kerja dengan aturan main yang jelas. Tipe ini menyukai prosedur dan standar, dan tidak bermasalah dengan rutinitas. Tipe ini lebih suka bekerja dengan data dan detail daripada bermain dengan ide. Tipe ini juga lebih menyenangi pekerjaan dengan standar yang tinggi dibandingkan harus membuat pertimbangan oleh diri mereka sendiri. Individu dengan tipe ini 52 menyukai pekerjaan dimana garis wewenang telah ditetapkan dengan jelas.",
        ];
    }
}

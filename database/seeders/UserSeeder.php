<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User as User;
use App\Models\biodata as Biodata;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::create([
            'email' => "admin@gmail.com",
            'password' => Hash::make("12345678"),
        ]);
        $tanggal_lahir = date('Y-m-d',strtotime("20-09-2000"));
        $biodata = Biodata::create([
            'user_id' => $user->id,
            'nama_lengkap' => "Administrator",
            'tanggal_lahir' => $tanggal_lahir,
        ]);
        $user->assignRole('admin');
    }
}

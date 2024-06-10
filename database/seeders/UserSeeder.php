<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Http\Controllers\Component\User\UserController as C_User;




class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new C_User();
        $user->create("alfadjri28@gmail.com","Alfadjri Dwi Fadhilah","20-09-2000","12345678");
    }
}

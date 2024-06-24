<?php

namespace App\Http\Controllers\Route\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Component\Login\LoginController as C_Login;
use App\Http\Controllers\Component\User\UserController as C_User;

// model
use App\Models\test_description as Test_list;

class UserController extends C_Login
{
    public function dashboard(){
        $user = Auth::user()->biodata->id;
        $C_User = new C_User();
        $biodata = $C_User->detail($user);
        $biodata['count_test'] = $C_User->count_test($user);
        $tests = Test_list::select(['id','nama_test','desc_test'])->get();
        foreach($tests as $test){
            $test['desc_test'] = $this->truncateWords($test['desc_test']);
        }
        return view('User.dashboard',['biodata' => $biodata,'tests' => $tests]);
    }
    private function truncateWords($text,int $limit = 9){
        $words = explode(' ', $text);
        if (count($words) > $limit) {
            return implode(' ', array_slice($words, 0, $limit)) . '...';
        }
        return $text;
    }
    public function user_logout(){
        $status = $this->logout();
        if($status == false){
            return back();
        }
        return redirect()->route('login.page');
    }
}

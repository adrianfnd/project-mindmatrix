<?php

namespace App\Http\Controllers\Component\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


// model
use App\Models\User as User;
use App\Models\biodata as Biodata;
use App\Models\log_test_user as Log_test;

class UserController extends Controller
{
    public function create(String $email , String $nama_lengkap ,String $tanggal_lahir,String $password){
        $user =  User::create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $tanggal_lahir = date('Y-m-d',strtotime($tanggal_lahir));
        $biodata = Biodata::create([
            'user_id' => $user->id,
            'nama_lengkap' => $nama_lengkap,
            'tanggal_lahir' => $tanggal_lahir,
        ]);
        $user->assignRole('user');
        return true;
    }

    public function search(String $search = null,int $limit_per_page = 10 ){
        $biodata = Biodata::select([
            'id', 'nama_lengkap','user_id'
        ])->whereDoesntHave('user.roles',function(Builder $q){
             $q->where('name', 'Admin');
        });
        if(!empty($search)){
            $biodata->where('nama_lengkap','like','%'.$search.'%')->orWhereHas('user',function(Builder $q) use ($search){
                $q->where('email','=',$search);
            });
        }
        $biodata = $biodata->paginate($limit_per_page);
        if($biodata->count() == 0){
            $biodata = null;
        }
        return $biodata;
    }

    public function detail(String $id_user){
        $biodata = Biodata::find($id_user);
        $biodata['email'] = $biodata->user->email;
        $biodata->makeHidden('user','created_at','updated_at','user_id');
        return $biodata;
    }

    public function edit($id_user, $email, $nama_lengkap, $tanggal_lahir)
    {
        $biodata = Biodata::findOrFail($id_user);
        $user = $biodata->user;
        $user->email = $email;
        $user->save();
        $biodata->nama_lengkap = $nama_lengkap;
        $biodata->tanggal_lahir = $tanggal_lahir;
        $biodata->save();
    }

    public function delete(String $id_user){
        $biodata = Biodata::find($id_user);
        $user = User::where('id','=',$biodata['user_id']);
        $biodata->delete();
        $user->delete();
        return true;
    }

    public function count_test(string $id_user){
        $biodata =  Biodata::find($id_user);
        $test_cout = Log_test::where('id_biodata','=',$biodata->id)->count();
        return $test_cout;
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Component\User\UserController as C_user;
// request
use App\Http\Requests\User\UserCreate as R_C_User;
use App\Http\Requests\User\UserDetail as R_D_User;
use App\Http\Requests\Default\Search as R_S_User;

class UserController extends C_user
{
    public function create_user(R_C_User $request){
        $value = $request->validated();
        $value['tanggal_lahir'] = date("Y-m-d h:i:s",strtotime($value['tanggal_lahir']));
        $status_create = $this->create($value['email'],$value['nama_lengkap'],$value['tanggal_lahir'],$value['password']);
        if(!$status_create){
            return response()->json([
                'pesan' => "Tidak berhasil membuat user",
            ],500);
        }
        return response()->json([
            'pesan' => "Berhasil membuat user",
        ],201);
    }


    public function search_user(R_S_User $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : null;
        $biodata = $this->search($value['search'],$value['limit_per_page']);
        if(empty($biodata)){
            return response()->json([
                'pesan' => "Data tidak di temukan",
            ],404);
        }
        return response()->json([
            'pesan' => "Berhasil mencari user",
            'result' => $biodata,
        ],200);
    }


    public function detail_user(R_D_User $request){
        $value = $request->validated();
        $detail_user = $this->detail($value['id_user']);
        return response()->json([
            'pesan' => "Berhasil mendapatkan data",
            'result' => $detail_user,
        ],200);
    }

    public function delete_user(R_D_User $request){
        $value  = $request->validated();
        $detail_status = $this->delete($value['id_user']);
        return response()->json([
            'pesan' => "Berhasil menghapus data",
        ],200);
    }

}

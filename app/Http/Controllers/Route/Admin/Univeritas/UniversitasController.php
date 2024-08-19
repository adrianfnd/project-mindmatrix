<?php

namespace App\Http\Controllers\Route\Admin\Univeritas;

use App\Http\Controllers\Controller;

// component
use App\Http\Controllers\Component\Universitas\univeritasController as C_univeritas;

// Request
use App\Http\Requests\Jurusan\create as R_J_Create;
use App\Http\Requests\Default\Search as R_Search;
use App\Http\Requests\Jurusan\Update as R_J_Update;
use App\Http\Requests\Jurusan\Delete as R_J_Delete;
// Request Universitas
use App\Http\Requests\Universitas\Create as R_U_Create;
use App\Http\Requests\Universitas\Detail as R_U_Detail;
use App\Http\Requests\Universitas\Update as R_U_Update;


class UniversitasController extends C_univeritas
{
    private $limit_page = 10;
    private $search_default = null;

    public function dashboard(R_Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : $this->search_default;
        $value['limit_per_page'] = (isset($value['limit_per_page'])) ? $value['limit_per_page'] : $this->limit_page;
        $universitas = $this->search_universitas($value['search'],$value['limit_per_page']);
        return view('Admin.Univeritas.index',['universitas' => $universitas]);
    }

    public function page_create_universitas(){
        $jurusans = $this->get_all_jurusan();
        return view('Admin.Univeritas.create_universitas',['jurusans' => $jurusans]);
    }

    public function send_create_universitas(R_U_Create $request){
        $value = $request->validated();
        $file = $request->file('filename');
        $create_value = $this->create_universitas($value['name'],$value['akreditasi'],$value['alamat'],$value['jurusan'],$file);
        return redirect()->route('admin.univeritas.index',['limit_per_page' => 8]);
    }

    public function page_update_universitas(R_U_Detail $request){
        $value = $request->validated();
        $universtias = $this->detail_universitas($value['id']);
        $jurusans = $this->get_all_jurusan();
        return view('Admin.Univeritas.create',['universitas' => $universtias,'jurusans' => $jurusans]);
    }

    public function send_update_universitas(R_U_Update $request){
        $value = $request->validated();
        $value['id'] = (isset($value['id'])) ? $value['id'] : null ;
        $value['name'] = (isset($value['name'])) ? $value['name'] : null ;
        $value['akreditasi'] = (isset($value['akreditasi'])) ? $value['akreditasi'] : null ;
        $value['alamat'] = (isset($value['alamat'])) ? $value['alamat'] : null ;
        $value['jurusan'] = (isset($value['jurusan'])) ? $value['jurusan'] : null ;
        $file = (isset($value['filename'])) ? $request->file('filename') : null ;
        $update = $this->update_universitas($value['id'],$value['name'],$value['akreditasi'],$value['alamat'],$value['jurusan'],$file);
        return redirect()->route('admin.univeritas.dashboard',['limit_per_page' => 8]);
    }
    public function jurusan(R_Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : $this->search_default;
        $value['limit_per_page'] = (isset($value['limit_per_page'])) ? $value['limit_per_page'] : $this->limit_page;
        $jurusans = $this->search_jurusan($value['search'],$value['limit_per_page']);
        return view('Admin.jurusan.index',['jurusans' => $jurusans]);
    }

    public function create_jurusan(R_J_Create $request){
       $value = $request->validated();
       $create = $this->send_jurusan($value['nama']);
       return redirect()->route('admin.univeritas.jurusan', ['limit_per_page' => 10]);
    }

    public function update_jurusan(R_J_Update $request){
        $value = $request->validated();
        $update = $this->send_update_jurusan($value['id'],$value['nama']);
        return redirect()->route('admin.univeritas.jurusan', ['limit_per_page' => 10]);
    }

    public function delete_jurusan(R_J_Delete $request){
        $value = $request->validated();
        $delete = $this->send_delete_jurusan($value['id']);
        return redirect()->route('admin.univeritas.jurusan', ['limit_per_page' => 10]);
    }
}

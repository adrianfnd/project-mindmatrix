<?php

namespace App\Http\Controllers\Route\User\Univeristas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//  Request
//  Component
use App\Http\Controllers\Component\Universitas\univeritasController as C_univeritas;
use App\Http\Requests\Default\Search as R_Search;

class Univeristas_controller extends C_univeritas
{
    private $limit_page = 10;
    private $search_default = null;
    public function dashboard(R_Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : $this->search_default;
        $value['limit_per_page'] = (isset($value['limit_per_page'])) ? $value['limit_per_page'] : $this->limit_page;
        $universitas = $this->search_universitas($value['search'],$value['limit_per_page']);
        return view('User.Univeritas.index',['universitas' => $universitas]);
    }
}

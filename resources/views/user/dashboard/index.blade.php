@extends('user.layouts.app')

@section('breadcrumb', 'Dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row col mb-1">
            <h4 class="mb-3 text-white">Biodata</h4>
        </div>
        <div class="row card mb-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <img src="{{ asset('assets/image_asset/undraw_pic_profile_re_7g2h.svg') }}" alt="foto_profile"
                            class="rounded rounded-circle" srcset="" width="175">
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <h4>{{ $biodata['nama_lengkap'] }}</h4>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Email</label>
                            <div class="input-group">
                                <h5>{{ $biodata['email'] }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-center"><strong>Total Test Yang Sudah di Kerjakan</strong></h5>
                            </div>
                        </div>
                        <div class="row" style="height: 175px;">
                            <div class="col d-flex justify-content-center align-items-center">
                                <h1 class="text-center"><strong>{{ $biodata['count_test'] }}</strong></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col mb-1">
            <h5>Top Test List</h5>
        </div>
        <div class="row">
            @if ($tests->count() != 0)
                @foreach ($tests as $test)
                    <div class="col">
                        <div class="card" style="width:18rem">
                            <img src="{{ asset('assets/image_asset/undraw_design_inspiration_re_tftx.svg') }}"
                                class="card-img-top p-4" alt="image_minta_bakat">
                            <div class="card-body">
                                <h5 class="card-title col text-center">{{ $test['nama_test'] }}</h5>
                                <p class="card-text">{{ $test['desc_test'] }}</p>
                                <a href="{{ route('user.minat.dashboard') }}" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@extends('Admin.Template.app')
@section('title')
Minat Bakat > Settings > {{$summary['nama_bakat']}} > Edit
@endsection
@section('content')
<div class="container-fluid">
    <div class="row card mb-3">
        <div class="card-header">
            <h5>Summary</h5>
        </div>
        <div class="card-body">
            <form action="{{route('admin.minta.setting.summary.edit.update',['id' => $summary['id']])}}" method="post">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{$summary['id']}}">
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <label for="nama_summary">Summary</label>
                            <input type="text" class="form-control" name="nama" id="nama_summary"
                                placeholder="Nama Summary" value="{{$summary['nama_bakat']}}">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <label for="floatingTextarea2">Keterangan</label>
                            <textarea class="form-control"name ="keterangan" placeholder="Keterangan summary" id="keterangan"
                                style="height: 100px">{{$summary['keterangan']}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary mx-1" type="submit">Update</button>
                        <a class="btn btn-danger ms-1"
                            href="{{route('admin.minat.setting.dashboard', ['limit_per_page' => 10])}}">Batal</a>

                    </div>
                </div>
            </form>
            <!--  Belum beres -->
            <!-- <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label for="floatingSelect">Jurusan Kampus</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <select class="form-select" id="jurusan" aria-label="Jurusan Universtitas yang cocok">
                                <option selected>Open this select menu</option>
                                <option value="1">Teknik informatika</option>
                                <option value="2">Siystem infromasi</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection
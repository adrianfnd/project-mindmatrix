@extends('Admin.Template.app')
@section('title')
Minat Bakat > Settings
@endsection
@section('content')
<div class="container-fluid">
    <div class="row col mb-3">
        @include('Admin.Template.card_header')
    </div>
    <!-- Desctiotion -->
    <div class="row card mb-3">
        <div class="card-header ">
            <div class="row">
                <div class="col">
                    <h5>Description Minat bakat</h5>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal_edit_description">
                        <img src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            class="m-1" /> Edit Description
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(isset($description))
                <p>{{$description['desc_test']}}</p>
            @else
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati possimus quisquam ipsa amet
                    repudiandae neque ut culpa exercitationem, nihil natus hic laborum voluptates vitae harum! Sit tempore
                    excepturi maxime necessitatibus.</p>
            @endif
        </div>
    </div>
    <!-- End Desctiption -->
    <!-- Modal Description -->
    <div class="modal fade" id="modal_edit_description" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('admin.minat.setting.description')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="container-fluid">
                            <div class="row justify-content-end">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="hidden" name="id"
                                        value="{{(isset($description)) ? $description['id'] : ""}}">
                                    <div class="row">
                                        <label>Description Test</label>
                                    </div>
                                    <div class="row">
                                        <textarea name="desc" class="form-control" cols="50"
                                            rows="10">{{(isset($description)) ? $description['desc_test'] : ""}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <button type="submit" class="btn btn-success">Upload</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- List Soal -->
    <div class="row card mb-3">
        <div class="card-header">
            <h5>list Soal</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-conten-start">
                    <form action="{{route('admin.minat.setting.dashboard')}}" method="get">
                        @csrf
                        @method('GET')
                        <div class="input-group" style="width:30rem;">
                            <input type="text" class="form-control" name="search" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <input type="hidden" name="limit_per_page" value="10" />
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Serach</button>
                        </div>
                    </form>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="{{route('admin.minat.setting.soal.create')}}" type="button" class="btn btn-primary"><img
                            src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            style="margin-right:5px;" /> Create Soal
                    </a>
                </div>
            </div>
            <div class="mt-3">
                <div class="row ">
                    <div class="col ">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Pertanyaan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($questions->count() != 0)
                                    @foreach ($questions->items() as $value)
                                        <tr>
                                            <td scope="col" class="text-center">
                                                {{($loop->index + ($questions->perPage() * ($questions->currentPage() - 1))) + 1}}
                                            </td>
                                            <td scope="col">{{$value->jawaban}}</td>
                                            <td scope="col" class="text-center">
                                                <div class="row">
                                                    <div class="col m-0 p-0">
                                                        <button class="btn btn-warning rounded edit-btn"
                                                            data-id="{{$value['id']}}" data-nama="{{$value['jawaban']}}"
                                                            data-id_summary="{{$value->summary->id}}">
                                                            <img src="   https://cdn-icons-png.flaticon.com/512/1159/1159633.png "
                                                                alt="icon_edit" height="18">
                                                        </button>
                                                    </div>
                                                    <div class="col m-0 p-0">
                                                        <form action="{{route('admin.minat.setting.soal.delete')}}"
                                                            method="post">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="id" value="{{$value['id']}}" />
                                                            <button class="btn btn-danger rounded">
                                                                <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                                    alt="icon_delete" height="18">
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <!-- belum beres -->
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End list soal -->
    <!-- Modal -->
    <div class="modal fade" id="modal_edit_soal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('admin.minat.setting.soal.edit')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="container-fluid">
                            <div class="row justify-content-end">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="hidden" name="id_soal" id="id_soal">
                                    <textarea  name="pertanyaan" class="form-control" placeholder="Soal" id="pertanyaan"required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <select name="id_summary" class="form-control"
                                        id="summary" required>
                                        @foreach ($summarys as $value)
                                            <option value="{{$value['id']}}">{{$value['nama_bakat']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <button type="submit" class="btn btn-success">Upload</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.edit-btn').click(function () {
        let id = $(this).data('id');
        let nama = $(this).data('nama');
        let id_summary = $(this).data('id_summary');
        $('#id_soal').val(id);
        $('#pertanyaan').val(nama);
        $('#summary').val(id_summary);
        $('#modal_edit_soal').modal('show');
    });
</script>
@endsection
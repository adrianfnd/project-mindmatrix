@extends('Admin.Template.app')
@section('title')
Univeritas > Jurusan
@endsection
@section('content')
<div class="container-fluid">
    <div class="row card mb-3">
        <div class="card-header">
            <h5>list Jurusan</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-conten-start">
                    <form action="{{route('admin.univeritas.jurusan')}}" method="get">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal_create_jurusan">
                        <img src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            class="m-1" /> Create Jurusan
                    </button>

                </div>
            </div>
            <div class="mt-3">
                <div class="row ">
                    <div class="col ">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($jurusans->count() != 0)
                                    @foreach ($jurusans->items() as $value)
                                        <tr>
                                            <td scope="col" class="text-center">
                                                {{($loop->index + ($jurusans->perPage() * ($jurusans->currentPage() - 1))) + 1}}
                                            </td>
                                            <td scope="col">{{$value->nama_jurusan}}</td>
                                            <td scope="col" class="text-center">
                                                <div class="row">
                                                    <div class="col m-0 p-0">
                                                        <button class="btn btn-warning rounded edit-btn"
                                                        data-id="{{$value['id']}}" 
                                                        data-nama="{{$value['nama_jurusan']}}">
                                                            <img src="   https://cdn-icons-png.flaticon.com/512/1159/1159633.png "
                                                                alt="icon_edit" height="18">
                                                        </button>
                                                    </div>
                                                    <div class="col m-0 p-0">
                                                    <div class="col m-0 p-0">
                                                        <form action="{{route('admin.univeritas.jurusan.delete')}}"
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
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <!-- belum beres -->
                                @endif
                            </tbody>
                        </table>
                        {{$jurusans->links('Layout.Pagination.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End list jurusan-->
     <!-- modal Create -->
     <div class="modal fade" id="modal_create_jurusan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Jurusan</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.univeritas.jurusan.create') }}"method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value=""/>
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row">
                                    <label>Nama Jurusan</label>
                                </div>
                                <div class="row">
                                    <div class="input-group flex-nowrap">
                                        <input type="text" class="form-control" placeholder="Nama jurusan" name="nama" aria-label="nama jurusan" aria-describedby="addon-wrapping">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <button type="button" class="btn btn-default mx-2" data-dismiss="modal">Close</button>
                            <button id="submit_button" type="submit" class="btn btn-success mx-2">Create</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-btn');
        var modal = document.getElementById('modal_create_jurusan');
        var modalTitle = modal.querySelector('.modal-title');
        var form = modal.querySelector('form');
        var inputNama = form.querySelector('input[name="nama"]');
        var hiddenInputId = form.querySelector('input[name="id"]');
        var submitButton = document.getElementById('submit_button');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var nama = this.getAttribute('data-nama');
                inputNama.value = nama;
                
                if (id) {
                    submitButton.classList.remove('btn-success');
                    submitButton.classList.add('btn-primary'); 
                    submitButton.innerText = "Update";
                    hiddenInputId.value = id;
                    modalTitle.innerText = "Edit Jurusan";
                    form.action = "{{route('admin.univeritas.jurusan.update')}}"; 
                    form.method = "POST";
                    
                } else {
                    submitButton.innerText = "Create";
                    submitButton.classList.remove('btn-primary');
                    submitButton.classList.add('btn-success');
                    hiddenInputId.value = "";
                    modalTitle.innerText = "Create Jurusan"; 
                    form.action = "{{route('admin.univeritas.jurusan.create')}}";
                    form.method = "POST"; 
                  
                    
                }
                
                $('#modal_create_jurusan').modal('show');
            });
        });
        $('#modal_create_jurusan').on('hidden.bs.modal', function () {
            modalTitle.innerText = "Create Jurusan";
            inputNama.value = ""; 
            hiddenInputId.value = "";
            submitButton.innerText = "Create";
            submitButton.classList.remove('btn-primary');
            submitButton.classList.add('btn-success');
            form.action = "{{route('admin.univeritas.jurusan.create')}}"; 
            form.method = "POST";
        });
    });
</script>
@endsection
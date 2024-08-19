@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Jurusan')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <div class="container-fluid">
        <div class="row card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>List Jurusan</h5>
            </div>
            <div class="card-body">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_create_jurusan">
                        <img src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            class="m-1" /> Create Jurusan
                    </button>
                </div>
                <form action="{{ route('admin.univeritas.jurusan') }}" method="get">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                aria-label="Search..." aria-describedby="button-addon2">
                            <input type="hidden" name="limit_per_page" value="10" />
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit" id="button-addon2">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <button class="btn btn-secondary" type="button" id="resetButton">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if ($jurusans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurusans->items() as $value)
                                <tr class="text-center">
                                    <td>
                                        {{ $loop->index + $jurusans->perPage() * ($jurusans->currentPage() - 1) + 1 }}
                                    </td>
                                    <td>{{ $value->nama_jurusan }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-warning rounded edit-btn" data-id="{{ $value['id'] }}"
                                                data-nama="{{ $value['nama_jurusan'] }}">
                                                <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"
                                                    alt="icon_edit" height="18">
                                            </button>
                                            <form action="{{ route('admin.univeritas.jurusan.delete') }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{ $value['id'] }}" />
                                                <button class="btn btn-danger rounded" style="margin-left: 5px;">
                                                    <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                        alt="icon_delete" height="18">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    {{ $jurusans->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-warning text-center">No data found.</div>
            @endif
        </div>

        <div class="modal fade" id="modal_create_jurusan" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.univeritas.jurusan.create') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">

                            <input type="hidden" name="id" value="" />
                            <div class="container-fluid">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label>Nama Jurusan</label>
                                        </div>
                                        <div class="row">
                                            <div class="input-group flex-nowrap">
                                                <input type="text" class="form-control" placeholder="Nama jurusan"
                                                    name="nama" aria-label="nama jurusan"
                                                    aria-describedby="addon-wrapping">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-success mx-2">Create</button>
                                <button type="button" class="btn btn-secondary mx-2"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        form.action = "{{ route('admin.univeritas.jurusan.update') }}";
                        form.method = "POST";

                    } else {
                        submitButton.innerText = "Create";
                        submitButton.classList.remove('btn-primary');
                        submitButton.classList.add('btn-success');
                        hiddenInputId.value = "";
                        modalTitle.innerText = "Create Jurusan";
                        form.action = "{{ route('admin.univeritas.jurusan.create') }}";
                        form.method = "POST";


                    }

                    $('#modal_create_jurusan').modal('show');
                });
            });
            $('#modal_create_jurusan').on('hidden.bs.modal', function() {
                modalTitle.innerText = "Create Jurusan";
                inputNama.value = "";
                hiddenInputId.value = "";
                submitButton.innerText = "Create";
                submitButton.classList.remove('btn-primary');
                submitButton.classList.add('btn-success');
                form.action = "{{ route('admin.univeritas.jurusan.create') }}";
                form.method = "POST";
            });
        });
    </script>
@endsection

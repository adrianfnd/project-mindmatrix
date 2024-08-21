@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Jurusan')

@section('content')
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
                <form id="searchForm" class="mb-4">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Search jurusan...">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit" id="searchButton">
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
                    <table class="table table-bordered table-hover" id="jurusanTable">
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
                                            <form action="{{ route('admin.univeritas.jurusan.delete') }}" method="post"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?');">
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

        <div class="modal fade" id="modal_create_jurusan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Jurusan</h5>
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
                                <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_edit_jurusan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJurusanLabel">Edit Jurusan</h5>
                    </div>
                    <form id="editJurusanForm" action="{{ route('admin.univeritas.jurusan.update') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit_jurusan_id">
                            <div class="form-group">
                                <label for="edit_nama_jurusan">Nama Jurusan</label>
                                <input type="text" class="form-control" id="edit_nama_jurusan" name="nama"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                function performSearch() {
                    var searchText = $('#searchInput').val().toLowerCase();
                    $('#jurusanTable tbody tr').each(function() {
                        var rowText = $(this).text().toLowerCase();
                        if (rowText.indexOf(searchText) === -1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                }

                function resetSearch() {
                    $('#searchInput').val('');
                    $('#jurusanTable tbody tr').show();
                }

                $('#searchForm').on('submit', function(e) {
                    e.preventDefault();
                    performSearch();
                });

                $('#resetButton').on('click', function() {
                    resetSearch();
                });

                $('#searchInput').on('keyup', function(e) {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });
            });


            document.addEventListener('DOMContentLoaded', function() {
                var editButtons = document.querySelectorAll('.edit-btn');
                const closeButton = document.querySelector('#modal_edit_jurusan .btn-secondary');
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


                editButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var id = this.getAttribute('data-id');
                        var nama = this.getAttribute('data-nama');

                        document.getElementById('edit_jurusan_id').value = id;
                        document.getElementById('edit_nama_jurusan').value = nama;

                        $('#modal_edit_jurusan').modal('show');
                    });
                });

                closeButton.addEventListener('click', function() {
                    $('#modal_edit_jurusan').modal('hide');
                });
            });
        </script>
    @endsection

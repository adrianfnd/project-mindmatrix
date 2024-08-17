@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Settings Page')

@section('content')
    <div class="container-fluid">
        <div class="row col mb-3">
            <div class="row col d-flex justify-content-between">
                <div class="col card m-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="row">Total Soal</h5>
                                <h3 class="row col text-center">{{ $questions->count() }}</h>
                            </div>
                            <div class="col d-flex justify-content-center">
                                <img src="{{ asset('/assets/image_asset/icon_Soal.png') }}" class="m-0" alt="icon Soal"
                                    width="125">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col card m-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="row">Total User Mengerjakan</h5>
                                <h3 class="row col text-center">{{ $users->count() }}</h>
                            </div>
                            <div class="col d-flex justify-content-center">
                                <img src="{{ asset('/assets/image_asset/icon_total_user.png') }}" class="m-0"
                                    alt="icon Soal" width="125">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Description Minat Bakat</h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_description">
                    <i class="fas fa-edit me-1"></i> Edit Description
                </button>
            </div>
            <div class="card-body">
                @if (isset($description))
                    <p>{{ $description['desc_test'] }}</p>
                @else
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati possimus quisquam ipsa amet
                        repudiandae neque ut culpa exercitationem, nihil natus hic laborum voluptates vitae harum! Sit
                        tempore excepturi maxime necessitatibus.</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">List Soal</h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_create_soal">
                    <i class="fas fa-plus me-1"></i> Create Soal
                </button>
            </div>
            <div class="card-body">
                <form id="searchForm" action="{{ route('admin.minat.setting.dashboard') }}" method="get" class="mb-4">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Search question...">
                            <input type="hidden" name="limit_per_page" value="10" />
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

                @if ($questions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="questionsTable">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Pertanyaan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td class="text-center">{{ $questions->firstItem() + $loop->index }}</td>
                                        <td>{{ $question->jawaban }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-warning btn-sm edit-btn"
                                                    data-id="{{ $question->id }}" data-nama="{{ $question->jawaban }}"
                                                    data-id_summary="{{ $question->summary->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.minat.setting.soal.delete') }}"
                                                    method="post"
                                                    onsubmit="return confirm('Are you sure you want to delete this question?');">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id" value="{{ $question->id }}" />
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i class="fas fa-trash-alt"></i>
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
                        {{ $questions->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">No questions found.</div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_description" tabindex="-1" role="dialog"
        aria-labelledby="editDescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDescriptionModalLabel">Edit Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.minat.setting.description') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="id"
                            value="{{ isset($description) ? $description['id'] : '' }}">
                        <div class="form-group">
                            <label for="desc">Description Test</label>
                            <textarea name="desc" id="desc" class="form-control" rows="10">{{ isset($description) ? $description['desc_test'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_soal" tabindex="-1" role="dialog" aria-labelledby="editQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.minat.setting.soal.edit') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="id_soal" id="id_soal">
                        <div class="form-group">
                            <label for="pertanyaan">Question</label>
                            <textarea name="pertanyaan" id="pertanyaan" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <select name="id_summary" id="summary" class="form-control" required>
                                @foreach ($summarys as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['nama_bakat'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_create_soal" tabindex="-1" role="dialog"
        aria-labelledby="createQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createQuestionModalLabel">Create Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.minat.setting.soal.send') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Pertanyaan</th>
                                    <th scope="col">Summary</th>
                                </tr>
                            </thead>
                            <tbody id="input_area">
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 text-left">
                                <button class="btn btn-primary m-1" type="button" onclick="addRow()">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let id_summary = $(this).data('id_summary');
                $('#id_soal').val(id);
                $('#pertanyaan').val(nama);
                $('#summary').val(id_summary);
                $('#modal_edit_soal').modal('show');
            });

            function performSearch() {
                $('#searchForm').submit();
            }

            function resetSearch() {
                $('#searchInput').val('');
                $('#searchForm').submit();
            }

            $('#searchButton').on('click', performSearch);

            $('#resetButton').on('click', resetSearch);

            $('#searchInput').on('keyup', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        });

        function addRow() {
            const tableBody = document.getElementById('input_area');
            const rowCount = tableBody.getElementsByTagName('tr').length;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                    <td scope="col" class="text-center align-middle">${rowCount + 1}</td>
                    <td scope="col">
                        <textarea class="form-control" placeholder="Leave a comment here"
                            name="jawaban[pertanyaan][${rowCount}]" id="floatingTextarea" rows="1" required></textarea>
                    </td>
                    <td scope="col">
                        <select name="jawaban[id_summar][${rowCount}]" class="form-control" id="inputGroupSelect01" required>
                            <option selected>Choose...</option>
                            @foreach ($summarys as $value)
                            <option value="{{ $value['id'] }}">{{ $value['nama_bakat'] }}</option>
                            @endforeach
                        </select>
                    </td>
                `;
            tableBody.appendChild(newRow);
        }

        $('#modal_create_soal').on('shown.bs.modal', function() {
            if ($('#input_area').children().length === 0) {
                addRow();
            }
        });

        window.addRow = addRow;
    </script>
@endsection

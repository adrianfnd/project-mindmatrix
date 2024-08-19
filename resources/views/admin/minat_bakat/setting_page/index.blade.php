@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Settings Page')
@section('content')
    <div class="container-fluid">
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
                @if (isset($description))
                    <p>{{ $description['desc_test'] }}</p>
                @else
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati possimus quisquam ipsa amet
                        repudiandae neque ut culpa exercitationem, nihil natus hic laborum voluptates vitae harum! Sit
                        tempore
                        excepturi maxime necessitatibus.</p>
                @endif
            </div>
        </div>
        <!-- End Desctiption -->

        <!-- Modal Description -->
        <div class="modal fade" id="modal_edit_description" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('admin.minat.setting.description') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="container-fluid">
                                <div class="row mb-1">
                                    <div class="col">
                                        <div class=" d-flex align-items-center justify-content-start">
                                            <label class="mb-0">Description Test</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="hidden" name="id"
                                            value="{{ isset($description) ? $description['id'] : '' }}">
                                        <textarea name="desc" class="form-control" cols="50" rows="10">{{ isset($description) ? $description['desc_test'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success mx-2">Upload</button>
                                        <button type="button" class="btn btn-secondary mx-2"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="row card mb-2">
            <div class="card-header">
                <h5>Summary</h5>
            </div>
            <div class="card-body">
                <div class="row ">
                    @if ($summarys->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Summary</th>
                                        <th scope="col">Jumlah Soal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomer = 1; ?>
                                    @foreach ($summarys as $value)
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $nomer;
                                                $nomer++; ?>
                                            </td>
                                            <td>{{ $value->nama_bakat }}</td>
                                            <td>{{ $value->jumlah_soal }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.minat.setting.summary.edit', ['id' => $value['id']]) }}"
                                                    class="btn btn-warning rounded">
                                                    <img src=" https://cdn-icons-png.flaticon.com/512/1159/1159633.png "
                                                        alt="icon_edit" height="18"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning text-center">No data found.</div>
                    @endif
                </div>
            </div>
        </div>
        <!-- End Summary -->

        <!-- List Soal -->
        <div class="row card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>List Soal</h5>
            </div>
            <div class="card-body">
                <div class="col d-flex justify-content-end">
                    <a href="{{ route('admin.minat.setting.soal.create') }}" type="button" class="btn btn-primary"><img
                            src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            style="margin-right:5px;" /> Create Soal
                    </a>
                </div>
                <form action="{{ route('admin.minat.setting.dashboard') }}" method="get">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Search..." aria-describedby="button-addon2">
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
                @if ($questions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Pertanyaan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions->items() as $value)
                                    <tr class="text-center">
                                        <td class="text-center">
                                            {{ $loop->index + $questions->perPage() * ($questions->currentPage() - 1) + 1 }}
                                        </td>
                                        <td>{{ $value->jawaban }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-warning rounded edit-btn"
                                                    data-id="{{ $value['id'] }}" data-nama="{{ $value['jawaban'] }}"
                                                    data-id_summary="{{ $value->summary->id }}">
                                                    <img src="   https://cdn-icons-png.flaticon.com/512/1159/1159633.png "
                                                        alt="icon_edit" height="18">
                                                </button>
                                                <form action="{{ route('admin.minat.setting.soal.delete') }}"
                                                    method="post">
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
                        {{ $questions->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">No data found.</div>
                @endif
            </div>
        </div>
        <!-- End list soal -->

        <!-- Modal -->
        <div class="modal fade" id="modal_edit_soal" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('admin.minat.setting.soal.edit') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="container-fluid">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <label class="mb-0">Edit Soal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="hidden" name="id_soal" id="id_soal">
                                    <textarea name="pertanyaan" class="form-control" placeholder="Soal" id="pertanyaan" rows="10" required></textarea>
                                    <label for="pertanyaan">Pertanyaan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="id_summary" class="form-control" id="summary" required>
                                        @foreach ($summarys as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['nama_bakat'] }}</option>
                                        @endforeach
                                    </select>
                                    <label for="summary">Summary</label>
                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success mx-2">Upload</button>
                                        <button type="button" class="btn btn-secondary mx-2"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var nama = this.getAttribute('data-nama');
                    var id_summary = this.getAttribute('data-id_summary');

                    document.getElementById('id_soal').value = id;
                    document.getElementById('pertanyaan').value = nama;
                    document.getElementById('summary').value = id_summary;

                    var modal = new bootstrap.Modal(document.getElementById('modal_edit_soal'));
                    modal.show();
                });
            });

            var resetButton = document.getElementById('resetButton');
            var searchInput = document.getElementById('searchInput');

            resetButton.addEventListener('click', function() {
                searchInput.value = '';
                document.querySelector('form[action="{{ route('admin.minat.setting.dashboard') }}"]')
                    .submit();
            });
        });
    </script>
@endsection

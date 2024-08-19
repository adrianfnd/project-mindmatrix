{{-- @extends('Admin.Template.app')
@section('title')
Minat Bakat > Settings > {{$summary['nama_bakat']}} > Edit
@endsection --}}
@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Settings Create Soal')
@section('content')
    <div class="container-fluid">
        <div class="row card mb-3">
            <div class="card-header">
                <h5>Summary</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.minta.setting.summary.edit.update', ['id' => $summary['id']]) }}"
                    method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value="{{ $summary['id'] }}">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="nama_summary">Summary</label>
                                <input type="text" class="form-control" name="nama" id="nama_summary"
                                    placeholder="Nama Summary" value="{{ $summary['nama_bakat'] }}">

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="floatingTextarea2">Keterangan</label>
                                <textarea class="form-control" name="keterangan" placeholder="Keterangan summary" id="keterangan" style="height: 100px">{{ $summary['keterangan'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary mx-1" type="submit">Update</button>
                            <a class="btn btn-danger ms-1"
                                href="{{ route('admin.minat.setting.dashboard', ['limit_per_page' => 10]) }}">Batal</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Rekomendasi Jurusan -->
        <div class="row card mb-3">
            <div class="card-header">
                <h5>Rekomendasi Jurusan</h5>
            </div>
            <form action="{{ route('admin.minta.setting.summary.jurusan.send', ['id' => $summary['id']]) }}" method="post">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value="{{ $summary['id'] }}">
                    <div class="col">
                        @if ($summary->jurusan->count() != 0)
                            @foreach ($summary->jurusan as $jurusan_selectd)
                                <div id="pilihan-container">
                                    <div class="row mb-2 pilihan-item">
                                        <div class="col-auto row mb-0 text-start align-items-center">
                                            <h5 class="m-0">Pilihan 1 :</h5>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="jurusan[0]"
                                                aria-label="Default select example">
                                                <option selected>Open this select Jurusan</option>
                                                @foreach ($jurusans as $jurusan)
                                                    <option value="{{ $jurusan['id'] }}"
                                                        @if ($jurusan['id'] == $jurusan_selectd['id']) selected @endif>
                                                        {{ $jurusan['nama_jurusan'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto justify-content-center align-items-center">
                                            <button class="btn btn-danger rounded remove-pilihan" disabled>
                                                <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                    alt="icon_delete" height="18">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div id="pilihan-container">
                                <div class="row mb-2 pilihan-item">
                                    <div class="col-auto row mb-0 text-start align-items-center">
                                        <h5 class="m-0">Pilihan 1 :</h5>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" name="jurusan[0]" aria-label="Default select example">
                                            <option selected>Open this select Jurusan</option>
                                            @foreach ($jurusans as $jurusan)
                                                <option value="{{ $jurusan['id'] }}">{{ $jurusan['nama_jurusan'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto justify-content-center align-items-center">
                                        <button class="btn btn-danger rounded remove-pilihan" disabled>
                                            <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                alt="icon_delete" height="18">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary mx-1" type="button" id="add-pilihan">+</button>
                            <button class="btn btn-primary mx-1" type="submit">Update</button>
                            <a class="btn btn-danger ms-1"
                                href="{{ route('admin.minat.setting.dashboard', ['limit_per_page' => 10]) }}">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var pilihanCount = 1;

            $('#add-pilihan').click(function() {
                pilihanCount++;
                var newPilihan = `
            <div class="row mb-2 pilihan-item">
                <div class="col-auto row mb-0 text-start align-items-center">
                    <h5 class="m-0">Pilihan ` + pilihanCount + ` :</h5>
                </div>
                <div class="col">
                    <select class="form-select" name="jurusan[` + pilihanCount + `]" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan['id'] }}">{{ $jurusan['nama_jurusan'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto justify-content-center align-items-center">
                    <button class="btn btn-danger rounded remove-pilihan">
                        <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" alt="icon_delete" height="18">
                    </button>
                </div>
            </div>
        `;
                $('#pilihan-container').append(newPilihan);
                checkRemoveButtonState();
            });

            $(document).on('click', '.remove-pilihan', function() {
                if ($('.pilihan-item').length > 1) {
                    $(this).closest('.pilihan-item').remove();
                    pilihanCount--;
                    updatePilihanLabels();
                    checkRemoveButtonState();
                }
            });

            function updatePilihanLabels() {
                $('#pilihan-container .pilihan-item').each(function(index) {
                    $(this).find('h5.m-0').text('Pilihan ' + (index + 1) + ' :');
                });
            }

            function checkRemoveButtonState() {
                if ($('.pilihan-item').length === 1) {
                    $('.remove-pilihan').prop('disabled', true);
                } else {
                    $('.remove-pilihan').prop('disabled', false);
                }
            }
            checkRemoveButtonState();
        });
    </script>
@endsection

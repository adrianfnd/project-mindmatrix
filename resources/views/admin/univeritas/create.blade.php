@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', isset($universitas) ? 'Update Universitas' : 'Create Universitas')
@section('content')
    <div class="container-fluid">
        <div class="row card mb-3">
            <div class="card-header">
                <h5>{{ isset($universitas) ? 'Update' : 'Create' }} University</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data"
                    action="{{ isset($universitas) ? route('admin.univeritas.dashboard.update.send') : route('admin.univeritas.dashboard.create.send') }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    @if (isset($universitas))
                        <input type="hidden" name="id" value="{{ $universitas['id'] }}">
                    @endif

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="text-center">
                                <img id="previewImage"
                                    src="{{ isset($universitas) ? $universitas['image_logo'] : 'https://via.placeholder.com/300x300' }}"
                                    alt="University Logo" class="img-fluid mb-3"
                                    style="width: 300px; height: 300px; object-fit: cover;">

                                <div class="input-group">
                                    <input type="file" class="form-control" id="myFile" name="filename"
                                        accept="image/*" style="display: none;" onchange="previewFile()">
                                </div>

                                <span id="file-chosen" class="d-block mt-2">No file chosen</span>

                                <button type="button" class="btn btn-primary mt-2"
                                    onclick="document.getElementById('myFile').click();">Upload</button>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Universitas</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukan nama universitas"
                                    value="{{ isset($universitas) ? $universitas['nama_kampus'] : '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="akreditasi" class="form-label">Akreditasi</label>
                                <select class="form-control" name="akreditasi" id="akreditasi">
                                    <option value="">Pilih Akreditasi</option>
                                    <option value="A"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'A' ? 'selected' : '' }}>A
                                    </option>
                                    <option value="B"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'B' ? 'selected' : '' }}>B
                                    </option>
                                    <option value="C"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'C' ? 'selected' : '' }}>C
                                    </option>
                                    <option value="Unggul"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'Unggul' ? 'selected' : '' }}>
                                        Unggul</option>
                                    <option value="Baik Sekali"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'Baik Sekali' ? 'selected' : '' }}>
                                        Baik Sekali</option>
                                    <option value="Baik"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'Baik' ? 'selected' : '' }}>
                                        Baik</option>
                                    <option value="Tidak Terakreditasi"
                                        {{ isset($universitas) && $universitas['akreditasi'] == 'Tidak Terakreditasi' ? 'selected' : '' }}>
                                        Tidak Terakreditasi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukan alamat anda">{{ isset($universitas) ? $universitas['alamat'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">List Jurusan</h5>
                            <button type="button" id="add-pilihan" class="btn btn-primary">
                                Add Jurusan
                            </button>
                        </div>
                        <div id="pilihan-container">
                            @if (isset($universitas) && isset($universitas['jurusan']))
                                @foreach ($universitas['jurusan'] as $index => $selectedJurusan)
                                    <div class="row mb-2 pilihan-item">
                                        <div class="col-auto row mb-0 text-start align-items-center">
                                            <h6 class="mb-0">Pilihan {{ $index + 1 }}:</h6>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="jurusan[{{ $index }}]">
                                                <option>Select Jurusan</option>
                                                @foreach ($jurusans as $jurusan)
                                                    <option value="{{ $jurusan['id'] }}"
                                                        {{ $selectedJurusan['id'] == $jurusan['id'] ? 'selected' : '' }}>
                                                        {{ $jurusan['nama_jurusan'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto justify-content-center align-items-center">
                                            <button class="btn btn-danger rounded remove-pilihan"
                                                {{ $index == 0 ? 'disabled' : '' }}>
                                                <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                    alt="icon_delete" height="18">
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row mb-2 pilihan-item">
                                    <div class="col-auto row mb-0 text-start align-items-center">
                                        <h6 class="mb-0">Pilihan 1:</h6>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" name="jurusan[0]">
                                            <option selected>Select Jurusan</option>
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
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('admin.univeritas.dashboard', ['limit_per_page' => 8]) }}"
                            class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('myFile').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('file-chosen').textContent = fileName;
        });

        $(document).ready(function() {
            var pilihanCount = 1;

            $('#add-pilihan').click(function() {
                pilihanCount++;
                var newPilihan = `
        <div class="row mb-2 pilihan-item">
            <div class="col-auto row mb-0 text-start align-items-center">
                <h6 class="mb-0">Pilihan ${pilihanCount}:</h6>
            </div>
            <div class="col">
                <select class="form-select" name="jurusan[${pilihanCount-1}]">
                    <option selected>Open this select menu</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan['id'] }}">{{ $jurusan['nama_jurusan'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto justify-content-center align-items-center">
                <button class="btn btn-danger rounded remove-pilihan" disabled>
                    <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" alt="icon_delete"
                        height="18">
                </button>
            </div>
        </div>
        `;
                $('#pilihan-container').append(newPilihan);
                checkRemoveButtonState();
                zz
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
                    $(this).find('h6.mb-0').text('Pilihan ' + (index + 1) + ':');
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

        function previewFile() {
            const fileInput = document.getElementById('myFile');
            const previewImage = document.getElementById('previewImage');
            const fileChosen = document.getElementById('file-chosen');

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                previewImage.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
                fileChosen.textContent = file.name;
            }
        }
    </script>
@endsection

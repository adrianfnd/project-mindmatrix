@extends('Admin.Template.app')
@section('title')
Universitas > @if(isset($universitas)) Update > {{$universitas['nama_kampus']}} @else  Create @endif
@endsection
@section('content')
<div class="container-fluid full-height d-flex justify-content-center align-items-center">
    <form enctype="multipart/form-data" action="@if(isset($universitas)){{route('admin.univeritas.dashboard.update.send')}} @else {{route('admin.univeritas.dashboard.create.send')}}@endif" method="POST">
        @csrf
        @method('POST')
        @if(isset($universitas))
            <input type="hidden" name="id" value="{{$universitas['id']}}">
        @endif
        <div class="card" style="width: 40rem;">
            <div class="card-header">
                <h4 class="card-title text-center">@if(isset($universitas)) Update @else Create Universitas @endif</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-5">
                        @if(isset($universitas))
                        <img id="previewImage" src="{{$universitas['image_logo']}}" alt="Card image" class="mb-3"
                            height="300" width="200">
                        <input type="file" id="myFile" name="filename" accept="image/*">
                        @else
                        <img id="previewImage" src="https://via.placeholder.com/500x200" alt="Card image" class="mb-3"
                            height="300" width="200">
                        <input type="file" id="myFile" name="filename" accept="image/*">
                        @endif
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nama Universitas</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Masukan nama universitas"@if(isset($universitas)) value="{{$universitas['nama_kampus']}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="akreditasi">Akreditasi</label>
                            <input type="text" class="form-control" name="akreditasi" id="akreditasi"
                                placeholder="Masukan Akreditasi Kampus Anda"@if(isset($universitas))value="{{$universitas['akreditasi']}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3"
                                placeholder="Masukan alamat anda">@if(isset($universitas)){{$universitas['alamat']}}@endif</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ms-2 d-flex justify-content-start align-items-center">
                <div class="col d-flex align-items-center">
                    <h5 class="m-0">List Jurusan</h5>
                    <button type="button" id="add-pilihan" class="btn btn-primary rounded ms-2">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <hr>
            <div id="pilihan-container">
                @if(isset($universitas))
                @foreach($universitas->jurusan as $key => $value)
                <div class="row mb-3 pilihan-item">
                    <div class="col-3 row mb-0 text-center align-items-center">
                        <h5 class="m-0">Pilihan {{$key + 1}} :</h5>
                    </div>
                    <div class="col me-3">
                        <select class="form-select" name="jurusan[0]" aria-label="Default select example">
                            <option selected>Open this select Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{$jurusan['id']}}" @if($value['id'] == $jurusan['id'])selected @endif>{{$jurusan['nama_jurusan']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 row mb-0 text-center align-items-center">
                        <button class="btn btn-danger rounded remove-pilihan" disabled>
                            <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" alt="icon_delete"
                                height="18">
                        </button>
                    </div>
                    <div class="col-1"></div>
                </div>
                @endforeach
                @else
                <div class="row mb-3 pilihan-item">
                    <div class="col-3 row mb-0 text-center align-items-center">
                        <h5 class="m-0">Pilihan 1 :</h5>
                    </div>
                    <div class="col me-3">
                        <select class="form-select" name="jurusan[0]" aria-label="Default select example">
                            <option selected>Open this select Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{$jurusan['id']}}">{{$jurusan['nama_jurusan']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 row mb-0 text-center align-items-center">
                        <button class="btn btn-danger rounded remove-pilihan" disabled>
                            <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" alt="icon_delete"
                                height="18">
                        </button>
                    </div>
                    <div class="col-1"></div>
                </div>
                @endif
            </div>

            <div class="card-footer">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('admin.univeritas.dashboard', ['limit_per_page' => 8])}}" type="submit"
                        class="btn btn-danger">Batal</a>
                </div>
            </div>
    </form>
</div>
</div>
@endsection

@section('script')
<script type='text/javascript'>
    $(document).ready(function () {
        var pilihanCount = 1;

        $('#add-pilihan').click(function () {
            pilihanCount++;
            var newPilihan = `
            <div class="row mb-3 pilihan-item">
                <div class="col-3 row mb-0 text-center align-items-center">
                    <h5 class="m-0">Pilihan ` + pilihanCount + ` :</h5>
                </div>
                <div class="col me-3">
                    <select class="form-select" name="jurusan[`+ pilihanCount + `]" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{$jurusan['id']}}">{{$jurusan['nama_jurusan']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 row mb-0 text-center align-items-center">
                    <button class="btn btn-danger rounded remove-pilihan">
                        <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" alt="icon_delete" height="18">
                    </button>
                </div>
                <div class="col-1"></div> <!-- Kolom kosong di akhir -->
            </div>
        `;
            $('#pilihan-container').append(newPilihan);
            checkRemoveButtonState();
        });

        $(document).on('click', '.remove-pilihan', function () {
            if ($('.pilihan-item').length > 1) {
                $(this).closest('.pilihan-item').remove();
                pilihanCount--;
                updatePilihanLabels();
                checkRemoveButtonState();
            }
        });

        function updatePilihanLabels() {
            $('#pilihan-container .pilihan-item').each(function (index) {
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
        document.getElementById('myFile').addEventListener('change', function (event) {
            var preview = document.getElementById('previewImage');
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
@extends('User.layouts.app')
@section('title')
    Univeritas > Dashboard
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-start mb-3">
                <form action="#" method="get" id="searchForm">
                    @csrf
                    @method('GET')
                    <div class="input-group w-100"
                        style="background-color: #fff; border-radius: 10px; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);">
                        <input type="text" class="form-control" name="search" id="searchInput"
                            placeholder="Masukan nama kampus yang mau dicari" aria-label="Search"
                            aria-describedby="button-addon2"
                            style="border: none; padding: 10px 15px; font-size: 16px; color: #333; box-shadow: none; outline: none;">
                        <input type="hidden" name="limit_per_page" value="8" />
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"
                            style="border: none; color: #5a67d8; margin-right: 5px; margin-bottom: -1px; border-radius: 0 10px 10px 0; transition: background-color 0.3s ease; font-size: 16px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <button class="btn btn-secondary" style="margin-left: 15px" type="button" id="resetButton">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @if ($universitas->total() != 0)
                @foreach ($universitas as $value)
                    <div class="col">
                        <div class="card" style="width: 18rem;" data-id="{{ $value['id'] }}">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        @if ($value['image_logo'] == null)
                                            <img src="https://stmik-amikbandung.ac.id/wp-content/uploads/2021/05/putih-300x285.png"
                                                class="card-img-top" alt="logo_universitas" width="30">
                                        @else
                                            <img src="{{ $value['image_logo'] }}" class="card-img-top"
                                                alt="logo_universitas" width="30">
                                        @endif
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <h5>{{ $value['nama_kampus'] }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col text-start">
                                        <p class="truncatedText">{{ $value['alamat'] }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col text-start">
                                        <p>Akreditas : <b class="akreditasi">{{ $value['akreditasi'] }}</b></p>
                                    </div>
                                </div>
                                <input type="hidden" class="image" value="{{ $value['image_logo'] }}">
                                <input type="hidden" class="jurusan"
                                    value="{{ $value->jurusan()->pluck('jurusan_universitas.nama_jurusan') }}">
                                <button type="button"
                                    class="rounded rounded-pill btn btn-primary w-100 mb-3">Detail</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- Repeat for other cards -->
        </div>
        <div class="col d-flex justify-content-center ">
            {{ $universitas->links('Layout.Pagination.pagination_card') }}
        </div>

        <!-- modal  -->
        <div class="modal fade" id="modal_create_jurusan" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Detail Universitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <img id="modal_image" class="card-img-top img-fluid" alt="logo_universitas">
                            </div>
                            <div class="col">
                                <div class="row mb-1">
                                    <div class="col">
                                        <h6 class="mb-1"><strong>Nama Universitas:</strong></h6>
                                        <p id="modal_nama"></p>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <h6><strong>Akreditas: </strong><span id="modal_akreditasi"></span></h6>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <h6 class="mb-1"><strong>Jurusan:</strong></h6>
                                        <p id="modal_jurusan"></p>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <h6 class="mb-1"><strong>Alamat:</strong></h6>
                                        <p id="modal_alamat"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function truncateText(text, wordLimit) {
            const words = text.split(' ');
            if (words.length <= wordLimit) {
                return text;
            }

            return words.slice(0, wordLimit).join(' ') + '...';
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.truncatedText').forEach(element => {
                const fullText = element.textContent;
                element.textContent = truncateText(fullText, 15);
            });

            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.card');
                    const id = card.getAttribute('data-id');
                    const nama = card.querySelector('.card-body h5').textContent;
                    const akreditasi = card.querySelector('.akreditasi').textContent;
                    const alamat = card.querySelector('.truncatedText').textContent;
                    const image = card.querySelector('.image').value;
                    const jurusan = card.querySelector('.jurusan').value;
                    const jurusanArray = JSON.parse(jurusan);
                    const jurusanText = jurusanArray.join(', ');

                    document.getElementById('modal_nama').textContent = nama;
                    document.getElementById('modal_akreditasi').textContent = akreditasi;
                    document.getElementById('modal_alamat').textContent = alamat;
                    document.getElementById('modal_image').src = image;
                    document.getElementById('modal_jurusan').textContent = jurusanText;

                    new bootstrap.Modal(document.getElementById('modal_create_jurusan')).show();
                });
            });
        });

        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('searchInput').value = '';

            const baseUrl = window.location.origin + window.location.pathname;

            window.location.href = `${baseUrl}?limit_per_page=8`;
        });
    </script>
@endsection

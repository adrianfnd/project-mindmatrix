@extends('User.layouts.app')
@section('title')
Minat Bakat
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <h5 class="col">Score</h5>
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-4">
        @if (count($results) != 0)
            @foreach ($results['detail_result'] as $result)
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center  ">
                                <div class="col">
                                    <h5>{{$result['score']}}</h5>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col">
                                    <h5>{{$result['nama_bakat']}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        @endif
    </div>
    <div class="row">
        <div class="col">
            <h5>Keterangan</h5>
        </div>
    </div>
    <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @foreach ($keterangans as $keterangan )
                            <div class="row mb-2">
                                <div class="col">
                                <button type="button" class="col btn btn-primary text-left" data-bs-toggle="button" id="button-{{ $keterangan['id'] }}">
                                    <div class="row">
                                        <div class="col">
                                                {{$keterangan['nama_bakat']}}
                                        </div>
                                        <div class="col">
                                            <i class="col text-right right fas fa-angle-down"></i>
                                        </div>
                                    </div>
                                </button>
                                    <p class="keterangan" id="keterangan-{{ $keterangan['id'] }}" style="display: none;">{{$keterangan['keterangan']}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.querySelectorAll('button[id^="button-"]').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.id.split('-')[1];
            const keterangan = document.getElementById('keterangan-' + index);
            if (keterangan.style.display === 'none' || keterangan.style.display === '') {
                keterangan.style.display = 'block';
            } else {
                keterangan.style.display = 'none';
            }
        });
    });
</script>
@endsection
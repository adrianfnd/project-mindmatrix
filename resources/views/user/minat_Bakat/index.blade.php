@extends('user.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Minat Bakat')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3 text-white">Score</h4>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-4 mb-5">
            @if (count($results) != 0)
                @foreach ($results['detail_result'] as $result)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <p class="card-text">{{ $result['nama_bakat'] }}</p>
                                <h2 class="card-title mb-3">{{ $result['score'] }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row col mb-1">
            <h5>Keterangan</h5>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="accordion" id="keteranganAccordion">
                    @foreach ($keterangans as $index => $keterangan)
                        <div class="accordion-item mb-3 shadow-sm">
                            <h2 class="accordion-header" id="heading-{{ $keterangan['id'] }}">
                                <button class="accordion-button collapsed text-white d-flex justify-content-between w-100"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $keterangan['id'] }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $keterangan['id'] }}" style="background-color: #6074e4;">
                                    <span class="text-start">{{ $keterangan['nama_bakat'] }}</span>
                                </button>
                            </h2>
                            <div id="collapse-{{ $keterangan['id'] }}" class="accordion-collapse collapse"
                                aria-labelledby="heading-{{ $keterangan['id'] }}" data-bs-parent="#keteranganAccordion">
                                <div class="accordion-body text-dark">
                                    {{ $keterangan['keterangan'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

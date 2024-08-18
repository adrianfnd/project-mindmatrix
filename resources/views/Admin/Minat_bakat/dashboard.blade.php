@extends('Admin.Template.app')
@section('title')
Minat Bakat > Dashboard
@endsection
@section('content')
<div class="container-fluid full-height">
    <div class="row col mb-3">
        @include('Admin.Template.card_header')
    </div>
    <div class="row card mb-3">
        <div class="card-header">
            <h5>list User</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-conten-start">
                    <form action="{{route('admin.minat.dashboard',['limit_per_page' => 10])}}" method="get">
                        @csrf
                        @method('GET')
                        <div class="input-group" style="width:30rem;">
                            <input type="text" class="form-control" name="search" placeholder="Pencarian Hasil Peserta"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <input type="hidden" name="limit_per_page" value="10" />
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Serach</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3">
                <div class="row ">
                    <div class="col ">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">email</th>
                                    <th scope="col">nama siswa</th>
                                    <th scope="col">Hasil Test</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->count() != 0)
                                    @foreach ($users as $user )
                                        <tr>
                                            <td scope="col" class="text-center">
                                                 {{($loop->index + ($users->perPage() * ($users->currentPage() - 1))) + 1}}
                                            </td>
                                            <td scope="col" class="text-center">
                                                    {{$user['biodata']['user']['email']}}
                                            </td>
                                             <td scope="col" class="text-center">
                                                    {{$user['biodata']['nama_lengkap']}}
                                            </td>
                                             <td scope="col" class="text-center">
                                                    {{$user['hasil_test']['singkatan']}}
                                            </td>
                                        </tr> 
                                    @endforeach
                                @endif
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End list soal -->
</div>

@endsection
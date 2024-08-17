@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'User Test')

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
        <div class="card py-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Minat Bakat Dashboard</h4>
            </div>
            <div class="card-body">
                <form id="searchForm" action="{{ route('admin.minat.dashboard', ['limit_per_page' => 10]) }}" method="get"
                    class="mb-4">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Search...">
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

                @if ($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="minatBakatTable">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Test Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td>{{ $users->firstItem() + $loop->index }}</td>
                                        <td>{{ $user['biodata']['user']['email'] }}</td>
                                        <td>{{ $user['biodata']['nama_lengkap'] }}</td>
                                        <td>{{ $user['hasil_test']['singkatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">No data found.</div>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
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
    </script>
@endsection

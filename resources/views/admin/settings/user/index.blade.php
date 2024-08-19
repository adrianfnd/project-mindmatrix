@extends('admin.layouts.app')

@section('breadcrumb', 'Settings Website')
@section('title', 'Users')

@section('content')
    <div class="container-fluid">
        <div class="card py-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Users</h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                    <i class="fas fa-plus me-1"></i> Create User
                </button>
            </div>
            <div class="card-body">
                <form id="searchForm" action="{{ route('admin.user.dashboard', ['page_per_list' => 10]) }}" method="get"
                    class="mb-4">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Search user...">
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
                        <table class="table table-bordered table-hover" id="usersTable">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td>{{ $users->firstItem() + $loop->index }}</td>
                                        <td>{{ $user->user->email }}</td>
                                        <td>{{ $user->nama_lengkap }}</td>
                                        <td>{{ $user->user->getRoleNames()->implode(', ') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                    data-target="#editUserModal{{ $user->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.user.delete') }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_user" value="{{ $user->id }}" />
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
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">No users found.</div>
                @endif
            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.user.edit') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id_user" value="{{ $user->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ $user->user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_lengkap">Full Name</label>
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                    value="{{ $user->nama_lengkap }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Date of Birth</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    value="{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.user.create') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Full Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                    placeholder="Enter full name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Date of Birth</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" disabled
                                    value="12345678">
                                <input type="hidden" name="password" value="12345678">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create User</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
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

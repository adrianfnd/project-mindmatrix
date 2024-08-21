@extends('admin.layouts.app')

@section('breadcrumb', 'Settings Website')
@section('title', 'Users')

@section('content')
    <div class="container-fluid">
        <div class="row card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>List Users</h5>
            </div>
            <div class="card-body">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                        <img src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            class="m-1" /> Create User
                    </button>
                </div>
                <form id="searchForm" class="mb-4">
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
                                            @if ($user->user->getRoleNames()->implode(', ') != 'admin')
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-warning rounded edit-btn" type="button"
                                                        data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                                        <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"
                                                            alt="icon_edit" height="18">
                                                    </button>
                                                    <form action="{{ route('admin.user.delete') }}" method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_user" value="{{ $user->id }}" />
                                                        <button class="btn btn-danger rounded" style="margin-left: 5px;">
                                                            <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                                alt="icon_delete" height="18">
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-warning rounded edit-btn" type="button"
                                                        data-toggle="modal" data-target="#editUserModal{{ $user->id }}"
                                                        disabled>
                                                        <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"
                                                            alt="icon_edit" height="18">
                                                    </button>
                                                    <form action="{{ route('admin.user.delete') }}" method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_user" value="{{ $user->id }}" />
                                                        <button class="btn btn-danger rounded" style="margin-left: 5px;"
                                                            disabled>
                                                            <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png"
                                                                alt="icon_delete" height="18">
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
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
                </div>
                <form action="{{ route('admin.user.create') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Full Name</label>
                            <div class="input-group">
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                    placeholder="Enter full name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Date of Birth</label>
                            <div class="input-group">
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="hidden" name="password" value="12345678">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password" disabled
                                    value="12345678">
                            </div>
                            <small class="form-text text-muted">
                                * Catatan: Password default adalah <strong>12345678</strong>.
                            </small>
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
                var searchText = $('#searchInput').val().toLowerCase();
                $('#usersTable tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    if (rowText.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            }

            function resetSearch() {
                $('#searchInput').val('');
                $('#usersTable tbody tr').show();
            }

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                performSearch();
            });

            $('#resetButton').on('click', function() {
                resetSearch();
            });

            $('#searchInput').on('keyup', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        });
    </script>
@endsection

@extends('admin.layouts.app')

@section('breadcrumb', 'Settings Website')
@section('title', 'Roles')

@section('content')
    <div class="container-fluid">
        <div class="card py-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Roles</h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoleModal">
                    <i class="fas fa-plus me-1"></i> Create Role
                </button>
            </div>
            <div class="card-body">
                <form id="searchForm" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search role...">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <button class="btn btn-secondary" type="button" id="resetButton">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>

                @if ($roles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="rolesTable">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Guard</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="text-center">
                                        <td>{{ $roles->firstItem() + $loop->index }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->guard_name }}</td>
                                        <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-warning btn-sm edit-btn"
                                                    data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                                    data-guard="{{ $role->guard_name }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                    data-target="#deleteRoleModal{{ $role->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $roles->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">No roles found.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.role.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_role">Role Name</label>
                            <input type="text" name="nama_role" class="form-control" id="nama_role"
                                placeholder="Enter role name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.role.update', ['id' => $role->uuid]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_nama_role">Role Name</label>
                            <input type="text" name="nama_role" class="form-control" id="edit_nama_role" required>
                            <input type="hidden" name="role_id" id="edit_role_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var guard = $(this).data('guard');

                $('#edit_nama_role').val(name);
                $('#edit_role_id').val(id);

                $('#editRoleForm').attr('action', '/admin/role/update/' + id);

                $('#editRoleModal').modal('show');
            });

            function performSearch() {
                var searchText = $('#searchInput').val().toLowerCase();
                $('#rolesTable tbody tr').each(function() {
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
                $('#rolesTable tbody tr').show();
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

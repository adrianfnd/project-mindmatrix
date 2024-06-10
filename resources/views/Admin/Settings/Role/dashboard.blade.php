@extends('Admin.Template.app')
@section('title')
    Settings Webiste > Role > Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <div class="card py-2">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col d-flex justify-conten-start">
                    <form action="{{route('admin.role.dashboard',['limit_per_page' => 10])}}" method="get">
                        @csrf
                        @method('GET')
                        <div class="input-group" style="width:30rem;">
                            <input type="text" class="form-control" name="search" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Serach</button>
                        </div>
                    </form>
                </div>
                <div class="col d-flex justify-content-end">
                    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><img
                            src="https://cdn-icons-png.flaticon.com/512/40/40031.png" alt="icon_add" width="20"
                            style="margin-right:5px;" /> Create Role
                    </button>
                </div>
            </div>
            <div class="mt-3">
                <div class="row ">
                    <div class="col ">
                    @if($roles->count() != 0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Role name</th>
                                    <th scope="col">Guard</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles->items() as $role )
                                <tr class="text-center">
                                    <td scope="col">{{ ($loop->index + ($roles->perPage() * ($roles->currentPage() - 1))) + 1 }}</td>
                                    <td scope="col">{{$role['name']}}</td>
                                    <td scope="col">{{$role['guard_name']}}</td>
                                    <td scope="col">{{$role->permissions->pluck('name')}}</td>
                                    <td scope="col">Aksi</td>
                                </tr>
                            @endforeach
                            </tbody>
                         </table>
                    @else
                        <!-- belum Beres -->
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">>
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('admin.role.create')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-skull-crossbones"></i></span>
                                </div>
                                <input type="text" name="nama_role" class="form-control" placeholder="Nama Role">
                            </div> 
                        </div>
                        <div class="row justify-content-between">
                            <button type="submit" class="btn btn-success">Upload</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>    
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
@endsection
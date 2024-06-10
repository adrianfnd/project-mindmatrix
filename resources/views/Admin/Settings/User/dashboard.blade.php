@extends('Admin.Template.app')
@section('title')
Settings Webiste > User > Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <div class="card py-2">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col d-flex justify-conten-start">
                    <form action="{{route('admin.user.dashboard', ['page_per_list' => 10])}}" method="get">
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
                            src=https://cdn-icons-png.flaticon.com/512/2312/2312400.png " alt="icon_add" width="20"
                            style="margin-righ:10px;" /> Create User
                    </button>
                </div>
            </div>
            <div class="mt-3">
                <div class="row ">
                    <div class="col ">
                        @if($users != null)
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users->items() as $user)
                                        <tr class="text-center">
                                            <td scope="col">{{ ($loop->index + ($users->perPage() * ($users->currentPage() - 1))) + 1 }}</td>
                                            <td scope="col">{{$user->user->email}}</td>
                                            <td scope="col">{{$user->nama_lengkap}}</td>
                                            <td scope="col">{{$user->user->getRoleNames()}}</td>
                                            <td scope="col">
                                                    <form action="{{route('admin.user.delete')}}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_user" value="{{$user->id}}"/>
                                                        <button class="btn btn-danger rounded"> 
                                                            <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" alt="icon_delete" height="18">
                                                        </button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <!-- Belum beres -->
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
                <form action="{{route('admin.user.create')}}" method="POST">
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
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div> 
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                            </div> 
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="tanggal lahir" format="d-m-Y">
                            </div> 
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password"  disabled value="12345678">
                                <input type="hidden" name="password" value="12345678">
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
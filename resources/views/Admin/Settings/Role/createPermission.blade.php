@extends('Admin.Template.app')
@section('title')
    Settings Webiste > Role > <?php strtoupper($role_name)?> > Permission Settings
@endsection
@section('content')
<div class="container-fluid">
    <div class="card py-2">
        <div class="container-fluid">
            <div class="mt-3">
                <div class="row ">
                    <div class="col ">
                    <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Role name</th>
                                        <th scope="col">Permission</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
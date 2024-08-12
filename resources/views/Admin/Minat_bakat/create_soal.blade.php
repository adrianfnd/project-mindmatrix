@extends('Admin.Template.app')
@section('title')
Minat Bakat > Settings > Create Soals
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        @include('Admin.Template.card_header')
    </div>
    <div class="row card mb-3">
        <div class="card-header">
            <h5>Create Soal</h5>
        </div>
        <div class="card-body">
            <form action="{{route('admin.minat.setting.soal.send')}}" method="post">
                @csrf
                @method('POST')
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Pertanyaan</th>
                            <th scope="col">Summary</th>
                        </tr>
                    </thead>
                    <tbody id="input_area">
                    </tbody>
                </table>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary m-1" type="button" onclick="addRow()">+</button>
                    <button class="btn btn-success m-1" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function addRow() {
        const tableBody = document.getElementById('input_area');
       const rowCount = tableBody.getElementsByTagName('tr').length;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
                <td scope="col" class="text-center align-middle">${rowCount + 1}</td>
                <td scope="col">
                    <textarea class="form-control" placeholder="Leave a comment here"
                        name="jawaban[pertanyaan][${rowCount}]" id="floatingTextarea" rows="1" required></textarea>
                </td>
                <td scope="col">
                    <select name="jawaban[id_summar][${rowCount}]" class="form-control" id="inputGroupSelect01" required>
                        <option selected>Choose...</option>
                        @foreach ($summarys as $value)
                            <option value="{{$value['id']}}">{{$value['nama_bakat']}}</option>
                        @endforeach
                    </select>
                </td>
            `;
        tableBody.appendChild(newRow);
    }
    addRow();
</script>
@endsection
@extends('admin.layouts.app')

@section('breadcrumb', 'Minat Bakat')
@section('title', 'Settings Create Soal')

@section('content')
    <div class="container-fluid">
        <div class="row card mb-3">
            <div class="card-header">
                <h5>Create Soal</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.minat.setting.soal.send') }}" method="post">
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
                        <a class="btn btn-danger m-1"
                            href="{{ route('admin.minat.setting.dashboard', ['limit_per_page' => 10]) }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                            <option value="{{ $value['id'] }}">{{ $value['nama_bakat'] }}</option>
                        @endforeach
                    </select>
                </td>
            `;
            tableBody.appendChild(newRow);
        }
        addRow();
    </script>
@endsection

@extends('layout.layout-kaprodi')

@section('title', 'Mata Kuliah')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Mata Kuliah</h1>


    {{-- Tabel Data Mata Kuliah (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mataKuliah as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mk['nama_matkul'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

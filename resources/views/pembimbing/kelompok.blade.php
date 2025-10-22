@extends('layout.layout-pembimbing')

@section('title', 'Kelompok')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Kelompok</h1>
    {{-- Tabel Data Kelompok (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelompok as $index => $klp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $klp['nama_kelompok'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

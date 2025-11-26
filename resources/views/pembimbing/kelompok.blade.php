@extends('layout.layout-pembimbing')

@section('title', 'Kelompok')

@section('content')
<div class="d-flex align-items-center mb-2">
    <form class="ms-auto d-none d-sm-inline-block mw-200" style="width: 250px;">
        <div class="input-group">
            <input type="text" class="form-control bg-light small"
                   placeholder="Search for..." aria-label="Search">
            <button class="btn btn-primary" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

</div>
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

@extends('layout.layout-admin')

@section('title', 'Kelompok')

@section('content')

    {{-- Tombol Tambah Kelompok --}}
    <a href="{{ url('dosen/kelompok/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Kelompok
    </a>

    {{-- Tabel Data Kelompok (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelompok as $index => $klp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $klp['nama_kelompok'] }}</td>
                            <td>
                                <a href="{{ url('dosen/kelompok/edit/' . $klp['id_kelompok']) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ url('dosen/kelompok/delete/' . $klp['id_kelompok']) }}"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('layout.layout-admin')

@section('title', 'Mata Kuliah')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Mata Kuliah</h1>

    {{-- Tombol Tambah Mata Kuliah --}}
    <a href="/dosen/mata-kuliah/create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Mata Kuliah
    </a>

    {{-- Tabel Data Mata Kuliah (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mataKuliah as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mk['nama_matkul'] }}</td>
                            <td>
                                <a href="/dosen/mata-kuliah/edit/{{ $mk['id_matkul'] }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/dosen/mata-kuliah/delete/{{ $mk['id_matkul'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

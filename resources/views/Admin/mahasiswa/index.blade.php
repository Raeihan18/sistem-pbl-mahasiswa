@extends('layout.layout-admin')

@section('title', 'Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Mahasiswa</h1>

    <div class="mb-3">
        {{-- Tombol Tambah Mahasiswa --}}
        <a href="/admin/mahasiswa/create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Mahasiswa
        </a>

        {{-- Tombol Import Mahasiswa --}}
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fas fa-file-import"></i> Import Mahasiswa
        </button>
    </div>

    {{-- Tabel Data Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Id Kelompok</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $index => $mhs)
                        <tr>
                            <td>{{ $index +1}}</td>
                            <td>{{ $mhs['nim'] }}</td>
                            <td>{{ $mhs['nama'] }}</td>
                            <td>{{ $mhs['kelas'] }}</td>
                            <td>{{ $mhs['nama_kelompok'] }}</td>
                            <td>{{ $mhs['email'] }}</td>
                            <td>
                                <a href="/admin/mahasiswa/edit/{{ $mhs['id_mahasiswa'] }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/admin/mahasiswa/delete/{{ $mhs['id_mahasiswa'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('admin/mahasiswa/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file" accept=".xlsx,.csv" class="form-control" required>
                        <small class="text-muted">Format file: Excel (.xlsx) atau CSV (.csv)</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

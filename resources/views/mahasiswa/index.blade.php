@extends('layout.layout-admin')

@section('title', 'Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Mahasiswa</h1>

    {{-- Tombol Tambah Mahasiswa --}}
    <a href="/dosen/mahasiswa/create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Mahasiswa
    </a>

    {{-- Tabel Data Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
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
                            <td>{{ $mhs['id_mahasiswa'] }}</td>
                            <td>{{ $mhs['nim'] }}</td>
                            <td>{{ $mhs['nama'] }}</td>
                            <td>{{ $mhs['kelas'] }}</td>
                            <td>{{ $mhs['id_kelompok'] }}</td>
                            <td>{{ $mhs['email'] }}</td>
                            <td>
                                <a href="/dosen/mahasiswa/edit" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="dosen/mahasiswa/delete/{{ $mhs['id_mahasiswa'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

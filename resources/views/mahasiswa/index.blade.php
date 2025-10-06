@extends('layout.layout-admin')

@section('title', 'Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Mahasiswa</h1>

    {{-- Tombol Tambah Mahasiswa --}}
    <a href="#" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Mahasiswa
    </a>

    {{-- Tabel Data Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $mahasiswa = [
                            ['nim' => '230101001', 'nama' => 'Andi Saputra', 'prodi' => 'Informatika'],
                            ['nim' => '230101002', 'nama' => 'Budi Santoso', 'prodi' => 'Sistem Informasi'],
                            ['nim' => '230101003', 'nama' => 'Citra Dewi', 'prodi' => 'Teknik Komputer'],
                            ['nim' => '230101004', 'nama' => 'Diana Puspita', 'prodi' => 'Manajemen Informatika'],
                        ];
                    @endphp

                    @foreach ($mahasiswa as $index => $mhs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs['nim'] }}</td>
                            <td>{{ $mhs['nama'] }}</td>
                            <td>{{ $mhs['prodi'] }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

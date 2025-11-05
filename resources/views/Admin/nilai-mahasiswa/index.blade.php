@extends('layout.layout-admin')

@section('title', 'Nilai Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Nilai Mahasiswa</h1>

    {{-- Tombol Tambah Nilai Mahasiswa --}}
    <a href="/admin/nilai-mahasiswa/create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Nilai Mahasiswa
    </a>

    {{-- Tabel Data  Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelompok</th>
                        <th>Mata Kuliah</th>
                        <th>Nilai Tugas</th>
                        <th>Nilai Project</th>
                        <th>Nilai Persentasi</th>
                        <th>Nilai Kehadiran</th>
                        <th>Total Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($nilai_mahasiswa as $index => $nilai)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $nilai['nama_mahasiswa'] }}</td>
                            <td>{{ $nilai['nama_kelompok'] }}</td>
                            <td>{{ $nilai['nama_matkul'] }}</td>
                            <td>{{ $nilai['nilai_tugas'] }}</td>
                            <td>{{ $nilai['nilai_project'] }}</td>
                            <td>{{ $nilai['nilai_presentasi'] }}</td>
                            <td>{{ $nilai['nilai_kehadiran'] }}</td>
                            <td>{{ $nilai['total_nilai'] }}</td>
                            <td>
                                <a href="/admin/nilai-mahasiswa/edit/{{ $nilai['id_nilai_mahasiswa'] }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/admin/nilai-mahasiswa/delete/{{ $nilai['id_nilai_mahasiswa'] }}"
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

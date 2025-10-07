@extends('layout.layout-admin')

@section('title', 'Nilai Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Nilai Mahasiswa</h1>

    {{-- Tombol Tambah Nilai Mahasiswa --}}
    <a href="/dosen/nilai-mahasiswa/create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Nilai Mahasiswa
    </a> 

    {{-- Tabel Data  Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
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
                            <td>{{ $nilai['id_nilai'] }}</td>
                            <td>{{ $nilai['nilai_tugas'] }}</td>
                            <td>{{ $nilai['nilai_project'] }}</td>
                            <td>{{ $nilai['nilai_presentasi'] }}</td>
                            <td>{{ $nilai['nilai_kehadiran'] }}</td>
                            <td>{{ $nilai['total_nilai'] }}</td>
                            <td>
                                <a href="/dosen/nilai-mahasiswa/edit/{{ $nilai['id_nilai']}}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/dosen/nilai-mahasiswa/delete/{{ $nilai['id_nilai']}}" class="btn btn-sm btn-danger"
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

@extends('layout.layout-kaprodi')

@section('title', 'Nilai Mahasiswa')

@section('content')
    <div class="d-flex align-items-center mb-2">
        <form class="ms-auto d-none d-sm-inline-block mw-200" style="width: 250px;">
            <div class="input-group">
                <input type="text" class="form-control bg-light small" placeholder="Search for..." aria-label="Search">
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

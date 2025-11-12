@extends('layout.layout-admin')

@section('title', 'Mahasiswa Terbaik')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-gray-800 mb-0">Daftar Mahasiswa Terbaik (TPK)</h1>

        <div>
            {{-- Tombol Edit Bobot --}}
            <a href="/admin/bobot" class="btn btn-secondary me-2">
                <i class="fas fa-balance-scale"></i> Edit Bobot
            </a>

            {{-- Tombol Trigger Hitung TPK --}}
            <a href="{{ url('admin/tpk/hitung') }}" class="btn btn-primary"
               onclick="return confirm('Hitung ulang TPK berdasarkan data terbaru?')">
                <i class="fas fa-calculator"></i> Hitung TPK
            </a>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Data Mahasiswa Terbaik --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Mahasiswa</th>
                        <th>IOT</th>
                        <th>Keamanan Data</th>
                        <th>Web Lanjut</th>
                        <th>IT Project</th>
                        <th>Partisipasi</th>
                        <th>Hasil Proyek</th>
                        <th>Nilai TPK</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $mahasiswa->mahasiswa->nama ?? 'Tidak ditemukan' }}
                            </td>
                            <td>{{ number_format($mahasiswa->iot, 2) }}</td>
                            <td>{{ number_format($mahasiswa->keamanan_data, 2) }}</td>
                            <td>{{ number_format($mahasiswa->web_lanjut, 2) }}</td>
                            <td>{{ number_format($mahasiswa->it_project, 2) }}</td>
                            <td>{{ number_format($mahasiswa->partisipasi, 2) }}</td>
                            <td>{{ number_format($mahasiswa->hasil_proyek, 2) }}</td>
                            <td><strong>{{ number_format($mahasiswa->total_nilai, 2) }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-muted">Belum ada data hasil TPK.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
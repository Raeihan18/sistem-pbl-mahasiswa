@extends('layout.layout-mahasiswa')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Dashboard Sistem PBL Mahasiswa</h1>

    <div class="alert alert-primary">
        Selamat datang, <strong>{{ $mahasiswa->nama }}</strong>!<br>
        Kelompok Anda: <strong>{{ $mahasiswa->kelompok->nama_kelompok ?? '-' }}</strong>
    </div>

    <!-- Statistik Ringkas -->
    <div class="row">

        <!-- Nama Kelompok -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kelompok Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $mahasiswa->kelompok->nama_kelompok ?? '-' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai Rata-rata Pribadi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Rata-rata Nilai Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nilaiRata }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai Kelompok -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nilai Kelompok Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nilaiKelompok }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Grafik Nilai Mahasiswa -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Rata-rata Nilai per Mata Kuliah</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartNilaiMahasiswa"></canvas>
                </div>
            </div>
        </div>

        <!-- Info Sistem -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tentang Sistem PBL Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <p><strong>Sistem PBL Mahasiswa</strong> membantu mahasiswa memantau nilai individu dan kelompok
                        dalam pembelajaran berbasis proyek (PBL).</p>
                    <ul>
                        <li>Melihat <strong>rata-rata nilai per mata kuliah</strong></li>
                        <li>Mengetahui <strong>nilai rata-rata pribadi & kelompok</strong></li>
                        <li>Meningkatkan kolaborasi antar anggota kelompok</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('chartNilaiMahasiswa');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($namaMatkul),
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: @json($nilaiRataMatkul),
                    backgroundColor: '#4e73df'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Nilai' }
                    },
                    x: {
                        title: { display: true, text: 'Mata Kuliah' }
                    }
                }
            }
        });
    });
</script>
@endpush

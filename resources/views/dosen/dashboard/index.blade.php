@extends('layout.layout-admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">


        <!-- Ringkasan Statistik -->
        <div class="row">

            <!-- Total Mahasiswa -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Mahasiswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMahasiswa }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Mata Kuliah -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Mata Kuliah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMataKuliah }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Kelompok -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Kelompok</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKelompok }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rata-rata Nilai -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Rata-rata Nilai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nilaiRata }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Grafik Nilai Mahasiswa dan Informasi Sistem -->
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

            <!-- Informasi Singkat -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tentang Sistem PBL Mahasiswa</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Sistem PBL Mahasiswa</strong> adalah platform digital yang dirancang untuk membantu dosen
                            dalam mengelola dan memantau proses pembelajaran berbasis proyek (Project Based Learning).</p>

                        <p>Melalui sistem ini, dosen dapat:</p>
                        <ul>
                            <li>Melihat data <strong>mahasiswa</strong> dan <strong>kelompok</strong></li>
                            <li>Menilai hasil <strong>proyek dan individu</strong></li>
                            <li>Melacak <strong>rata-rata nilai per mata kuliah</strong></li>
                            <li>Meningkatkan efektivitas evaluasi PBL</li>
                        </ul>

                        <p class="mb-0">Sistem ini dikembangkan untuk mendukung kegiatan belajar kolaboratif dan berbasis
                            hasil nyata.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Dummy Mahasiswa Terbaik -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">5 Mahasiswa dengan Nilai Tertinggi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kelompok</th>
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswaTertinggi as $index => $nm)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $nm->mahasiswa?->nama ?? '-' }}</td>
                                            <td>{{ $nm->mataKuliah?->nama_matkul ?? '-' }}</td>
                                            <td>{{ $nm->mahasiswa?->kelompok?->nama_kelompok ?? '-' }}</td>
                                            <td>{{ $nm->total_nilai ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
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
                type: 'line',
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
                            title: {
                                display: true,
                                text: 'Nilai'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Mata Kuliah'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush

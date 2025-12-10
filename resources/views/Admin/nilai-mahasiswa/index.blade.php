@extends('layout.layout-admin')

@section('title', 'Nilai Mahasiswa')

@section('content')

<style>
    .mhs-card {
        border-left: 5px solid #0d6efd;
        transition: 0.2s;
    }
    .mhs-card:hover { background: #f5f9ff; }

    .matkul-card {
        border-left: 4px solid #6c757d;
        background: #f8f9fa;
        transition: 0.2s;
    }
    .matkul-card:hover { background: #eef0f1; }

    .nilai-table thead {
        background: #343a40;
        color: white;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #343a40;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 5px;
    }
</style>

<div class="d-flex align-items-center mb-3">

    <a href="/admin/nilai-mahasiswa/create" class="btn btn-primary me-2">
        <i class="fas fa-plus"></i> Tambah Nilai Mahasiswa
    </a>

    <a href="/admin/nilai-mahasiswa/export" class="btn btn-success me-3">
        <i class="fas fa-file-excel"></i> Export Laporan
    </a>

    {{-- FILTER KELAS --}}
    <form method="GET" class="me-2" style="width: 180px;">
        <select class="form-select" name="kelas" onchange="this.form.submit()">
            @foreach ($kelasList as $k)
                <option value="{{ $k }}" {{ ($kelas == $k) ? 'selected' : '' }}>
                    {{ $k === "all" ? "Semua Kelas" : $k }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- SEARCH --}}
    <form method="GET" class="ms-auto" style="width: 250px;">
        <div class="input-group">
            <input type="text"
                   name="search"
                   value="{{ $search }}"
                   class="form-control bg-light"
                   placeholder="Cari nama / kelompok...">
            
            {{-- Kirim juga filter kelas agar tidak hilang --}}
            <input type="hidden" name="kelas" value="{{ $kelas }}">
            
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

</div>


<div class="section-title">Daftar Nilai Mahasiswa</div>

<div class="accordion" id="accordionMahasiswa">

    @foreach ($mahasiswas as $mhs)

        {{-- ================= LEVEL 1: MAHASISWA ================= --}}
        <div class="card mb-2 shadow-sm mhs-card">
            <div class="card-header py-2">
                @php
                    $rataGlobal = $rataMahasiswa[$mhs->id_mahasiswa] ?? null;
                @endphp

                <button class="btn btn-link text-start w-100 fw-bold d-flex justify-content-between"
                        style="text-decoration: none; font-size: 16px;"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $mhs->id_mahasiswa }}">
                    
                    <span>
                        👤 {{ $mhs->nama }}
                        <span class="text-muted"> | Kelompok: {{ $mhs->nama_kelompok }}</span>
                    </span>

                    <span class="badge {{ $rataGlobal >= 85 ? 'bg-success' : ($rataGlobal >= 70 ? 'bg-warning text-dark' : 'bg-danger') }}">
                        Rata-rata: {{ number_format($rataGlobal, 2) }}
                    </span>
                </button>
            </div>

            {{-- ================= LEVEL 2: MATA KULIAH ================= --}}
            <div id="collapse-{{ $mhs->id_mahasiswa }}" class="collapse">
                <div class="card-body">

                    @if(isset($nilai[$mhs->id_mahasiswa]))

                        @foreach ($nilai[$mhs->id_mahasiswa] as $id_matkul => $listNilai)

                            <div class="card matkul-card mb-2 shadow-sm">
                                <div class="card-header py-2">

                                    @php
                                        $rataMatk = $rataMatkul[$mhs->id_mahasiswa][$id_matkul] ?? null;
                                    @endphp

                                    <button class="btn btn-link text-start w-100 fw-semibold d-flex justify-content-between"
                                            style="text-decoration: none;"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#matkul-{{ $mhs->id_mahasiswa }}-{{ $id_matkul }}">
                                        
                                        <span>📚 {{ $listNilai->first()->nama_matkul }}</span>

                                        <span class="badge {{ $rataMatk >= 85 ? 'bg-success' : ($rataMatk >= 70 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                            {{ number_format($rataMatk, 2) }}
                                        </span>
                                    </button>
                                </div>

                                {{-- ================= LEVEL 3: TABEL NILAI ================= --}}
                                <div id="matkul-{{ $mhs->id_mahasiswa }}-{{ $id_matkul }}" class="collapse">

                                    <div class="table-responsive p-3">
                                        <table class="table table-bordered table-striped table-sm nilai-table">
                                            <thead>
                                                <tr>
                                                    <th>Pertemuan</th>
                                                    <th>Tugas</th>
                                                    <th>Project</th>
                                                    <th>Presentasi</th>
                                                    <th>Kehadiran</th>
                                                    <th>Total</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($listNilai as $nl)
                                                    <tr>
                                                        <td>{{ $nl->pertemuan }}</td>
                                                        <td>{{ $nl->nilai_tugas }}</td>
                                                        <td>{{ $nl->nilai_project }}</td>
                                                        <td>{{ $nl->nilai_presentasi }}</td>
                                                        <td>{{ $nl->nilai_kehadiran }}</td>
                                                        <td class="fw-bold">
                                                            {{ number_format(($nl->nilai_tugas + $nl->nilai_project + $nl->nilai_presentasi + $nl->nilai_kehadiran) / 4, 2) }}
                                                        </td>
                                                        <td>
                                                            <a href="/admin/nilai-mahasiswa/edit/{{ $nl->id_nilai_mahasiswa }}"
                                                               class="btn btn-warning btn-sm">✏️ Edit</a>

                                                            <a href="/admin/nilai-mahasiswa/delete/{{ $nl->id_nilai_mahasiswa }}"
                                                               onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                               class="btn btn-danger btn-sm">🗑️ Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                {{-- ======== RATA-RATA BAGIAN BAWAH ======== --}}
                                                @php
                                                    $avgTugas = $listNilai->avg('nilai_tugas');
                                                    $avgProject = $listNilai->avg('nilai_project');
                                                    $avgPresentasi = $listNilai->avg('nilai_presentasi');
                                                    $avgKehadiran = $listNilai->avg('nilai_kehadiran');
                                                    $avgTotal = ($avgTugas + $avgProject + $avgPresentasi + $avgKehadiran) / 4;
                                                @endphp

                                                <tr class="table-secondary fw-bold">
                                                    <td>Rata-rata</td>
                                                    <td>{{ number_format($avgTugas, 2) }}</td>
                                                    <td>{{ number_format($avgProject, 2) }}</td>
                                                    <td>{{ number_format($avgPresentasi, 2) }}</td>
                                                    <td>{{ number_format($avgKehadiran, 2) }}</td>
                                                    <td>{{ number_format($avgTotal, 2) }}</td>
                                                    <td>-</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        @endforeach

                    @else
                        <p class="text-muted ms-3">Belum ada nilai.</p>
                    @endif

                </div>
            </div>
        </div>

    @endforeach

</div>

@endsection

@extends('layout.layout-mahasiswa')

@section('title', 'Nilai Kelompok')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Nilai Kelompok</h1>

    {{-- Pilih Mata Kuliah --}}
    <div class="mb-3">
        <form action="{{ url('mahasiswa/nilai-kelompok') }}" method="GET" class="form-inline">
            <label for="id_matkul" class="mr-2">Pilih Mata Kuliah:</label>
            <select class="form-control mr-2" id="id_matkul" name="id_matkul" required>
                <option value="" disabled selected>Pilih Mata Kuliah</option>
                @foreach ($mataKuliah as $matkul)
                    <option value="{{ $matkul->id_matkul }}" 
                        {{ request('id_matkul') == $matkul->id_matkul ? 'selected' : '' }}>
                        {{ $matkul->nama_matkul }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>
    </div>

    {{-- Tabel Nilai Kelompok --}}
    @if(isset($nilaiKelompok) && count($nilaiKelompok) > 0)
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Nilai Tugas</th>
                            <th>Nilai Project</th>
                            <th>Nilai Presentasi</th>
                            <th>Nilai Kehadiran</th>
                            <th>Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiKelompok as $index => $nk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $nk->nama_kelompok }}</td>
                                <td>{{ $nk->nilai_tugas }}</td>
                                <td>{{ $nk->nilai_project }}</td>
                                <td>{{ $nk->nilai_presentasi }}</td>
                                <td>{{ $nk->nilai_kehadiran }}</td>
                                <td>{{ $nk->total_nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(request('id_matkul'))
        <div class="alert alert-info">
            Belum ada nilai kelompok untuk mata kuliah ini.
        </div>
    @endif
@endsection

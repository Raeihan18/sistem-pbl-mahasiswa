@extends('layout.layout-admin')

@section('title', 'Edit Nilai Mahasiswa')

@section('content') <h1 class="h3 mb-4 text-gray-800">Edit Nilai Mahasiswa</h1>

```
<div class="card shadow mb-4">
    <div class="card-body">

        <form action="{{ url('dosen/nilai-mahasiswa/update/' . $nilai->id_nilai) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="id_mahasiswa">Mahasiswa</label>
                <select class="form-control" id="id_mahasiswa" name="id_mahasiswa" required disabled>
                    @foreach ($mahasiswa as $mhs)
                        <option value="{{ $mhs->id_mahasiswa }}"
                            {{ $nilai->id_mahasiswa == $mhs->id_mahasiswa ? 'selected' : '' }}>
                            {{ $mhs->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Mahasiswa tidak dapat diubah.</small>
            </div>

            <div class="form-group mb-3">
                <label for="nilai_tugas">Nilai Tugas</label>
                <input type="number" step="0.01" class="form-control" id="nilai_tugas" name="nilai_tugas"
                    value="{{ $nilai->nilai_tugas }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="nilai_project">Nilai Project</label>
                <input type="number" step="0.01" class="form-control" id="nilai_project" name="nilai_project"
                    value="{{ $nilai->nilai_project }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="nilai_presentasi">Nilai Presentasi</label>
                <input type="number" step="0.01" class="form-control" id="nilai_presentasi" name="nilai_presentasi"
                    value="{{ $nilai->nilai_presentasi }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="nilai_kehadiran">Nilai Kehadiran</label>
                <input type="number" step="0.01" class="form-control" id="nilai_kehadiran" name="nilai_kehadiran"
                    value="{{ $nilai->nilai_kehadiran }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="total_nilai">Total Nilai</label>
                <input type="number" step="0.01" class="form-control" id="total_nilai" name="total_nilai"
                    value="{{ $nilai->total_nilai }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('dosen/nilai-mahasiswa/index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    // Hitung total nilai otomatis saat diubah
    document.addEventListener('input', function () {
        const tugas = parseFloat(document.getElementById('nilai_tugas').value) || 0;
        const project = parseFloat(document.getElementById('nilai_project').value) || 0;
        const presentasi = parseFloat(document.getElementById('nilai_presentasi').value) || 0;
        const kehadiran = parseFloat(document.getElementById('nilai_kehadiran').value) || 0;

        const total = (tugas + project + presentasi + kehadiran) / 4;
        document.getElementById('total_nilai').value = total.toFixed(2);
    });
</script>


@endsection

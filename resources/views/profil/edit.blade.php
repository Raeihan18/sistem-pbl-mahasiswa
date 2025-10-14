@extends('layout.layout-admin')

@section('title', 'Edit profil')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit profil</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ url('dosen/profil/update/' . $profil->id_profil) }}" method="POST">
                @csrf
                @method('PUT')


                {{-- Nilai Kehadiran --}}
                <div class="form-group mb-3">
                    <label for="potoprofil">gambar</label>
                    <input type="file" step="0.01" class="form-control" id="potoprofil" name="potoprofil"
                        value=" " required>
                </div>

                {{-- Total Nilai (otomatis) --}}
                <div class="form-group mb-3">
                    <label for="matakuliah">matakuliah</label>
                    <input type="text" step="0.01" class="form-control" id="matakuliah" name="matakuliah"
                        value="{{ $profil->matakuliah }}" >
                </div>

                  {{-- Total Nilai (otomatis) --}}
                <div class="form-group mb-3">
                    <label for="NIP">NIP</label>
                    <input type="number" step="0.01" class="form-control" id="NIP" name="NIP"
                        value="{{ $profil->NIP }}" >
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ url('dosen/nilai-mahasiswa') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>

    <script>
        // Hitung ulang total nilai jika ada perubahan
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

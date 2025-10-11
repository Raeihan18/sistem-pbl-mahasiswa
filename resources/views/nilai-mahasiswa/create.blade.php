@extends('layout.layout-admin')

@section('title', 'Tambah Nilai Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Tambah Nilai Mahasiswa</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ url('dosen/nilai-mahasiswa/store') }}" method="POST">
                @csrf

                {{-- Pilih Mahasiswa --}}
                <div class="form-group mb-3">
                    <label for="id_mahasiswa">Mahasiswa</label>
                    <select class="form-control" id="id_mahasiswa" name="id_mahasiswa" required>
                        <option value="" disabled selected>Pilih Mahasiswa</option>
                        @foreach ($mahasiswa as $mhs)
                            <option value="{{ $mhs->id_mahasiswa }}" 
                                data-nim="{{ $mhs->nim }}" 
                                data-kelas="{{ $mhs->kelas }}">
                                {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- NIM otomatis --}}
                <div class="form-group mb-3">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" placeholder="NIM akan muncul otomatis" readonly>
                </div>

                {{-- Kelas otomatis --}}
                <div class="form-group mb-3">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" placeholder="Kelas akan muncul otomatis" readonly>
                </div>

                {{-- Pilih Mata Kuliah --}}
                <div class="form-group mb-3">
                    <label for="id_matkul">Mata Kuliah</label>
                    <select class="form-control" id="id_matkul" name="id_matkul" required>
                        <option value="" disabled selected>Pilih Mata Kuliah</option>
                        @foreach ($mataKuliah as $mk)
                            <option value="{{ $mk->id_matkul }}">{{ $mk->nama_matkul }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Input nilai --}}
                <div class="form-group mb-3">
                    <label for="nilai_tugas">Nilai Tugas</label>
                    <input type="number" step="0.01" class="form-control" id="nilai_tugas" name="nilai_tugas"
                        placeholder="Masukkan nilai tugas" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nilai_project">Nilai Project</label>
                    <input type="number" step="0.01" class="form-control" id="nilai_project" name="nilai_project"
                        placeholder="Masukkan nilai project" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nilai_presentasi">Nilai Presentasi</label>
                    <input type="number" step="0.01" class="form-control" id="nilai_presentasi" name="nilai_presentasi"
                        placeholder="Masukkan nilai presentasi" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nilai_kehadiran">Nilai Kehadiran</label>
                    <input type="number" step="0.01" class="form-control" id="nilai_kehadiran" name="nilai_kehadiran"
                        placeholder="Masukkan nilai kehadiran" required>
                </div>

                <div class="form-group mb-3">
                    <label for="total_nilai">Total Nilai</label>
                    <input type="number" step="0.01" class="form-control" id="total_nilai" name="total_nilai"
                        placeholder="Akan terisi otomatis" readonly>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ url('dosen/nilai-mahasiswa') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>

    <script>
        // Saat mahasiswa dipilih, tampilkan NIM dan kelas
        document.getElementById('id_mahasiswa').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            document.getElementById('nim').value = selected.getAttribute('data-nim') || '';
            document.getElementById('kelas').value = selected.getAttribute('data-kelas') || '';
        });

        // Hitung total nilai otomatis
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

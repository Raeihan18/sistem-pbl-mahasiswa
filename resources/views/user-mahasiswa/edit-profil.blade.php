@extends('layout.layout-mahasiswa')

@section('title', 'Edit Profil Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800 mb-0">Edit Profil Mahasiswa</h1>
    <a href="{{ url('mahasiswa/profil') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ url('mahasiswa/profil/update/' . $mahasiswa->id_mahasiswa) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Foto Profil --}}
            <div class="mb-4 text-center">
                <img src="{{ asset('storage/potoprofil/' . ($mahasiswa->potoprofil ?? 'default-avatar.png')) }}"
                     alt="Foto Profil"
                     class="rounded-circle mb-3"
                     width="120" height="120"
                     style="object-fit: cover; border: 3px solid #ddd;">
                <div class="form-group">
                    <label for="potoprofil" class="form-label fw-bold">Ganti Foto Profil</label>
                    <input type="file" class="form-control" id="potoprofil" name="potoprofil" accept="image/*">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>
            </div>

            <hr>

            {{-- Data Mahasiswa --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nim" class="form-label fw-bold">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim"
                           value="{{ old('nim', $mahasiswa->nim) }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label fw-bold">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                           value="{{ old('nama', $mahasiswa->nama) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', $mahasiswa->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="kelas" class="form-label fw-bold">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas"
                           value="{{ old('kelas', $mahasiswa->kelas) }}" required>
                </div>
            </div>

            {{-- Kelompok --}}
            <div class="mb-3">
                <label for="kelompok" class="form-label fw-bold">Kelompok</label>
                <input type="text" class="form-control" id="kelompok"
                       value="{{ $mahasiswa->kelompok->nama_kelompok ?? '-' }}" readonly>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ url('mahasiswa/profil') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

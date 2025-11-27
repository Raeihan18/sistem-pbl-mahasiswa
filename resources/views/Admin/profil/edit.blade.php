@extends('layout.layout-admin')


@section('title', 'Edit Profil admin')


@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800 mb-0">Edit Profil Dosen</h1>
    <a href="{{ url('admin/profil') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>


<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ url('admin/profil/update/' . $profil->id_profil) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            {{-- Foto Profil --}}
            <div class="mb-4 text-center">
                <img src="{{ asset('storage/potoprofil/' . ($profil->potoprofil ?? 'default-avatar.png')) }}"
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


            {{-- Data pembimbing --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="NIP" class="form-label fw-bold">NIP</label>
                    <input type="text" class="form-control" id="NIP" name="NIP"
                           value="{{ old('NIP', $profil->NIP) }}" placeholder="Masukkan NIP">
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label fw-bold">Nama Dosen</label>
                    <input type="text" class="form-control" value="{{ $admin->nama ?? '' }}" readonly>
                </div>
            </div>





            {{-- Tombol Aksi --}}
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ url('admin/profil') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

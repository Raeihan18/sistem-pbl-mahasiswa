@extends('layout.layout-admin')

@section('title', 'Tambah Mahasiswa')

@section('content')

     @error('nim')
    <div class="text-danger small">{{ $message }}</div>
@enderror


    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('admin/mahasiswa/store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama mahasiswa" required>
                </div>

                <div class="form-group mb-3">
                    <label for="kelas">Kelas</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="TI-3A">TI-3A</option>
                        <option value="TI-3B">TI-3B</option>
                        <option value="TI-3C">TI-3C</option>
                        <option value="TI-3D">TI-3D</option>
                        <option value="TI-3E">TI-3E</option>
                    </select>
                </div>

                {{-- Pilih Kelompok --}}
                <div class="form-group mb-3">
                    <label for="id_kelompok">Kelompok</label>
                    <select class="form-control" id="id_kelompok" name="id_kelompok" required>
                        <option value="" disabled selected>Pilih Kelompok</option>
                        @foreach ($kelompok as $klp)
                            <option value="{{ $klp->id_kelompok }}">{{ $klp->nama_kelompok }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email mahasiswa" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('admin/mahasiswa') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

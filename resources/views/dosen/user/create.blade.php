@extends('layout.layout-dosen')

@section('title', 'Tambah User')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('dosen/user/store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama user" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email user" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <div class="form-group mb-3">
                    <label for="level">Level</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="" disabled selected>Pilih level user</option>
                        <option value="kaprodi">Kaprodi</option>
                        <option value="dosen">Dosen</option>
                        <option value="pembimbing">Pembimbing</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('user/index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

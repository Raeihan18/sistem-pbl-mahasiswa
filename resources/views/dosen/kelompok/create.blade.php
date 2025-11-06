@extends('layout.layout-admin')

@section('title', 'Tambah Kelompok')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('dosen/kelompok/store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="nama_kelompok">Nama Kelompok</label>
                    <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok"
                        placeholder="Masukkan Nama Kelompok" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('dosen/kelompok') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

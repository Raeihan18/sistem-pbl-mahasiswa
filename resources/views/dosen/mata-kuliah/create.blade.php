@extends('layout.layout-dosen')

@section('title', 'Tambah Mata Kuliah')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/dosen/mata-kuliah/store" method="POST">
                @csrf


                <div class="form-group mb-3">
                    <label for="nama_matkul">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" placeholder="Masukkan Nama Mata Kuliah" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="/dosen/mata-kuliah" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
@endsection

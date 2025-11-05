@extends('layout.layout-admin')

@section('title', 'Edit Mata Kuliah')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Mata Kuliah</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/admin/mata-kuliah/update/{{ $mataKuliah['id_matkul'] }}" method="POST">
                @csrf
                @method('PUT')

               

                <div class="form-group mb-3">
                    <label for="nama_matkul">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matkul" id="nama_matkul" class="form-control"
                        value="{{ $mataKuliah['nama_matkul'] }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Perbarui
                </button>
                <a href="/admin/mata-kuliah" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
@endsection

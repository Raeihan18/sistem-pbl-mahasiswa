@extends('layout.layout-dosen')

@section('title', 'Tambah Mata Kuliah')

@section('content')
    

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/dosen/bobot/create" method="POST">
                @csrf


                <div class="form-group mb-3">
                    <label for="kriteria">Nama Atribut</label>
                    <input type="text" name="kriteria" id="kriteria" class="form-control" placeholder="Masukkan Nama Atribut" required>
                </div>
                {{-- <div class="form-group mb-3">
                    <label for="bobot">Nama bobot</label>
                    <input type="number" name="bobot" id="bobot" class="form-control" placeholder="Masukkan Bobot" required>
                </div> --}}
                <div class="form-group mb-3">
                    <label for="bobot">Nama tipe</label>
                    <input type="text" name="tipe" id="tipe" class="form-control" placeholder="Masukkan Tipe" required>
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

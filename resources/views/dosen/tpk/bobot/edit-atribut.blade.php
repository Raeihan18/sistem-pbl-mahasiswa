@extends('layout.layout-dosen')

@section('title', 'Edit Bobot')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/dosen/bobot/update-atribut/{{ $bobot['id_bobot'] }}" method="POST">
                @csrf
                @method('PUT')

               
                <div class="form-group mb-3">
                    <label for="kriteria">Nama Atribut</label>
                    <input type="text" name="kriteria" id="kriteria" class="form-control"  value="{{ $bobot['kriteria'] }}" required>
                </div>
                {{-- <div class="form-group mb-3">
                    <label for="bobot">Bobot</label>
                    <input type="number" name="bobot" id="bobot" class="form-control" value="{{ $bobot['bobot'] }}" required>
                </div> --}}
                <div class="form-group mb-3">
                    <label for="bobot">Nama tipe</label>
                    <input type="text" name="tipe" id="tipe" class="form-control" value="{{ $bobot['tipe'] }}" required>
                </div>
                

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Perbarui
                </button>
                <a href="/dosen/bobot" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
@endsection

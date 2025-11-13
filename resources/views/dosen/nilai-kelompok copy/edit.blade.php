@extends('layout.layout-admin')

@section('title', 'Edit Kelompok')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('dosen/kelompok/update/' . $kelompok->id_kelompok) }}" method="POST">
                @csrf
                @method('PUT')


                <div class="form-group mb-3">
                    <label for="nama_kelompok">Nama Kelompok</label>
                    <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok"
                        value="{{ $kelompok->nama_kelompok }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ url('dosen/kelompok') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>
@endsection

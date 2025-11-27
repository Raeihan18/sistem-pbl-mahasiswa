@extends('layout.layout-dosen')

@section('title', 'Kelompok')

@section('content')
    <div class="d-flex align-items-center mb-2">
        {{-- Tombol Tambah Kelompok --}}
        <a href="{{ url('dosen/kelompok/create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Kelompok
        </a>
        <form class="ms-auto d-none d-sm-inline-block mw-200" style="width: 250px;">
            <div class="input-group">
                <input type="text" class="form-control bg-light small" placeholder="Search for..." aria-label="Search">
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Data Kelompok (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelompok as $index => $klp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $klp['nama_kelompok'] }}</td>
                            <td>
                                <a href="{{ url('dosen/kelompok/edit/' . $klp['id_kelompok']) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ url('dosen/kelompok/delete/' . $klp['id_kelompok']) }}"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

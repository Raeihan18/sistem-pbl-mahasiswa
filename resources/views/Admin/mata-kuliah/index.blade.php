@extends('layout.layout-admin')

@section('title', 'Mata Kuliah')

@section('content')
    {{-- Tombol Tambah Mata Kuliah --}}

    <div class="d-flex align-items-center mb-2">
    <a href="/admin/mata-kuliah/create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Mata Kuliah
    </a>

    <form class="ms-auto d-none d-sm-inline-block mw-200" style="width: 250px;">
        <div class="input-group">
            <input type="text" class="form-control bg-light small"
                   placeholder="Search for..." aria-label="Search">
            <button class="btn btn-primary" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

</div>




    {{-- Tabel Data Mata Kuliah (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mataKuliah as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mk['nama_matkul'] }}</td>
                            <td>
                                <a href="/admin/mata-kuliah/edit/{{ $mk['id_matkul'] }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/admin/mata-kuliah/delete/{{ $mk['id_matkul'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

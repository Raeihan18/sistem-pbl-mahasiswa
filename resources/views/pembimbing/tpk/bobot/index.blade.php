@extends('layout.layout-admin')

@section('title', 'Mahasiswa')

@section('content')
    <div class="mb-3">
        {{-- Tombol Tambah Mahasiswa --}}
        <a href="/admin/bobot/edit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Edit Bobot
        </a>
    </div>

    {{-- Tabel Data Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>kriteria</th>
                        <th>bobot</th>
                        <th>tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bobots as $bobot)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bobot->kriteria }}</td>
                            <td>{{ $bobot->bobot }}</td>
                            <td>{{ $bobot->tipe }}</td>
{{-- 
                            <td>
                                 <a href="/dosen/mahasiswa/edit/{{ $mhs['id_mahasiswa'] }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/dosen/mahasiswa/delete/{{ $mhs['id_mahasiswa'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a> 
                            </td>  --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('dosen/mahasiswa/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file" accept=".xlsx,.csv" class="form-control" required>
                        <small class="text-muted">Format file: Excel (.xlsx) atau CSV (.csv)</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

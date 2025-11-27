@extends('layout.layout-kaprodi')

@section('title', 'Mahasiswa')

@section('content')
    <div class="d-flex align-items-center mb-2">
        <form class="ms-auto d-none d-sm-inline-block mw-200" style="width: 250px;">
            <div class="input-group">
                <input type="text" class="form-control bg-light small" placeholder="Search for..." aria-label="Search">
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="mb-3">
    </div>

    {{-- Tabel Data Mahasiswa (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Id Kelompok</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $index => $mhs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs['nim'] }}</td>
                            <td>{{ $mhs['nama'] }}</td>
                            <td>{{ $mhs['kelas'] }}</td>
                            <td>{{ $mhs['nama_kelompok'] }}</td>
                            <td>{{ $mhs['email'] }}</td>
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

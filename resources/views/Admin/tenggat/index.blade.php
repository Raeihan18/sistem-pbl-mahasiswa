@extends('layout.layout-admin')

@section('title', 'Tenggat Penilaian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.tenggat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Tenggat
        </a>
        <a href="{{ route('admin.tenggat.test') }}" class="btn btn-success">
            <i class="fas fa-paper-plane"></i> Kirim Notifikasi Uji
        </a>
        <a href="{{ route('admin.tenggat.broadcast') }}" class="btn btn-success">
            <i class="fas fa-paper-plane"></i> Kirim Broadcast Dosen
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Tahun Ajaran</th>
                    <th>Tanggal Tenggat</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tenggat as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tahun_ajaran }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_tenggat)->format('d F Y H:i') }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.tenggat.edit', $item->id_tenggat) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.tenggat.delete', $item->id_tenggat) }}"
                               onclick="return confirm('Yakin ingin menghapus data ini?')"
                               class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data tenggat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
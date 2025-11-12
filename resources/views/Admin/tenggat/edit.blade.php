@extends('layout.layout-admin')

@section('title', 'Edit Tenggat Penilaian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.tenggat.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.tenggat.update', $tenggat->id_tenggat) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" id="tahun_ajaran"
                       class="form-control @error('tahun_ajaran') is-invalid @enderror"
                       value="{{ old('tahun_ajaran', $tenggat->tahun_ajaran) }}">
                @error('tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_tenggat">Tanggal Tenggat</label>
                <input type="datetime-local" name="tanggal_tenggat" id="tanggal_tenggat"
                       class="form-control @error('tanggal_tenggat') is-invalid @enderror"
                       value="{{ old('tanggal_tenggat', \Carbon\Carbon::parse($tenggat->tanggal_tenggat)->format('Y-m-d\TH:i')) }}">
                @error('tanggal_tenggat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
    <label for="waktu_kirim_notif">Waktu Kirim Notifikasi</label>
    <input type="datetime-local" name="waktu_kirim_notif" id="waktu_kirim_notif"
           class="form-control"
           value="{{ old('waktu_kirim_notif', \Carbon\Carbon::parse($tenggat->waktu_kirim_notif)->format('Y-m-d\TH:i')) }}">
</div>


            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Perbarui
            </button>
        </form>
    </div>
</div>
@endsection
@extends('layout.layout-dosen')

@section('title', 'Edit Mahasiswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Mahasiswa</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('dosen/mahasiswa/update', $mahasiswa->id_mahasiswa) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim"
                        value="{{ $mahasiswa->nim }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ $mahasiswa->nama }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="kelas">Kelas</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                        <option value="" disabled>Pilih Kelas</option>
                        <option value="TI-3A" {{ $mahasiswa->kelas == 'TI-3A' ? 'selected' : '' }}>TI-3A</option>
                        <option value="TI-3B" {{ $mahasiswa->kelas == 'TI-3B' ? 'selected' : '' }}>TI-3B</option>
                        <option value="TI-3C" {{ $mahasiswa->kelas == 'TI-3C' ? 'selected' : '' }}>TI-3C</option>
                        <option value="TI-3D" {{ $mahasiswa->kelas == 'TI-3D' ? 'selected' : '' }}>TI-3D</option>
                        <option value="TI-3E" {{ $mahasiswa->kelas == 'TI-3E' ? 'selected' : '' }}>TI-3E</option>
                    </select>
                </div>

                {{-- Pilih Kelompok --}}
                <div class="form-group mb-3">
                    <label for="id_kelompok">Kelompok</label>
                    <select class="form-control" id="id_kelompok" name="id_kelompok" required>
                        <option value="" disabled>Pilih Kelompok</option>
                        @foreach ($kelompok as $klp)
                            <option value="{{ $klp->id_kelompok }}"
                                {{ $mahasiswa->id_kelompok == $klp->id_kelompok ? 'selected' : '' }}>
                                {{ $klp->nama_kelompok }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $mahasiswa->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password (opsional)</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('mahasiswa/index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

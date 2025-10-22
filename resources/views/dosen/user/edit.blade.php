@extends('layout.layout-admin')

@section('title', 'Edit User')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('dosen/user/update', $user->id_user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" 
                           value="{{ old('nama', $user->nama) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password (opsional)</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="form-group mb-3">
                    <label for="level">Level</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="kaprodi" {{ $user->level == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                        <option value="dosen" {{ $user->level == 'dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="pembimbing" {{ $user->level == 'pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('dosen/user/') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

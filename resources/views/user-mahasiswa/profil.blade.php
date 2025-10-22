@extends('layout.layout-mahasiswa')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Profil Mahasiswa</h1>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4 text-center">
                <div class="card-body">
                    <img src="{{ asset('storage/potoprofil/' . ($authUser->potoprofil ?? 'default-avatar.png')) }}"
                        class="img-fluid rounded-circle mb-3" alt="Foto Profil" width="150">
                    
                    <h5 class="card-title">{{ $authUser->nama }}</h5>
                    <p class="card-text">{{ $authUser->email }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">NIM</th>
                            <td>{{ $authUser->nim }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $authUser->kelas }}</td>
                        </tr>
                        <tr>
                            <th>Kelompok</th>
                            <td>{{ $authUser->kelompok->nama_kelompok ?? '-' }}</td>
                        </tr>
                    </table>

                    <a href="{{ url('mahasiswa/profil/edit/' . $authUser->id_mahasiswa) }}" 
                       class="btn btn-primary mt-3">
                        Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

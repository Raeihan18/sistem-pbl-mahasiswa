@extends('layout.layout-admin')

@section('title', 'Profil Dosen')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Profil Dosen</h1>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4 text-center">
                <div class="card-body">
                    <img src="{{ asset('images/' . $profil['foto']) }}" class="img-fluid rounded-circle mb-3" alt="Foto Profil" width="150">
                    <h5 class="card-title">{{ $profil['nama'] }}</h5>
                    <p class="card-text">{{ $profil['email'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Dosen</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">NIDN/NIP</th>
                            <td>{{ $profil['nidn'] }}</td>
                        </tr>
                        <tr>
                            <th>Mata Kuliah Diampu</th>
                            <td>
                                <ul>
                                    @foreach($profil['matkul'] as $m)
                                    <li>{{ $m }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>

                    <a href="#" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.layout-admin')


@section('title', 'Profil Kaprodi')


@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Profil Kaprodi</h1>
<div class="d-flex align-items-center mb-2">
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

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4 text-center">
                    <div class="card-body">
                        <img src="{{ asset('storage/potoprofil/' . ($profil->potoprofil ?? 'default-avatar.png')) }}""
                            class="img-fluid rounded-circle mb-3" alt="Foto Profil" width="150">
                        {{-- {{ dd($user) }} --}}
                        <h5 class="card-title">{{ $authUser->nama }}</h5>
                        <p class="card-text">{{ $authUser->email }}</p>
                    </div>
                </div>
            </div>


            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Kaprodi</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="200">NIP</th>
                                <td>{{ $profil['NIP'] }}</td>
                            </tr>
                            <tr>
                                <th>Mata Kuliah Diampu</th>
                                <td>
                                    @if (isset($matkul_kaprodi) && $matkul_kaprodi->count() > 0)
                                        <ul class="mb-0">
                                            @foreach ($matkul_kaprodi as $mk)
                                                <li>{{ $mk->nama_matkul }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted mb-0">Belum ada mata kuliah yang diampu.</p>
                                    @endif
                                </td>
                            </tr>


                        </table>


                        <a href="/kaprodi/profil/edit/{{ $profil['id_user'] }}" class="btn btn-primary mt-3">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

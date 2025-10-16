@extends('layout.layout-kaprodi')

@section('title', 'User')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">User</h1>

    {{-- Tabel Data User (Data Dummy) --}}
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $mahasiswa = [
                            ['nim' => '230101001', 'nama' => 'Andi Saputra', 'prodi' => 'Informatika'],
                            ['nim' => '230101002', 'nama' => 'Budi Santoso', 'prodi' => 'Sistem Informasi'],
                            ['nim' => '230101003', 'nama' => 'Citra Dewi', 'prodi' => 'Teknik Komputer'],
                            ['nim' => '230101004', 'nama' => 'Diana Puspita', 'prodi' => 'Manajemen Informatika'],
                        ];
                    @endphp

                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $user['nama'] }}</td>
                            <td>{{ $user['level'] }}</td>
                            <td>{{ $user['email'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

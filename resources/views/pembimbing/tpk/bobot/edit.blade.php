@extends('layout.layout-admin')
@section('title', 'Perbandingan Kepentingan (AHP)')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tabel Kepentingan Kriteria (AHP)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('ahp.hitung') }}" method="POST">
        @csrf
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Kriteria</th>
                    @foreach ($kriteria as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $i => $row)
                    <tr>
                        <th>{{ $row }}</th>
                        @foreach ($kriteria as $j => $col)
                            @if ($i == $j)
                                <td>
                                    <input type="number" class="form-control text-center" value="1" readonly>
                                </td>
                            @elseif ($i < $j)
                                <td>
                                    <input type="number" name="nilai_{{ $i }}_{{ $j }}" 
                                           class="form-control text-center" step="0.01" min="0.11" max="9" required>
                                </td>
                            @else
                                <td class="bg-light text-muted">
                                    {{-- otomatis terisi 1/x di controller --}}
                                    <span>-</span>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">Hitung Bobot</button>
        </div>
    </form>

    <hr>
    <h4 class="mt-4">Bobot Kriteria Saat Ini</h4>
    <table class="table table-striped w-50">
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach(DB::table('bobot')->get() as $item)
                <tr>
                    <td>{{ $item->kriteria }}</td>
                    <td>{{ $item->bobot ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

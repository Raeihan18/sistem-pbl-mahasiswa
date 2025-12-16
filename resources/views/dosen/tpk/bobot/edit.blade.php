@extends('layout.layout-dosen')
@section('title', 'Perbandingan Kepentingan (AHP)')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tabel Kepentingan Kriteria (AHP)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('ahp.hitung') }}" method="POST">
        @csrf
        <table id="ahpTable" class="table table-bordered text-center align-middle">
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
                                {{-- diagonal utama = 1 --}}
                                <td>
                                    <input type="number" class="form-control text-center" value="1" readonly>
                                </td>
                            @elseif ($i < $j)
                                {{-- bagian atas: user isi manual --}}
                                <td>
                                    <input type="number" 
                                           name="nilai_{{ $i }}_{{ $j }}" 
                                           class="form-control text-center pair-input"
                                           data-i="{{ $i }}" 
                                           data-j="{{ $j }}"
                                           step="0.01" min="0.11" max="9" required>
                                </td>
                            @else
                                {{-- bagian bawah: otomatis menampilkan 1/x --}}
                                <td class="bg-light text-muted" id="cell_{{ $i }}_{{ $j }}">-</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-calculator"></i> Hitung Bobot
            </button>
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

{{-- === SCRIPT AHP INTERAKTIF === --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".pair-input");

    inputs.forEach(input => {
        input.addEventListener("input", function() {
            const i = this.dataset.i;
            const j = this.dataset.j;
            const val = parseFloat(this.value);

            const targetCell = document.getElementById(`cell_${j}_${i}`);

            if (!isNaN(val) && val > 0) {
                const reciprocal = (1 / val).toFixed(2);

                if (targetCell) {
                    targetCell.innerHTML = reciprocal;
                    targetCell.classList.remove("text-muted");
                    targetCell.style.fontWeight = "bold";
                    targetCell.style.color = "#2c3e50";
                }
            } else {
                if (targetCell) {
                    targetCell.innerHTML = "-";
                }
            }
        });
    });
});

</script>
@endsection
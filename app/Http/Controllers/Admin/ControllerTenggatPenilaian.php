<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TenggatPenilaian;
use App\Helpers\WhatsappHelper;
use App\Models\User;
use Carbon\Carbon;

class ControllerTenggatPenilaian extends Controller
{
    public function index()
    {
        $tenggat = TenggatPenilaian::orderBy('tanggal_tenggat', 'desc')->get();
        $title = "Tenggat Penilaian";
        return view('admin.tenggat.index', compact('tenggat', 'title'));
    }

    public function create()
    {
        $title = "Tambah Tenggat Penilaian";
        return view('admin.tenggat.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'tanggal_tenggat' => 'required|date',
            'waktu_kirim_notif' => 'nullable|date',
        ]);

        $tanggal_tenggat = Carbon::parse($request->tanggal_tenggat);
        $waktu_kirim = $request->waktu_kirim_notif
            ? Carbon::parse($request->waktu_kirim_notif)
            : $tanggal_tenggat->copy()->subDay(); // default 1 hari sebelum tenggat

        TenggatPenilaian::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'tanggal_tenggat' => $tanggal_tenggat,
            'waktu_kirim_notif' => $waktu_kirim,
        ]);

        return redirect()->route('admin.tenggat.index')->with('success', 'Tenggat penilaian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tenggat = TenggatPenilaian::findOrFail($id);
        $title = "Edit Tenggat Penilaian";
        return view('admin.tenggat.edit', compact('tenggat', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'tanggal_tenggat' => 'required|date',
            'waktu_kirim_notif' => 'nullable|date',
        ]);

        $tenggat = TenggatPenilaian::findOrFail($id);

        $tanggal_tenggat = Carbon::parse($request->tanggal_tenggat);
        $waktu_kirim = $request->waktu_kirim_notif
            ? Carbon::parse($request->waktu_kirim_notif)
            : $tanggal_tenggat->copy()->subDay(); // default tetap 1 hari sebelum

        $tenggat->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'tanggal_tenggat' => $tanggal_tenggat,
            'waktu_kirim_notif' => $waktu_kirim,
        ]);

        return redirect()->route('admin.tenggat.index')->with('success', 'Data tenggat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tenggat = TenggatPenilaian::findOrFail($id);
        $tenggat->delete();

        return redirect()->route('admin.tenggat.index')->with('success', 'Data tenggat berhasil dihapus.');
    }

    /**
     * 🧪 Fungsi testing kirim notifikasi WhatsApp
     * Kirim ke nomor tertentu (misal nomor admin / kamu sendiri)
     */
    public function testNotif(Request $request)
    {
        // Ambil tenggat terbaru
        $tenggat = TenggatPenilaian::latest('tanggal_tenggat')->first();

        if (!$tenggat) {
            return response()->json(['status' => 'Belum ada tenggat yang ditentukan.']);
        }

        // Nomor WA untuk testing (bisa kamu ganti)
        $targetNumber = $request->input('target', env('FONNTE_TEST_NUMBER', null));

        if (!$targetNumber) {
            return response()->json([
                'status' => 'Nomor WA untuk testing belum diset. Tambahkan ?target=628xxx atau isi FONNTE_TEST_NUMBER di .env'
            ]);
        }

        $message = "📢 *PBL Mahasiswa (Testing)*\n\n"
            . "Halo, ini pesan uji kirim dari sistem PBL Mahasiswa.\n\n"
            . "Batas akhir pengisian nilai terbaru adalah:\n"
            . "🗓️ *" . Carbon::parse($tenggat->tanggal_tenggat)
                ->locale('id')
                ->translatedFormat('d F Y H:i') . " WIB*\n\n"
            . "Pesan ini dikirim otomatis melalui sistem Laravel menggunakan *Fonnte API* ✅";

        $response = WhatsappHelper::sendMessage($targetNumber, $message);

        return response()->json([
            'status' => 'Pesan testing dikirim.',
            'target' => $targetNumber,
            'response' => $response,
        ]);
    }

    /**
     * 📨 Kirim ke semua dosen (hanya jika sudah siap produksi)
     */
    public function broadcastDosen()
    {
        $tenggat = TenggatPenilaian::latest('tanggal_tenggat')->first();

        if (!$tenggat) {
            return response()->json(['status' => 'Belum ada tenggat yang ditentukan.']);
        }

        $dosens = User::whereNotNull('no_wa')->where('level', 'dosen')->get();

        foreach ($dosens as $dosen) {
            $message = "📢 *PBL Mahasiswa Reminder*\n\n"
                . "Halo Pak/Bu {$dosen->nama},\n"
                . "Batas akhir pengisian nilai adalah *"
                . Carbon::parse($tenggat->tanggal_tenggat)
                    ->locale('id')
                    ->translatedFormat('d F Y H:i') . " WIB*.\n\n"
                . "Mohon segera melengkapi nilai mahasiswa sebelum tenggat waktu.\n"
                . "Terima kasih 🙏";

            WhatsappHelper::sendMessage($dosen->no_wa, $message);
        }

        return response()->json(['status' => 'Pesan broadcast berhasil dikirim ke semua dosen.']);
    }
}
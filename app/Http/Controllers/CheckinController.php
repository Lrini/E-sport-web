<?php

namespace App\Http\Controllers;
use App\Models\penonton as Penonton;


use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function checkin(Request $request)
    {
        $request->validate([
            'tiket_code' => 'required|string'
        ]);

        $penonton = Penonton::where('tiket_code', $request->tiket_code)->first();

        if (!$penonton) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Tiket tidak valid'
            ]);
        }

        if ($penonton->checked_in_at) {
            return response()->json([
                'status' => 'used',
                'message' => 'Tiket sudah digunakan'
            ]);
        }

        $penonton->update([
            'checked_in_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Check-in berhasil'
        ]);
    }

    public function getData()
    {
    // Mengambil data langsung dari tabel penonton tanpa relasi
    $penontons = penonton::whereNotNull('checked_in_at')->get()->map(function ($penonton) {
        return [
            'id' => $penonton->id,
            'nama_lengkap' => $penonton->nama_lengkap,
            // Memastikan checked_in_at diformat jika tidak null
            'checked_in_at' => $penonton->checked_in_at
                ? \Carbon\Carbon::parse($penonton->checked_in_at)->format('Y-m-d')
                : 'Belum Check-in',
        ];
    });

    return response()->json(['data' => $penontons]);
    }
}

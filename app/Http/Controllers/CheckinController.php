<?php

namespace App\Http\Controllers;
use App\Models\Penonton;


use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function checkin(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);

        $penonton = Penonton::where('tiket_code', $request->ticket_code)->first();

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
}

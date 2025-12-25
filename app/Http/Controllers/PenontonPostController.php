<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penonton;
use App\Models\lomba;
use App\Models\acara;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PenontonPostController extends Controller
{
    public function index()
    {
        $lombas = lomba::all();
        $acaras = acara::all();
        return view('admin.dashboard.penonton.index', compact('lombas', 'acaras'));
    }

    public function getdata()
    {
        $penontons = penonton::with(['lomba', 'acara'])->get()->map(function ($penonton) {
            return [
                'id' => $penonton->id,
                'nama_lengkap' => $penonton->nama_lengkap,
                'nama_lomba' => $penonton->lomba ? $penonton->lomba->nama_lomba : 'N/A',
                'nama_acara' => $penonton->acara ? $penonton->acara->nama_acara : 'N/A',
                'no_hp' => $penonton->no_hp,
                'biaya_tiket' => 'Rp ' . number_format($penonton->biaya_tiket, 0, ',', '.'),
                'status_pembayaran' => ucfirst($penonton->status_pembayaran),
            ];
        });
        return response()->json(['data' => $penontons]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'id_lomba' => 'required|integer|exists:lombas,id',
            'id_acara' => 'required|integer|exists:acaras,id',
            'no_hp' => 'required|string|max:15',
            'biaya_tiket' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a unique uuid
        do {
            $uuid = mt_rand(100000, 999999);
        } while (penonton::where('uuid', $uuid)->exists());
        $validatedData['uuid'] = $uuid;

        // Set default status pembayaran
        $validatedData['status_pembayaran'] = 'pending';

        // Set biaya_tiket if not provided
        if (!isset($validatedData['biaya_tiket'])) {
            $validatedData['biaya_tiket'] = 0;
        }

        // Handle file upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bukti_tonton', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create a new Penonton record
        penonton::create($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Registration successful!');
    }
}

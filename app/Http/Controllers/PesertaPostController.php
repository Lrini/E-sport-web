<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PesertaPostController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'penanggung_jawab' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
            'id_lomba' => 'required|integer|exists:lombas,id',
            'no_hp' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_grade' => 'required|integer|exists:grades,id',
        ]);

        // Generate a unique uuid
        do {
            $uuid = mt_rand(100000, 999999);
        } while (Peserta::where('uuid', $uuid)->exists());
        $validatedData['uuid'] = $uuid;

        // Handle file upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bukti_pembayaran', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create a new Peserta record
        Peserta::create($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Registration successful!');
    }
}

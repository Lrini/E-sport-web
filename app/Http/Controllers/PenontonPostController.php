<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penonton;
use App\Models\lomba;
use App\Models\acaras;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PenontonPostController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'id_lomba' => 'required|integer|exists:lombas,id',
            'tanggal_acara' => 'required|integer|exists:acaras,id',
            'no_hp' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a unique uuid
        do {
            $uuid = mt_rand(100000, 999999);
        } while (penonton::where('uuid', $uuid)->exists());
        $validatedData['uuid'] = $uuid;

        // Rename tanggal_acara to id_acara for database insertion
        $validatedData['id_acara'] = $validatedData['tanggal_acara'];
        unset($validatedData['tanggal_acara']);

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

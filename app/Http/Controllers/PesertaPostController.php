<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\lomba;
use App\Models\grade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PesertaPostController extends Controller
{
    public function index()
    {
        $lombas = lomba::all();
        $grades = grade::all();
        return view('admin.dashboard.peserta.index', compact('lombas', 'grades'));
    }

    public function getdata()
    {
        $pesertas = Peserta::with(['lomba', 'grade'])->get()->map(function ($peserta) {
            return [
                'id' => $peserta->id,
                'penanggung_jawab' => $peserta->penanggung_jawab,
                'nama_sekolah' => $peserta->nama_sekolah,
                'nama_lomba' => $peserta->lomba ? $peserta->lomba->nama_lomba : 'N/A',
                'tingkat' => $peserta->grade ? $peserta->grade->tingkat : 'N/A',
                'no_hp' => $peserta->no_hp,
                'biaya_daftar' => $peserta->lomba ? $peserta->lomba->biaya_daftar : 'N/A',
                'status_pembayaran' => ucfirst($peserta->status_pembayaran),
            ];
        });
        return response()->json(['data' => $pesertas]);
    }

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

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $lombas = lomba::all();
        $grades = grade::all();
        return view('admin.dashboard.peserta.update', compact('peserta', 'lombas', 'grades'));
    }
    public function update (Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $validateData = $request->validate([
            'penanggung_jawab' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
            'id_lomba' => 'required|integer|exists:lombas,id',
            'id_grade' => 'required|integer|exists:grades,id',
            'no_hp' => 'required|string|max:15',
            'status_pembayaran' => 'required|in:pending,lunas,batal',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Handle file upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($peserta->image && Storage::disk('public')->exists($peserta->image)) {
                Storage::disk('public')->delete($peserta->image);       
            }
            $imagePath = $request->file('image')->store('bukti_pembayaran', 'public');
            $validateData['image'] = $imagePath;
        }   
        $peserta->update($validateData);
        return redirect()->route('peserta.index')->with('success', 'Peserta updated successfully!');

    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        // Delete image if exists
        if ($peserta->image && Storage::disk('public')->exists($peserta->image)) {
            Storage::disk('public')->delete($peserta->image);
        }
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta deleted successfully!');
    }
}
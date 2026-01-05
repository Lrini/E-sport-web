<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penonton;
use App\Models\lomba;
use App\Models\acara;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
                'tiket_code' => $penonton->tiket_code,
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
        // if ($request->hasFile('image')) {
        //    // $imagePath = $request->file('image')->store('bukti_tonton', 'public');
        //     //$validatedData['image'] = $imagePath;
        // }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nama = Str::slug($request->nama_lengkap,'-');
            $filename = $nama.'_'.$uuid.'_'.time().'.jpg';
            $img = Image::make($image->getRealPath())
            ->resize(1080,null,function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            }) ->encode('jpg',75);
            $savePath = storage_path('app/public/bukti_tonton/'.$filename);
            $img->save($savePath);
            $validatedData['image'] = 'bukti_tonton/'.$filename;
           // $imagePath = $request->file('image')->store('bukti_pembayaran', 'public');
        //$validatedData['image'] = $imagePath;
        }

        // Create a new Penonton record
        penonton::create($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Registration successful!');
    }

    public function edit($id)
    {
        $penonton = penonton::findOrFail($id);
        $lombas = lomba::all();
        $acaras = acara::all();
        return view('admin.dashboard.penonton.update', compact('penonton', 'lombas', 'acaras'));
    }

    public function update(Request $request, $id)
    {
        $penonton = penonton::findOrFail($id);

        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'id_lomba' => 'required|integer|exists:lombas,id',
            'id_acara' => 'required|integer|exists:acaras,id',
            'no_hp' => 'required|string|max:15',
            'biaya_tiket' => 'nullable|numeric|min:0',
            'status_pembayaran' => 'required|string|in:pending,lunas,batal',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($penonton->image && Storage::disk('public')->exists($penonton->image)) {
                Storage::disk('public')->delete($penonton->image);
            }
            $imagePath = $request->file('image')->store('bukti_tonton', 'public');
            $validatedData['image'] = $imagePath;
        }

        if ($penonton->status_pembayaran !== 'lunas'){
            $penonton->tiket_code = $this->generateTiketCode();
            $penonton->tiket_generated_at = now();
        }

        $penonton->update($validatedData);

        return redirect()->route('penonton.index')->with('success', 'Penonton berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penonton = penonton::findOrFail($id);

        // Delete associated image if exists
        if ($penonton->image && Storage::disk('public')->exists($penonton->image)) {
            Storage::disk('public')->delete($penonton->image);
        }

        $penonton->delete();

        return redirect()->route('penonton.index')->with('success', 'Penonton berhasil dihapus.');
    }

    private function generateTiketCode()
    {
        do{
        $code ='EVNT-NTN-'.Str::upper(Str::random(6));
    }while (penonton::where('tiket_code', $code)->exists());

        return $code;
    }
}

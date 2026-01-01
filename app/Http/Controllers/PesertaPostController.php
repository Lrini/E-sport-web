<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\lomba;
use App\Models\grade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
                'bukti_pembayaran' => $peserta->gdrive_url ? str_replace('/view?usp=sharing', '/preview', $peserta->gdrive_url) : null,
            ];
        });
        return response()->json(['data' => $pesertas]);
    }

    // public function store(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'penanggung_jawab' => 'required|string|max:255',
    //         'nama_sekolah' => 'required|string|max:255',
    //         'id_lomba' => 'required|integer|exists:lombas,id',
    //         'no_hp' => 'required|string|max:15',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'id_grade' => 'required|integer|exists:grades,id',
    //     ]);

    //     // Generate a unique uuid
    //     do {
    //         $uuid = mt_rand(100000, 999999);
    //     } while (Peserta::where('uuid', $uuid)->exists());
    //     $validatedData['uuid'] = $uuid;

    //     // Handle file upload if present
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $nama = Str::slug($request->penanggung_jawab,'-');
    //         $filename = $nama.'_'.$uuid.'_'.time().'.jpg';
    //         $img = Image::make($image->getRealPath())
    //         ->resize(1080,null,function($constraint){
    //             $constraint->aspectRatio();
    //             $constraint->upsize();
    //         }) ->encode('jpg',75);
    //         $filePath = 'bukti_bayar/'.$filename;
    //         Storage::disk('google')->put($filePath, $img->stream());

    //         // Simpan link / path ke database
    //         $validatedData['image'] = $filePath;
    //         // $savePath = storage_path('app/public/bukti_pembayaran/'.$filename);
    //         // $img->save($savePath);
    //         // $validatedData['image'] = 'bukti_pembayaran/'.$filename;
    //        // $imagePath = $request->file('image')->store('bukti_pembayaran', 'public');
    //     //$validatedData['image'] = $imagePath;
    //     }

    //     // Create a new Peserta record
    //     Peserta::create($validatedData);

    //     // Redirect back with success message
    //     return redirect()->back()->with('success', 'Registration successful!');
    // }

    public function store(Request $request)
{
    // Validasi
    $validatedData = $request->validate([
        'penanggung_jawab' => 'required|string|max:255',
        'nama_sekolah' => 'required|string|max:255',
        'id_lomba' => 'required|integer|exists:lombas,id',
        'no_hp' => 'required|string|max:15',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'id_grade' => 'required|integer|exists:grades,id',
    ]);

    // Generate UUID unik
    do {
        $uuid = mt_rand(100000, 999999);
    } while (Peserta::where('uuid', $uuid)->exists());
    $validatedData['uuid'] = $uuid;


    
    if ($request->hasFile('image')) {

        $folderId = env('GOOGLE_DRIVE_FOLDER_ID'); // Folder ID dari .env
        $image = $request->file('image');

        $nama = Str::slug($request->penanggung_jawab,'-');
        $filename = $nama.'_'.$uuid.'_'.time().'.jpg';

        // Resize
        $img = Image::make($image->getRealPath())
            ->resize(1080, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('jpg', 75);

        // 🚀 Ambil API Drive
        $googleService = Storage::disk('google')->getDriver()->getAdapter()->getService();

        // 🚀 Siapkan metadata file + parent folder
        $fileMetadata = new \Google\Service\Drive\DriveFile([
            'name' => $filename,
            'parents' => [$folderId], // langsung ke folder tujuan
        ]);

        // Upload ke Google Drive
        $file = $googleService->files->create($fileMetadata, [
            'data' => $img->stream()->__toString(),
            'mimeType' => 'image/jpeg',
            'uploadType' => 'multipart'
        ]);

        $fileId = $file->id;

        //  Set file menjadi public agar bisa dibuka
        $googleService->permissions->create($fileId, new \Google\Service\Drive\Permission([
            'role' => 'reader',
            'type' => 'anyone',
        ]));

        // URL publik
        $url = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

        // Simpan ke database
        $validatedData['image'] = $fileId;
        $validatedData['gdrive_url'] = $url;
    }

    // Simpan ke DB
    Peserta::create($validatedData);

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
            $folderId = env('GOOGLE_DRIVE_FOLDER_ID'); // Folder ID dari .env
            $image = $request->file('image');

            $nama = Str::slug($request->penanggung_jawab,'-');
            $filename = $nama.'_'.$peserta->uuid.'_'.time().'.jpg';

            // Resize
            $img = Image::make($image->getRealPath())
                ->resize(1080, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 75);

            // Ambil API Drive
            $googleService = Storage::disk('google')->getDriver()->getAdapter()->getService();

            // Siapkan metadata file + parent folder
            $fileMetadata = new \Google\Service\Drive\DriveFile([
                'name' => $filename,
                'parents' => [$folderId], // langsung ke folder tujuan
            ]);

            // Upload ke Google Drive
            $file = $googleService->files->create($fileMetadata, [
                'data' => $img->stream()->__toString(),
                'mimeType' => 'image/jpeg',
                'uploadType' => 'multipart'
            ]);

            $fileId = $file->id;

            // Set file menjadi public agar bisa dibuka
            $googleService->permissions->create($fileId, new \Google\Service\Drive\Permission([
                'role' => 'reader',
                'type' => 'anyone',
            ]));

            // URL publik
            $url = "https://drive.google.com/file/d/$fileId/view?usp=sharing";

            // Simpan ke database
            $validateData['image'] = $fileId;
            $validateData['gdrive_url'] = $url;

            // Delete old image from Google Drive if exists
            if ($peserta->image && !Storage::disk('public')->exists($peserta->image)) {
                try {
                    $googleService->files->delete($peserta->image);
                } catch (\Exception $e) {
                    // Ignore if file not found or already deleted
                }
            }
        }
        $peserta->update($validateData);
        return redirect()->route('peserta.index')->with('success', 'Peserta updated successfully!');

    }

    public function destroy($id)
{
    $peserta = Peserta::findOrFail($id);

    // 1. Cek apakah ada data di kolom image (ID File GDrive)
    if ($peserta->image) {
        try {
            // 2. Inisialisasi Google Service melalui Storage disk 'google'
            $googleService = Storage::disk('google')->getDriver()->getAdapter()->getService();
            
            // 3. Hapus file berdasarkan ID yang tersimpan di database
            $googleService->files->delete($peserta->image);
        } catch (\Exception $e) {
            // Log error jika file tidak ditemukan di Drive, agar proses delete database tetap lanjut
            Log::error("Gagal menghapus file di GDrive: " . $e->getMessage());
        }
    }

    // 4. Hapus data peserta dari database
    $peserta->delete();

    return redirect()->route('peserta.index')->with('success', 'Peserta dan bukti pembayaran berhasil dihapus!');
}
}
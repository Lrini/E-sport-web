<?php

namespace App\Http\Controllers;
use App\Models\penonton;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class tiketPdfController extends Controller
{
    public function generate($penonton)
    {
        // Generate QR (base64)
        $qr = base64_encode(
            QrCode::format('svg')
                ->size(300)
                ->generate($penonton->tiket_code)
        );

        // Render PDF
        $pdf = Pdf::loadView('admin.pdf.tiket', [
            'penonton' => $penonton,
            'qr' => $qr
        ]);

        // Nama file
        $filename = 'tiket_' . $penonton->tiket_code . '.pdf';
        $path = 'tiket/' . $filename;

        // Pastikan direktori ada
         Storage::disk('public')->put($path, $pdf->output());

        // 5. Simpan path PDF ke database
        $penonton->update([
            'tiket_pdf' => $path
        ]);
    }
}
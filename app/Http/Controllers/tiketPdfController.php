<?php

namespace App\Http\Controllers;
use App\Models\penonton;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class tiketPdfController extends Controller
{
    public function show($id)
    {
        $penonton = Penonton::with('acara')->findOrFail($id);

        $pdf = PDF::loadView('admin.pdf.tiket', compact('penonton'));

        return $pdf->stream('tiket-'.$penonton->ticket_code.'.pdf');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\acara;
use App\Models\lomba;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalAcaraController extends Controller
{
    public function index($uuid = null)
    {
        $query = acara::with('lomba');
        $selectedLomba = null;

        // If a UUID is provided, filter by that competition
        if ($uuid) {
            $selectedLomba = lomba::where('uuid', $uuid)->first();
            if ($selectedLomba) {
                $query->where('id_lomba', $selectedLomba->id);
            }
        }

        $acaras = $query->orderBy('tanggal_acara', 'asc')->get();

        // Group by date, then by lomba ID to match the view's expected structure
        $acarasByDateAndLomba = $acaras->groupBy(function ($acara) {
            return Carbon::parse($acara->tanggal_acara)->format('Y-m-d');
        })->map(function ($acarasOnDate) {
            return $acarasOnDate->groupBy('id_lomba');
        });

        return view('sportschedule', compact('acarasByDateAndLomba', 'selectedLomba'));
    }
}

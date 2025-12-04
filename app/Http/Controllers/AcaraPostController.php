<?php

namespace App\Http\Controllers;

use App\Models\acara;
use Illuminate\Http\Request;

class AcaraPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.acara.index');
    }

    public function getdata()
    {
        $acaras = acara::with('lomba')->get()->map(function ($acara) {
            return [
                'nama_acara' => $acara->lomba ? $acara->lomba->nama_lomba : 'N/A',
                'tanggal_acara' => $acara->tanggal_acara,
                'keterangan' => $acara->lokasi_acara,
                'update' => '', // Placeholder for update button
                'delete' => '', // Placeholder for delete button
            ];
        });
        return response()->json(['data' => $acaras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'lokasi_acara' => 'required|string|max:255',
        ]);

        acara::create($validatedData);

        // Redirect to the controller action instead of a named route that may not exist
        return redirect()->action([AcaraPostController::class, 'index'])->with('success', 'Acara berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function show(acara $acara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function edit(acara $acara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, acara $acara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function destroy(acara $acara)
    {
        //
    }
}

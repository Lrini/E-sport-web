<?php

namespace App\Http\Controllers;

use App\Models\acara;
use App\Models\lomba;
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
        $lombas = lomba::all();
        return view('admin.dashboard.acara.index', compact('lombas'));
    }

    public function getdata()
    {
        $acaras = acara::with('lomba')->get()->map(function ($acara) {
            return [
                'id' => $acara->id,
                'nama_acara' => $acara->nama_acara,
                'tanggal_acara' => $acara->tanggal_acara,
                'keterangan' => $acara->keterangan,
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
        $lombas = lomba::all();
        return view('admin.dashboard.acara.create', compact('lombas'));
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
            'id_lomba' => 'required|exists:lombas,id',
            'nama_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ]);

         // Generate a unique uuid
        do {
            $uuid = mt_rand(100000, 999999);
        } while (acara::where('uuid', $uuid)->exists());
        $validatedData['uuid'] = $uuid;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acara = acara::findOrFail($id);
        return view('admin.dashboard.acara.update', compact('acara'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $acara = acara::findOrFail($id);

        $validatedData = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ]);

        $acara->update($validatedData);

        return redirect()->route('acara.index')->with('success', 'Acara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\acara  $acara
     * @return \Illuminate\Http\Response
     */
    public function destroy(acara $acara)
    {
        acara::destroy($acara->id);
        return redirect()->route('acara.index')->with('success', 'Acara berhasil dihapus.');
    }
}

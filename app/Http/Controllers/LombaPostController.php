<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lomba;

class LombaPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.lomba.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdata()
    {
        $lombas = lomba::all()->map(function ($lomba) {
            return [
                'id' => $lomba->id,
                'nama_lomba' => $lomba->nama_lomba,
                'deskripsi_lomba' => $lomba->deskripsi_lomba,
                'biaya_daftar' => $lomba->biaya_daftar,
            ];
        });
        return response()->json(['data' => $lombas]);
    }

    public function create()
    {
        return view('admin.dashboard.lomba.create');
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
            'nama_lomba' => 'required|string|max:255',
            'deskripsi_lomba' => 'required|string',
            'biaya_daftar' => 'required|numeric',
        ]);

        do{
            $uuid = mt_rand(100000, 999999);
        } while (lomba::where('uuid', $uuid)->exists());
        $validatedData['uuid'] = $uuid;

        lomba::create($validatedData);

        return redirect()->action([LombaPostController::class, 'index'])->with('success', 'Lomba created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $lomba = lomba::findOrFail($id);
        return view('admin.dashboard.lomba.update', compact('lomba'));
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
        $lomba = lomba::findOrFail($id);
        $validatedData = $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'deskripsi_lomba' => 'required|string',
            'biaya_daftar' => 'required|numeric',
        ]);
        $lomba->update($validatedData);
        return redirect()->route('lomba.index')->with('success', 'Lomba updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(lomba $lomba)
    {
        $lomba->delete();
        return redirect()->route('lomba.index')->with('success', 'Lomba deleted successfully.');
    }
}

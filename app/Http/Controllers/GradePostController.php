<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\lomba;
use Illuminate\Http\Request;

class GradePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lombas = lomba::all();
        return view('admin.dashboard.grade.index', compact('lombas'));
    }

    public function getdata()
    {
        $grades = grade::with('lomba')->get()->map(function ($grade) {
            return [
                'id' => $grade->id,
                'tingkat' => $grade->tingkat,
            ];
        });
        return response()->json(['data' => $grades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = grade::all();
        return view('admin.dashboard.grade.create', compact('grades'));
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
            'tingkat' => 'required|string|max:255',
        ]);
        do{
            $uuid = mt_rand(100000, 999999);
        }while (grade::where('uuid',$uuid)->exists());
        $validatedData['uuid'] = $uuid;
        grade::create($validatedData);
        return redirect()->route('grade.index')->with('success', 'Grade created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = grade::findOrFail($id);
        $lombas = lomba::all();
        return view('admin.dashboard.grade.update', compact('grade', 'lombas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grade = grade::findOrFail($id);
        $validatedData = $request->validate([
            'tingkat' => 'required|string|max:255',
        ]);
        $grade->update($validatedData);
        return redirect()->route('grade.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(grade $grade)
    {
        grade::destroy($grade->id);
        return redirect()->route('grade.index')->with('success', 'Grade deleted successfully.');
    }
}

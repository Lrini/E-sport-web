<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class adminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdata()
    {
        $admins = User::where('role', 'admin')->get()->map(function ($admin) {
            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ];
        });
        return response()->json(['data' => $admins]);
    }


    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.dashboard.admin.create', compact('users'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $validatedData['role'] = 'admin';
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.dashboard.admin.update', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        $validatedData = $request->validate([
            'password' => 'required|string|min:8',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $admin->update($validatedData);
        return redirect()->route('admin.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        User::destroy($admin->id);
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }
}

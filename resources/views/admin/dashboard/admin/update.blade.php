@extends('admin.dashboard.layouts.main')
@section('section')

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-primary to-accent text-white">
        <h2 class="text-2xl font-bold">Update Admin</h2>
        <p class="text-sm opacity-90">Perbarui informasi admin</p>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name"    value="{{ old('name', $admin->name) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">  
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">password</label>
                <input type="text" name="password" id="password"    value="{{ old('password', $admin->password) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">  
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
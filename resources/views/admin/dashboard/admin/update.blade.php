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
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"    value="{{ old('email', $admin->email) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
                    <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="tiket" {{ old('role', $admin->role) == 'tiket' ? 'selected' : '' }}>Tiket</option>
                </select>
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
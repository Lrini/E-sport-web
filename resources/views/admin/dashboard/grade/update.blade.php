@extends('admin.dashboard.layouts.main')
@section('section')

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-primary to-accent text-white">
        <h2 class="text-2xl font-bold">Update Grade</h2>
        <p class="text-sm opacity-90">Perbarui informasi grade lomba</p>
    </div>
    <div class="p-6">
        <form action="{{ route('grade.update', $grade->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkatan</label>
                <input type="text" name="tingkat" id="tingkat" value="{{ old('tingkat', $grade->tingkat) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('grade.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
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
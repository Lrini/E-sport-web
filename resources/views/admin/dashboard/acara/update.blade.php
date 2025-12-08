@extends('admin.dashboard.layouts.main')
@section('section')

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-primary to-accent text-white">
        <h2 class="text-2xl font-bold">Update Acara</h2>
        <p class="text-sm opacity-90">Perbarui informasi acara lomba</p>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.acara.update', $acara->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="nama_acara" class="block text-sm font-medium text-gray-700">Nama Acara</label>
                <input type="text" name="nama_acara" id="nama_acara"    value="{{ old('nama_acara', $acara->nama_acara) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">  
            </div>
            <div>
                <label for="tanggal_acara" class="block text-sm font-medium text-gray-700">Tanggal Acara</label>
                <input type="date" name="tanggal_acara" id="tanggal_acara" value="{{ old('tanggal_acara', $acara->tanggal_acara->format('Y-m-d')) }}" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="4" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">{{ old('keterangan', $acara->keterangan) }}</textarea>    
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.acara.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                    Perbarui Acara
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
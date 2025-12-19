@extends('admin.dashboard.layouts.main')
@section('section')

<div class="overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="px-6 py-4 text-white bg-gradient-to-r from-primary to-accent">
        <h2 class="text-2xl font-bold">Update Lomba</h2>
        <p class="text-sm opacity-90">Perbarui informasi Lomba</p>
    </div>
    <div class="p-6">
        <form action="{{ route('lomba.update', $lomba->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="nama_lomba" class="block text-sm font-medium text-gray-700">Nama Lomba</label>
                <input type="text" name="nama_lomba" id="nama_lomba" value="{{ old('nama_lomba', $lomba->nama_lomba) }}" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">  
            </div>
           <div>
                <label for="deskripsi_lomba" class="block mb-2 text-sm font-medium text-foreground">Deskripsi Lomba *</label>
                <input id="deskripsi_lomba" type="hidden" name="deskripsi_lomba" value="{{ old('deskripsi_lomba',$lomba->deskripsi_lomba) }}">
                <trix-editor input="deskripsi_lomba" class="trix-content"></trix-editor>
                @error('deskripsi_lomba')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="biaya_daftar" class="block text-sm font-medium text-gray-700">Biaya</label>
                <input type="text" name="biaya_daftar" id="biaya_daftar" value="{{ old('biaya_daftar', $lomba->biaya_daftar) }}" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">   
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('acara.index') }}" class="px-4 py-2 font-medium text-white transition-colors duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 font-medium text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary/90">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('section')

<div class="container max-w-4xl px-4 mx-auto">
            
            <!-- Page Header -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold mb-4 text-[hsl(222,47%,11%)]">Participant Registration</h2>
                <p class="text-lg text-[hsl(215,16%,47%)]">
                    Register to compete in the Sports Competion 2026
                </p>
            </div>
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 relative" role="alert">
                    {{ session('success') }}
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'" aria-label="Close">
                        &times;
                    </button>
                </div>
            @endif
            <!-- Registration Form -->
            <div class="p-8 bg-white shadow-lg rounded-xl">
                 <!-- Important Information Section -->
                <div class="mt-8 mb-4 p-6 bg-[hsl(210,40%,96%)] rounded-lg">
                    <h3 class="font-semibold text-[hsl(222,47%,11%)] mb-3">Important Information</h3>
                    <ul class="space-y-2 text-sm text-[hsl(215,16%,47%)]">
                        <li>• Setiap pendaftaran lomba diwakilkan oleh penanggung jawab tim lomba</li>
                        <li>• Setiap lomba mempunyai biaya yang berbeda, mohon untuk lebih memperhatikan dalam mengisi form pendaftaran</li>
                        <li>• Pemberian medali dan piagam akan diberikan pada hari puncak acara yang akan diinformasikan oleh panitia</li>
                        <li>• Setiap informasi mengenai lomba akan diinformasikan via whatsapp</li>
                        <li>• Jika pendaftaran berhasil akan segera mendaptkan konfirmasi via whatsapp</li>
                    </ul>
                </div>
                <form method="post" action="/participant" enctype="multipart/form-data">
                    @csrf
                    <!-- penanggung jawab Field -->
                    <div class="mb-6">
                        <label for="penanggung_jawab" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Penanggung jawab *
                        </label>
                        <input
                            type="text"
                            id="penanggung_jawab"
                            name="penanggung_jawab"
                            class="w-full px-4 py-3 border-2 @error('penanggung_jawab') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                            placeholder="Nama penanggung jawab tim"
                            required
                        >
                         @error('penanggung_jawab')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                         @enderror
                    </div>
                    
                    <!-- Nama sekolah field -->
                    <div class="mb-6">
                        <label for="nama_sekolah" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Nama sekolah *
                        </label>
                        <input
                            type="text"
                            id="nama_sekolah"
                            name="nama_sekolah"
                            class="w-full px-4 py-3 border-2 @error('nama_sekolah') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                            placeholder="Masukan nama sekolah "
                            required
                        >
                         @error('nama_sekolah')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                         @enderror
                    </div>
                    
                    <!-- Sport Selection Field -->
                    <div class="mb-6">
                        <label for="id_lomba" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Competion *
                        </label>
                        <select
                            id="id_lomba"
                            name="id_lomba"
                            class="form-control @error('id_lomba') is-invalid @enderror w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            required
                        >
                            <option value="">Select a campetion</option>
                            @foreach($lombas as $lomba)
                                <option value="{{ $lomba->id }}">{{ $lomba->nama_lomba }}</option>
                            @endforeach
                        </select>
                            @error('id_lomba')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    
                    <!-- Contact Number Field -->
                    <div class="mb-6">
                        <label for="no_hp" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Contact Number *
                        </label>
                        <input
                            type="tel"
                            id="no_hp"
                            name="no_hp"
                            class="w-full px-4 py-3 border-2 @error('no_hp') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-blue-500 transition-colors"
                            placeholder="Enter your contact number"
                            required
                        >
                            @error('no_hp')
                                <div class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    
                    <!-- Image Upload Field -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Bukti pembayaran 
                        </label>
                        <input 
                            type="file" 
                            id="image" 
                            name="image"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            accept="image/*"
                        >
                         @error('image')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        id="submit-btn"
                        class="w-full bg-[hsl(217,91%,60%)] text-white py-4 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Register as Athlete
                    </button>
                </form>
            </div>
        </div>
<script>
     function previewImage(event) {
        const image = document.querySelector('#image');

        const file = image.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            imgPreview.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

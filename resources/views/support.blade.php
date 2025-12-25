@extends('layouts.main')
@section('section')
<div class="container max-w-4xl px-4 mx-auto pt-20">

    <!-- Page Header -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold mb-4 text-[hsl(222,47%,11%)]">Support Registration</h2>
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
             <div class="p-8 bg-white shadow-lg rounded-xl">
                 <!-- Important Information Section -->
                <div class="mt-8 mb-2 p-6 bg-[hsl(210,40%,96%)] rounded-lg">
                    <h3 class="font-semibold text-[hsl(222,47%,11%)] mb-3">Support Guidelines</h3>
                    <ul class="space-y-2 text-sm text-[hsl(215,16%,47%)]">
                        <li>• Mohon memberikan informasi yang jelas saat mengisi form pembelian</li>
                        <li>• Setiap tiket pembelian hanya berlaku dihari yang dipesan</li>
                        <li>• Pembelian tiket diluar makanan dan minuman </li>
                        <li>• Harga tiket untuk masing - masing lomba berbeda, mohon untuk teliti sebelum pemesanan.</li>
                        <li>• Tiket hanya berlaku untuk satu orang dan tidak diwakilkan </li>
                    </ul>
                </div>
                <form method="post" action="/support" enctype="multipart/form-data">
                 @csrf
                    <!-- Full Name Field -->
                    <div class="mb-6">
                        <label for="nama_lengkap" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Nama Lengkap *
                        </label>
                        <input 
                            type="text" 
                            id="nama_lengkap" 
                            name="nama_lengkap"
                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition-colors {{ $errors->has('nama_lengkap') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-[hsl(27,96%,61%)]' }}"
                            placeholder="Masukan nama lengkap anda"
                            value="{{ old('nama_lengkap') }}"
                            required
                        >
                        @error('nama_lengkap')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                         @enderror
                    </div>
                    
                    <!-- asal sekolah Field -->
                    <div class="mb-6">
                        <label for="grade" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Asal sekolah *
                        </label>
                        <input 
                            type="text" 
                            id="asal_sekolah" 
                            name="asal_sekolah"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(27,96%,61%)] transition-colors"
                            placeholder="Masukan asal sekolah anda"
                            required
                        >
                        <div class="hidden error-message" id="grade-error"></div>
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
                                <option value="{{ $lomba->id }}" data-biaya="{{ $lomba->biaya_daftar }}">{{ $lomba->nama_lomba }}</option>
                            @endforeach
                        </select>
                            @error('id_lomba')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>

                    <!-- Registration Fee Field -->
                    <div class="mb-6">
                        <label for="biaya_tiket_display" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Registration Fee
                        </label>
                        <input
                            type="text"
                            id="biaya_tiket_display"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg bg-gray-100 cursor-not-allowed"
                            readonly
                            placeholder="Select a competition to see the fee"
                        >
                        <input type="hidden" id="biaya_tiket" name="biaya_tiket" value="0">
                    </div>
                    
                    <!-- Event Name Selection Field -->
                    <div class="mb-6">
                        <label for="id_acara" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Event Name *
                        </label>
                        <select
                            id="id_acara"
                            name="id_acara"
                            class="form-control @error('id_acara') is-invalid @enderror w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            required
                            disabled
                        >
                            <option value="">Select a competition first</option>
                        </select>
                            @error('id_acara')
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
                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none transition-colors {{ $errors->has('no_hp') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-blue-500' }}"
                            placeholder="Enter your contact number"
                            value="{{ old('no_hp') }}"
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
                        Register as Supporter
                    </button>
                </form>
            </div>

            <script>
document.addEventListener('DOMContentLoaded', function() {
    // const acarasData digunakan untuk menyimpan data acaras dari server ke dalam variabel JavaScript
    // Data ini diambil dari variabel PHP $acaras yang di-encode ke format JSON sehiggaa bisa digunakan di JavaScript
    const acarasData = @json($acaras);
    
    // Mendapatkan referensi ke elemen dropdown lomba dan id acara
    const lombaSelect = document.getElementById('id_lomba');
    const idAcaraSelect = document.getElementById('id_acara');
    
    // Menambahkan event listener untuk perubahan pada dropdown lomba
    lombaSelect.addEventListener('change', function() {
        const selectedLombaId = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const biayaDaftar = selectedOption.getAttribute('data-biaya');

        // Reset dropdown id acara
        idAcaraSelect.innerHTML = '<option value="">Select a competition date</option>';

        if (selectedLombaId) {
            // Set biaya tiket
            document.getElementById('biaya_tiket_display').value = 'Rp ' + parseInt(biayaDaftar).toLocaleString('id-ID');
            document.getElementById('biaya_tiket').value = biayaDaftar;

            // Filter data acaras berdasarkan lomba yang dipilih
            const filteredAcaras = acarasData.filter(acara => acara.id_lomba == selectedLombaId);

            if (filteredAcaras.length > 0) {
                // Enable id acara dropdown
                idAcaraSelect.disabled = false;

                // Menambahkan opsi nama acara yang sesuai ke dropdown
                filteredAcaras.forEach(acara => {
                    const option = document.createElement('option');
                    option.value = acara.id;
                    option.textContent = acara.nama_acara;
                    idAcaraSelect.appendChild(option);
                });
            } else {
                // Jika tidak ada acara untuk lomba yang dipilih, disable dropdown id acara
                idAcaraSelect.disabled = true;
                idAcaraSelect.innerHTML = '<option value="">No dates available for this competition</option>';
            }
        } else {
            // Jika tidak ada lomba yang dipilih, disable dropdown id acara dan reset biaya
            idAcaraSelect.disabled = true;
            idAcaraSelect.innerHTML = '<option value="">Select a competition first</option>';
            document.getElementById('biaya_tiket_display').value = '';
            document.getElementById('biaya_tiket').value = '0';
        }
    });
});
</script>
</div>

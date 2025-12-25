@extends('admin.dashboard.layouts.main')
@section('section')

<div class="overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="px-6 py-4 text-white bg-gradient-to-r from-primary to-accent">
        <h2 class="text-2xl font-bold">Update Penonton</h2>
        <p class="text-sm opacity-90">Perbarui informasi Penonton</p>
    </div>
    <div class="p-6">
        <form action="{{ route('penonton.update', $penonton->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Hidden fields for non-editable data -->
            <input type="hidden" name="nama_lengkap" value="{{ $penonton->nama_lengkap }}">
            <input type="hidden" name="asal_sekolah" value="{{ $penonton->asal_sekolah }}">
            <input type="hidden" name="id_lomba" value="{{ $penonton->id_lomba }}">
            <input type="hidden" name="id_acara" value="{{ $penonton->id_acara }}">
            <input type="hidden" name="no_hp" value="{{ $penonton->no_hp }}">
            <input type="hidden" name="biaya_tiket" value="{{ $penonton->biaya_tiket }}">

            <!-- Display only fields -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <p class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">{{ $penonton->nama_lengkap }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                <p class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">{{ $penonton->asal_sekolah }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Lomba</label>
                <p class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">{{ $penonton->lomba ? $penonton->lomba->nama_lomba : 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Acara</label>
                <p class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">{{ $penonton->acara ? $penonton->acara->nama_acara : 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <p class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">{{ $penonton->no_hp }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Biaya Tiket</label>
                <p class="block w-full p-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">Rp {{ number_format($penonton->biaya_tiket, 0, ',', '.') }}</p>
            </div>
            <div>
                <label for="status_pembayaran" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    <option value="pending" {{ old('status_pembayaran', $penonton->status_pembayaran) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="lunas" {{ old('status_pembayaran', $penonton->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="batal" {{ old('status_pembayaran', $penonton->status_pembayaran) == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            @if($penonton->image)
            <div>
                <label class="block text-sm font-medium text-gray-700">Current Bukti Pembayaran</label>
                <div class="mt-1">
                    <img src="{{ Storage::url($penonton->image) }}" alt="Bukti Pembayaran" class="max-w-xs h-auto border border-gray-300 rounded-md cursor-pointer" onclick="openImageModal('{{ Storage::url($penonton->image) }}')">
                </div>
            </div>
            @endif
            <div class="flex justify-end space-x-4">
                <a href="{{ route('penonton.index') }}" class="px-4 py-2 font-medium text-white transition-colors duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 font-medium text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary/90">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-medium text-gray-900">Bukti Pembayaran</h3>
            <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="mt-3">
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto">
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>
@endsection

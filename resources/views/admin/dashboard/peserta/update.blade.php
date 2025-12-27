@extends('admin.dashboard.layouts.main')
@section('section')

<div class="overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="px-6 py-4 text-white bg-gradient-to-r from-primary to-accent">
        <h2 class="text-2xl font-bold">Update Peserta</h2>
        <p class="text-sm opacity-90">Perbarui informasi Peserta</p>
    </div>
    <div class="p-6">
        <form action="{{ route('peserta.update', $peserta->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Editable fields -->
            <div>
                <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700">Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" id="penanggung_jawab" value="{{ old('penanggung_jawab', $peserta->penanggung_jawab) }}" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="nama_sekolah" class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah', $peserta->nama_sekolah) }}" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="id_lomba" class="block text-sm font-medium text-gray-700">Lomba</label>
                <select name="id_lomba" id="id_lomba" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    <option value="">Pilih Lomba</option>
                    @foreach($lombas as $lomba)
                        <option value="{{ $lomba->id }}" {{ old('id_lomba', $peserta->id_lomba) == $lomba->id ? 'selected' : '' }}>{{ $lomba->nama_lomba }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="id_grade" class="block text-sm font-medium text-gray-700">Grade</label>
                <select name="id_grade" id="id_grade" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    <option value="">Pilih Grade</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ old('id_grade', $peserta->id_grade) == $grade->id ? 'selected' : '' }}>{{ $grade->tingkat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $peserta->no_hp) }}" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="status_pembayaran" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    <option value="pending" {{ old('status_pembayaran', $peserta->status_pembayaran) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="lunas" {{ old('status_pembayaran', $peserta->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="batal" {{ old('status_pembayaran', $peserta->status_pembayaran) == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            @if($peserta->image)
            <div>
                <label class="block text-sm font-medium text-gray-700">Current Bukti Pembayaran</label>
                <div class="mt-1">
                    <img src="{{ Storage::url($peserta->image) }}" alt="Bukti Pembayaran" class="max-w-xs h-auto border border-gray-300 rounded-md cursor-pointer" onclick="openImageModal('{{ Storage::url($peserta->image) }}')">
                </div>
            </div>
            @endif
            <div class="flex justify-end space-x-4">
                <a href="{{ route('peserta.index') }}" class="px-4 py-2 font-medium text-white transition-colors duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
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

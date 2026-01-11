<!-- Acara Modal (Create) -->
<div id="acara-modal" class="fixed inset-0 bg-black/50 z-50 p-4 hidden grid place-items-center">
    <div class="bg-white rounded-lg border border-border shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-border flex items-center justify-between sticky top-0 bg-white">
            <h2 class="text-xl font-semibold text-foreground">Tambah Acara Baru</h2>
            <button id="close-acara-modal" class="text-muted-foreground hover:text-foreground transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form class="p-6 space-y-4 bg-white " method="post" action="{{ route('acara.store') }}"
            enctype="multipart/form-data">
            @csrf

            <!--Input for Lomba ID -->
            <label for="id_lomba" class="block text-sm font-medium text-foreground mb-2">nama Lomba *</label>
            <select id="id_lomba" name="id_lomba"
                class="form-control @error('id_lomba') is-invalid @enderror w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                required>
                <option value="">Select a campetion</option>
                @foreach ($lombas as $lomba)
                    <option value="{{ $lomba->id }}">{{ $lomba->nama_lomba }}</option>
                @endforeach
            </select>
            
            <!-- Nama Acara -->
            <div>
                <label for="nama_acara" class="block text-sm font-medium text-foreground mb-2">Nama Acara *</label>
                <input type="text" id="nama_acara" name="nama_acara" required maxlength="255"
                    class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                <p class="text-sm text-red-500 hidden mt-1" id="nama_acara-error"></p>
            </div>

            <!-- Tanggal Acara -->
            <div>
                <label for="tanggal_acara" class="block text-sm font-medium text-foreground mb-2">Tanggal Acara
                    *</label>
                <input type="date" id="tanggal_acara" name="tanggal_acara" required
                    class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                <p class="text-sm text-red-500 hidden mt-1" id="tanggal_acara-error"></p>
            </div>

            <!-- Lokasi Acara -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-foreground mb-2">Keterangan *</label>
                <input type="text" id="keterangan" name="keterangan" required maxlength="255"
                    class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                @error('keterangan')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Biaya Acara -->
            <div>
                <label for="biaya" class="block text-sm font-medium text-foreground mb-2">Biaya *</label>
                <input type="number" id="biaya" name="biaya" required min="0"
                    class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                @error('biaya')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Status Acara -->
            <div>
                <label for="status_acara" class="block text-sm font-medium text-foreground mb-2">Status Acara *</label>
                <select id="status_acara" name="status_acara"
                    class="form-control @error('status_acara') is-invalid @enderror w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                    required>
                    <option value="">Select a status</option>
                    <option value="scheduled">Schedule</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="finished">Finished</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="flex-1 gradient-hero text-white font-semibold py-3 px-6 rounded-md hover:opacity-90 transition-opacity">
                    Save
                </button>
                <button type="button" id="cancel-acara"
                    class="px-6 py-3 border border-border rounded-md text-foreground hover:bg-muted/20 transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

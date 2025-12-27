<!-- Acara Modal (Create) -->
<div id="lomba-modal" class="fixed inset-0 z-50 grid hidden p-4 bg-black/50 place-items-center">
    <div class="bg-white rounded-lg border border-border shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 flex items-center justify-between px-6 py-4 bg-white border-b border-border">
            <h2 class="text-xl font-semibold text-foreground">Tambah Lomba Baru</h2>
            <button id="close-lomba-modal" class="transition-colors text-muted-foreground hover:text-foreground">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form class="p-6 space-y-4 bg-white " method="post" action="{{ route('lomba.store') }}"
            enctype="multipart/form-data">
            @csrf
            
            <!-- Nama Acara -->
            <div>
                <label for="nama_lomba" class="block mb-2 text-sm font-medium text-foreground">Nama Lomba *</label>
                <input type="text" id="nama_lomba" name="nama_lomba" required maxlength="255"
                    class="w-full px-4 py-3 border rounded-md bg-background border-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                <p class="hidden mt-1 text-sm text-red-500" id="nama_lomba-error"></p>
            </div>

            <!-- Deskripsi Lomba -->
            <div>
                <label for="deskripsi_lomba" class="block mb-2 text-sm font-medium text-foreground">Deskripsi Lomba *</label>
                <input id="deskripsi_lomba" type="hidden" name="deskripsi_lomba" value="{{ old('deskripsi_lomba') }}">
                <trix-editor input="deskripsi_lomba" class="trix-content"></trix-editor>
                @error('deskripsi_lomba')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grade -->
            <div>
                <label for="id_grade" class="block mb-2 text-sm font-medium text-foreground">Grade *</label>
                <select id="id_grade" name="id_grade" required
                    class="w-full px-4 py-3 border rounded-md bg-background border-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                    <option value="">Pilih Grade</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->tingkat }}</option>
                    @endforeach
                </select>
                @error('id_grade')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Biaya Pendaftaran -->
            <div>
                <label for="biaya_daftar" class="block mb-2 text-sm font-medium text-foreground">Biaya Pendaftaran *</label>
                <input type="text" id="biaya_daftar" name="biaya_daftar" required maxlength="255"
                    class="w-full px-4 py-3 border rounded-md bg-background border-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                @error('biaya_daftar')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="flex-1 px-6 py-3 font-semibold text-white transition-opacity rounded-md gradient-hero hover:opacity-90">
                    Save
                </button>
                <button type="button" id="cancel-lomba"
                    class="px-6 py-3 transition-colors border rounded-md border-border text-foreground hover:bg-muted/20">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Trix Editor Custom Styling */
    trix-editor {
        border: 1px solid hsl(214, 32%, 91%);
        border-radius: 0.375rem;
        padding: 0.75rem 1rem;
        min-height: 150px;
        background-color: hsl(210, 100%, 97%);
    }
    
    trix-editor:focus {
        outline: none;
        border-color: hsl(217, 91%, 60%);
        box-shadow: 0 0 0 2px hsl(217, 91%, 60%, 0.2);
    }
    
    trix-toolbar .trix-button-group {
        background-color: white;
        border: 1px solid hsl(214, 32%, 91%);
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
    }
</style>

<script>
    // Initialize Trix editor
    document.addEventListener('DOMContentLoaded', function() {
        const trixEditor = document.querySelector('trix-editor[input="deskripsi_lomba"]');
        
        if (trixEditor) {
            // Handle content changes
            trixEditor.addEventListener('trix-change', function(event) {
                console.log('Trix content changed');
            });
            
            // Optional: Disable file attachments if not needed
            trixEditor.addEventListener('trix-file-accept', function(event) {
                event.preventDefault();
                alert('File attachments are not supported');
            });
        }
    });
</script>

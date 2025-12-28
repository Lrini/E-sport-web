<!-- Admin Modal (Create) -->
<div id="acara-modal" class="fixed inset-0 bg-black/50 z-50 p-4 hidden grid place-items-center">
    <div class="bg-white rounded-lg border border-border shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-border flex items-center justify-between sticky top-0 bg-white">
            <h2 class="text-xl font-semibold text-foreground">Tambah Admin Baru</h2>
            <button id="close-acara-modal" class="text-muted-foreground hover:text-foreground transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form class="p-6 space-y-4 bg-white " method="post" action="{{ route('admin.store') }}"
            enctype="multipart/form-data">
            @csrf
            
            <!-- Nama Acara -->
            <div>
                <label for="name" class="block text-sm font-medium text-foreground mb-2">Nama*</label>
                <input type="text" id="name" name="name" required maxlength="255"
                    class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                <p class="text-sm text-red-500 hidden mt-1" id="name-error"></p>
            </div>
            <!-- Email Acara -->
            <div>
                <label for="email" class="block text-sm font-medium text-foreground mb-2">Email*</label>
                <input type="email" id="email" name="email" required maxlength="255"
                    class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                <p class="text-sm text-red-500 hidden mt-1" id="email-error"></p>
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

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Total Participants Card -->
    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-muted-foreground text-sm font-medium">Total Peserta Lomba</p>
                <?php
                use App\Models\peserta as Participant;
                $totalParticipants = Participant::where('status_pembayaran', 'lunas')->count();
                ?>
                <p class="text-3xl font-bold text-primary mt-2" id="total-participants">{{ $totalParticipants }}</p>
            </div>
            <div class="p-3 bg-primary/10 rounded-full">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Spectators Card -->
    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-muted-foreground text-sm font-medium">Total Penonton Lomba</p>
                <?php
                use App\Models\penonton as Spectator;
                $totalSpectators = Spectator::where('status_pembayaran', 'lunas')->count();
                ?>
                <p class="text-3xl font-bold text-secondary mt-2" id="total-spectators">{{ $totalSpectators }}</p>
            </div>
            <div class="p-3 bg-secondary/10 rounded-full">
                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Registrations Card -->
    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-muted-foreground text-sm font-medium">Total Registrasi Peserta</p>
                <?php
                    $totalRegistrations = Participant::where('status_pembayaran', 'pending')->count();
                ?>
                <p class="text-3xl font-bold text-accent mt-2" id="total-registrations">{{$totalRegistrations}}</p>
            </div>
            <div class="p-3 bg-accent/10 rounded-full">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Registrations Card -->
    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-muted-foreground text-sm font-medium">Total Registrasi Penonton</p>
                <?php
                    $totalRegistrations1 = Spectator::where('status_pembayaran', 'pending')->count();
                ?>
                <p class="text-3xl font-bold text-accent mt-2" id="total-registrations">{{$totalRegistrations1}}</p>
            </div>
            <div class="p-3 bg-accent/10 rounded-full">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Registrations Card -->
    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-muted-foreground text-sm font-medium">Total Pemasukan pendaftaran peserta</p>
                <?php
                    $totaldanaregis = Participant::join('lombas', 'pesertas.id_lomba', '=', 'lombas.id')->where('pesertas.status_pembayaran', 'lunas')->sum('lombas.biaya_daftar');
                ?>
                <p class="text-3xl font-bold text-accent mt-2" id="total-registrations">{{$totaldanaregis}}</p>
            </div>
            <div class="p-3 bg-accent/10 rounded-full">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Registrations Card -->
    <div class="gradient-card rounded-lg border border-border p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-muted-foreground text-sm font-medium">Total Pemasukan Tiket Penonton</p>
                <?php
                    $totaldanaregis = Spectator::where('status_pembayaran', 'lunas')->sum('biaya_tiket');
                ?>
                <p class="text-3xl font-bold text-accent mt-2" id="total-registrations">{{$totaldanaregis}}</p>
            </div>
            <div class="p-3 bg-accent/10 rounded-full">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>


</div>

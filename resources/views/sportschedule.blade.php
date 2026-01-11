@extends('layouts.main')
@section('section')
    <!-- Main Content -->
    <div class="pt-20 pb-12 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <br>
            <div class="text-center mt-40 mb-10">
                <h1 class="text-4xl font-bold text-[hsl(222,47%,11%)] mb-2">{{ isset($selectedLomba) ? $selectedLomba->nama_lomba . ' Schedule' : '📅 Sports Schedule' }}</h1>
               <p class="text-[hsl(215,16%,47%)]">{{ isset($selectedLomba) ? 'Event schedule for ' . $selectedLomba->nama_lomba : 'Complete event schedule for Sports Competition 2026' }}</p>
            </div>
            <br>
            <!-- Info Box -->
            <div class="bg-white border-l-4 border-[hsl(217,91%,60%)] rounded-r-xl shadow-md p-6 mb-12 flex items-start gap-4">
                <div class="text-[hsl(217,91%,60%)] mt-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-[hsl(222,47%,11%)] mb-2 text-lg">Important Information</h3>
                    <ul class="text-[hsl(215,16%,47%)] space-y-1 text-sm list-disc list-inside">
                        <li>All times are subject to change</li>
                        <li>Please arrive 30 minutes before each event</li>
                        <li>Spectators must register at the entrance</li>
                        <li>Food and drinks are available at the venue</li>
                    </ul>
                </div>
            </div>
            <br>

            @forelse ($acarasByDateAndLomba ?? [] as $date => $eventsByLomba)
                <div class="mb-12 animate-fade-in">
                    <!-- Date Header -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="px-6 py-2 text-white rounded-full gradient-hero shadow-lg transform -rotate-1">
                            <span class="font-bold text-lg">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="h-px bg-gray-200 flex-grow rounded-full"></div>
                    </div>

                    <div class="grid gap-4">
                        @forelse ($eventsByLomba as $idLomba => $events)
                            @foreach ($events as $acara)
                                <div class="group relative bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-[hsl(217,91%,60%)]">
                                    <div class="flex flex-col md:flex-row md:items-center gap-6">

                                        <!-- Content -->
                                        <div class="flex-grow border-l-0 md:border-l-2 border-gray-100 md:pl-6">
                                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                                <br>
                                                @php
                                                    $status = trim(strtolower($acara->status_acara ?? '')) ?: 'scheduled';
                                                    $statusClasses = match($status) {
                                                        'ongoing' => 'bg-red-100 text-red-500 border-red-200',
                                                        'finished' => 'bg-green-100 text-green-700 border-green-200',
                                                        'scheduled' => 'bg-blue-100 text-blue-500 border-blue-200',
                                                        default => 'bg-gray-100 text-gray-600 border-gray-200'
                                                    };
                                                @endphp
                                                <span class="px-3 py-1 text-xs font-bold rounded-full border {{ $statusClasses }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </div>
                                            
                                            <h3 class="text-xl font-bold text-[hsl(222,47%,11%)] mb-2 group-hover:text-[hsl(217,91%,60%)] transition-colors">
                                                {{ $acara->nama_acara }}
                                            </h3>
                                            <p class="text-[hsl(215,16%,47%)] text-sm leading-relaxed">
                                                {{ $acara->keterangan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <!-- No events -->
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[hsl(222,47%,11%)] mb-2">No Scheduled Events</h3>
                    <p class="text-[hsl(215,16%,47%)]">Check back later for upcoming competitions.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

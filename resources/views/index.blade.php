@extends('layouts.main')

   @section('section')
        <!-- Hero Banner -->
        <section class="py-32 text-white gradient-hero animate-fade-in">
            <div class="container px-4 mx-auto text-center">
                <h2 class="mb-6 text-5xl font-bold md:text-6xl animate-scale-in">
                    School Sports Competition 2026
                </h2>
                <p class="max-w-3xl mx-auto mb-8 text-xl md:text-2xl animate-slide-up">
                    Join us for an exciting showcase of athletic talent! <br> Register now as an athlete or support
                </p>
                
                <!-- Call-to-Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row animate-slide-up">
                    <a href="/participant" class="px-8 py-4 bg-white text-[hsl(217,91%,60%)] rounded-lg font-semibold text-lg hover:scale-105 transition-transform shadow-lg">
                        Register as Athlete
                    </a>
                    <a href="/spectator" class="px-8 py-4 bg-white text-[hsl(217,91%,60%)] rounded-lg font-semibold text-lg hover:scale-105 transition-transform shadow-lg">
                        Register as Support
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Event Information Cards -->
        <section class="container px-4 py-16 mx-auto">
            <div class="grid gap-8 -mt-24 md:grid-cols-3">
                <!-- Date Card -->
                <div class="p-8 bg-white shadow-xl rounded-xl animate-fade-in" style="animation-delay: 0.1s">
                    <div class="w-16 h-16 rounded-full bg-[hsl(217,91%,60%,0.1)] flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[hsl(217,91%,60%)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-[hsl(222,47%,11%)]">Event Dates</h3>
                    <p class="text-[hsl(215,16%,47%)]">March 15-17, 2026</p>
                </div>
                
                <!-- Venue Card -->
                <div class="p-8 bg-white shadow-xl rounded-xl animate-fade-in" style="animation-delay: 0.2s">
                    <div class="w-16 h-16 rounded-full bg-[hsl(27,96%,61%,0.1)] flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[hsl(27,96%,61%)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-[hsl(222,47%,11%)]">Venue</h3>
                    <p class="text-[hsl(215,16%,47%)]">School Sports Complex</p>
                </div>
                
                <!-- Categories Card -->
                <div class="p-8 bg-white shadow-xl rounded-xl animate-fade-in" style="animation-delay: 0.3s">
                    <div class="w-16 h-16 rounded-full bg-[hsl(142,76%,36%,0.1)] flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[hsl(142,76%,36%)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-[hsl(222,47%,11%)]">Categories</h3>
                    <p class="text-[hsl(215,16%,47%)]">All grades welcome</p>
                </div>
            </div>
        </section>
        
        <!-- Available Sports Section -->
        <section class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 text-[hsl(222,47%,11%)]">Available Competion</h2>
            
            <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-5">
                <!-- Futsal -->
                <div class="p-6 text-center transition-transform cursor-pointer gradient-card rounded-xl hover:scale-105">
                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white rounded-full">
                        <svg class="w-10 h-10 text-[hsl(217,91%,60%)]" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 2 L14 8 L20 8 L15 12 L17 18 L12 14 L7 18 L9 12 L4 8 L10 8 Z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-[hsl(222,47%,11%)]">Futsal</h3>
                </div>
                
                <!-- Basketball -->
                <div class="p-6 text-center transition-transform cursor-pointer gradient-card rounded-xl hover:scale-105">
                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white rounded-full">
                        <svg class="w-10 h-10 text-[hsl(27,96%,61%)]" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                            <path d="M2 12 Q12 2 22 12" fill="none" stroke="currentColor" stroke-width="1"/>
                            <path d="M2 12 Q12 22 22 12" fill="none" stroke="currentColor" stroke-width="1"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-[hsl(222,47%,11%)]">Basketball</h3>
                </div>
                
                <!-- Volleyball -->
                <div class="p-6 text-center transition-transform cursor-pointer gradient-card rounded-xl hover:scale-105">
                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white rounded-full">
                        <svg class="w-10 h-10 text-[hsl(142,76%,36%)]" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                            <line x1="12" y1="2" x2="12" y2="22" stroke="currentColor" stroke-width="1"/>
                            <line x1="2" y1="12" x2="22" y2="12" stroke="currentColor" stroke-width="1"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-[hsl(222,47%,11%)]">Volleyball</h3>
                </div>
                
                <!-- Athletics -->
                <div class="p-6 text-center transition-transform cursor-pointer gradient-card rounded-xl hover:scale-105">
                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white rounded-full">
                        <svg class="w-10 h-10 text-[hsl(217,91%,60%)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-[hsl(222,47%,11%)]">Athletics</h3>
                </div>
                
                <!-- Badminton -->
                <div class="p-6 text-center transition-transform cursor-pointer gradient-card rounded-xl hover:scale-105">
                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white rounded-full">
                        <svg class="w-10 h-10 text-[hsl(27,96%,61%)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="3" stroke-width="2"/>
                            <line x1="12" y1="11" x2="12" y2="21" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-[hsl(222,47%,11%)]">Badminton</h3>
                </div>
            </div>
        </section>
        
        <!-- Call to Action -->
        <section class="container px-4 py-16 mx-auto">
            <div class="p-12 text-center text-white gradient-hero rounded-2xl">
                <h2 class="mb-4 text-3xl font-bold md:text-4xl">Ready to Join?</h2>
                <p class="max-w-2xl mx-auto mb-8 text-lg">
                    Don't miss out on this exciting event! Register now as an athlete or secure your spot as a spectator.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="/participant" class="px-8 py-4 bg-white text-[hsl(217,91%,60%)] rounded-lg font-semibold hover:scale-105 transition-transform">
                        Athlete Registration
                    </a>
                    <a href="/spectator" class="px-8 py-4  bg-white text-[hsl(217,91%,60%)] rounded-lg font-semibold hover:scale-105 transition-transform border-2 border-white">
                        Support Registration
                    </a>
                </div>
            </div>
        </section>
    @endsection
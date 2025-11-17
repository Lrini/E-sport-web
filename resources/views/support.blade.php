@extends('layouts.main')
@section('section')
<div class="container max-w-4xl px-4 mx-auto">
     <!-- Page Header -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold mb-4 text-[hsl(222,47%,11%)]">Spectator Registration</h2>
                <p class="text-lg text-[hsl(215,16%,47%)]">
                    Come and support our athletes at the Sports Competition 2025
                </p>
            </div>
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
                <form id="spectator-form" novalidate>
                    
                    <!-- Full Name Field -->
                    <div class="mb-6">
                        <label for="fullName" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Full Name *
                        </label>
                        <input 
                            type="text" 
                            id="fullName" 
                            name="fullName"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(27,96%,61%)] transition-colors"
                            placeholder="Enter your full name"
                            required
                        >
                        <div class="hidden error-message" id="fullName-error"></div>
                    </div>
                    
                    <!-- Grade/Role Field -->
                    <div class="mb-6">
                        <label for="grade" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Grade/Class or Role *
                        </label>
                        <input 
                            type="text" 
                            id="grade" 
                            name="grade"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(27,96%,61%)] transition-colors"
                            placeholder="e.g., Grade 10, Parent, Teacher"
                            required
                        >
                        <div class="hidden error-message" id="grade-error"></div>
                    </div>
                    
                    <!-- Contact Number Field -->
                    <div class="mb-6">
                        <label for="contactNumber" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Contact Number *
                        </label>
                        <input 
                            type="tel" 
                            id="contactNumber" 
                            name="contactNumber"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(27,96%,61%)] transition-colors"
                            placeholder="Enter your contact number"
                            required
                        >
                        <div class="hidden error-message" id="contactNumber-error"></div>
                    </div>
                    
                    <!-- Viewing Date Field -->
                    <div class="mb-8">
                        <label for="viewingDate" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Preferred Viewing Date *
                        </label>
                        <select 
                            id="viewingDate" 
                            name="viewingDate"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(27,96%,61%)] transition-colors"
                            required>
                            <option value="">Select a date</option>
                            <option value="2025-03-15">March 15, 2025 (Day 1)</option>
                            <option value="2025-03-16">March 16, 2025 (Day 2)</option>
                            <option value="2025-03-17">March 17, 2025 (Day 3)</option>
                            <option value="all">All Days</option>
                        </select>
                        <div class="hidden error-message" id="viewingDate-error"></div>
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
</div>
@endsection
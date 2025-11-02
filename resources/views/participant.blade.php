@extends('layouts.main')
@section('section')

<div class="container mx-auto px-4 max-w-4xl">
            
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-[hsl(222,47%,11%)]">Athlete Registration</h2>
                <p class="text-lg text-[hsl(215,16%,47%)]">
                    Register to compete in the Sports Competition 2026
                </p>
            </div>
            
            <!-- Registration Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                 <!-- Important Information Section -->
                <div class="mt-8 mb-4 p-6 bg-[hsl(210,40%,96%)] rounded-lg">
                    <h3 class="font-semibold text-[hsl(222,47%,11%)] mb-3">Important Information</h3>
                    <ul class="space-y-2 text-sm text-[hsl(215,16%,47%)]">
                        <li>• All participants must have valid student ID cards</li>
                        <li>• Parent/guardian consent is mandatory for participants under 18</li>
                        <li>• Medical certificates may be required for certain sports</li>
                        <li>• Registration closes on March 10, 2025</li>
                        <li>• You will receive a confirmation email after successful registration</li>
                    </ul>
                </div>
                <form id="participant-form" novalidate>
                    
                    <!-- Full Name Field -->
                    <div class="mb-6">
                        <label for="fullName" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Full Name *
                        </label>
                        <input 
                            type="text" 
                            id="fullName" 
                            name="fullName"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            placeholder="Enter your full name"
                            required
                        >
                        <div class="error-message hidden" id="fullName-error"></div>
                    </div>
                    
                    <!-- Grade/Class Field -->
                    <div class="mb-6">
                        <label for="grade" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Grade/Class *
                        </label>
                        <input 
                            type="text" 
                            id="grade" 
                            name="grade"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            placeholder="e.g., Grade 10, Class A"
                            required
                        >
                        <div class="error-message hidden" id="grade-error"></div>
                    </div>
                    
                    <!-- Sport Selection Field -->
                    <div class="mb-6">
                        <label for="sport" class="block text-sm font-medium text-[hsl(222,47%,11%)] mb-2">
                            Sport *
                        </label>
                        <select 
                            id="sport" 
                            name="sport"
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            required
                        >
                            <option value="">Select a sport</option>
                            <option value="futsal">Futsal</option>
                            <option value="basketball">Basketball</option>
                            <option value="volleyball">Volleyball</option>
                            <option value="athletics">Athletics</option>
                            <option value="badminton">Badminton</option>
                        </select>
                        <div class="error-message hidden" id="sport-error"></div>
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
                            class="w-full px-4 py-3 border-2 border-[hsl(214,32%,91%)] rounded-lg focus:outline-none focus:border-[hsl(217,91%,60%)] transition-colors"
                            placeholder="Enter your contact number"
                            required
                        >
                        <div class="error-message hidden" id="contactNumber-error"></div>
                    </div>
                    
                    <!-- Parent Consent Checkbox -->
                    <div class="mb-8">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input 
                                type="checkbox" 
                                id="parentConsent" 
                                name="parentConsent"
                                class="mt-1 w-5 h-5 border-2 border-[hsl(214,32%,91%)] rounded focus:ring-2 focus:ring-[hsl(217,91%,60%)] text-[hsl(217,91%,60%)]"
                                required
                            >
                            <span class="text-sm text-[hsl(222,47%,11%)]">
                                I confirm that I have obtained parent/guardian consent to participate in this event *
                            </span>
                        </label>
                        <div class="error-message hidden ml-8" id="parentConsent-error"></div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        id="submit-btn"
                        class="w-full bg-[hsl(217,91%,60%)] text-white py-4 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Register as Athlete
                    </button>
                </form>
            </div>
        </div>
@endsection
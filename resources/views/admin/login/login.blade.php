@extends('admin.login.layout.main')
@section('section')
<div class="w-full max-w-md">
      
      <!-- Login Card -->
      <div class="gradient-card rounded-lg border border-border shadow-2xl p-8 animate-slide-up">
        
        <!-- Header -->
        <div class="text-center mb-8">
          <div class="inline-block p-3 rounded-full bg-primary/10 mb-4">
            <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
          </div>
          <h1 class="text-3xl font-bold text-foreground mb-2">Admin Login</h1>
          <p class="text-foreground/60">Access the registration dashboard</p>
        </div>
        
        <!-- Login Form -->
        <form method="post" action="/admin/login" enctype="multipart/form-data">
          @csrf
          <!-- Username Field -->
          <div class="space-y-2 mb-4">
            <label for="email" class="block text-sm font-medium text-foreground">
              Email
            </label>
            <input 
              type="text" 
              id="email" 
              name="email"
              class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground placeholder:text-foreground/40 focus:outline-none focus:ring-2 focus:ring-ring transition-all"
              placeholder="Enter your email"
              required
            >
          </div>
          
          <!-- Password Field -->
          <div class="space-y-2 mb-4">
            <label for="password" class="block text-sm font-medium text-foreground">
              Password
            </label>
            <input 
              type="password" 
              id="password" 
              name="password"
              class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground placeholder:text-foreground/40 focus:outline-none focus:ring-2 focus:ring-ring transition-all"
              placeholder="Enter your password"
              required
            >
          </div>
          
          <!-- Submit Button -->
          <button 
            type="submit" 
            class="w-full gradient-hero text-white font-semibold py-3 px-6 rounded-md hover:opacity-90 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 focus:ring-offset-background"
          >
            Login
          </button>
          
        </form>
        
        <!-- Back to Home Link -->
        <div class="mt-6 text-center">
          <a href="/" class="text-sm text-primary hover:text-primary/80 transition-colors">
            ← Back to Home
          </a>
        </div>
        
      </div>
    </div>
@endsection
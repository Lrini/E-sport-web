<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login e-sport</title>
  <meta name="description" content="Admin login portal for Intramurals 2025 registration management">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Tailwind Configuration -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: 'hsl(262, 83%, 58%)',
              foreground: 'hsl(0, 0%, 100%)',
            },
            secondary: {
              DEFAULT: 'hsl(335, 78%, 42%)',
              foreground: 'hsl(0, 0%, 100%)',
            },
            accent: {
              DEFAULT: 'hsl(47, 96%, 53%)',
              foreground: 'hsl(0, 0%, 0%)',
            },
            background: 'hsl(240, 5%, 6%)',
            foreground: 'hsl(0, 0%, 95%)',
            card: 'hsl(240, 4%, 9%)',
            'card-foreground': 'hsl(0, 0%, 95%)',
            border: 'hsl(240, 4%, 16%)',
            input: 'hsl(240, 4%, 16%)',
            ring: 'hsl(262, 83%, 58%)',
          },
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out',
            'slide-up': 'slideUp 0.8s ease-out',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideUp: {
              '0%': { transform: 'translateY(30px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-20px)' },
            },
          },
        },
      },
    }
  </script>
  
  <style>
    /* Custom gradient backgrounds */
    .gradient-hero {
      background: linear-gradient(135deg, hsl(262, 83%, 58%) 0%, hsl(335, 78%, 42%) 100%);
    }
    
    .gradient-card {
      background: linear-gradient(180deg, hsl(240, 4%, 9%) 0%, hsl(240, 5%, 6%) 100%);
    }
  </style>
</head>
<body class="bg-background text-foreground min-h-screen">
  
  <!-- Toast Container -->
  <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
  
  <!-- Main Content -->
  <main class="min-h-screen flex items-center justify-center px-4 py-12">
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
<form id="admin-login-form" class="space-y-6" method="POST" action="{{ route('admin.login.submit') }}">
          @csrf
          
          <!-- Username Field -->
          <div class="space-y-2">
            <label for="username" class="block text-sm font-medium text-foreground">
              Username
            </label>
            <input 
              type="text" 
              id="username" 
              name="username"
              value="{{ old('username') }}"
              class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground placeholder:text-foreground/40 focus:outline-none focus:ring-2 focus:ring-ring transition-all @error('username') border-red-500 @enderror"
              placeholder="Enter your username"
              required
            >
            @error('username')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <!-- Password Field -->
          <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-foreground">
              Password
            </label>
            <input 
              type="password" 
              id="password" 
              name="password"
              class="w-full px-4 py-3 bg-background border border-input rounded-md text-foreground placeholder:text-foreground/40 focus:outline-none focus:ring-2 focus:ring-ring transition-all @error('password') border-red-500 @enderror"
              placeholder="Enter your password"
              required
            >
            @error('password')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
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
  </main>
  
  <!-- JavaScript -->
  <script src="js/app.js"></script>
  <script src="js/admin-auth.js"></script>
  
</body>
</html>
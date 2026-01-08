<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - e_sport</title>
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
              DEFAULT: 'hsl(217, 91%, 60%)',
              foreground: 'hsl(0, 0%, 100%)',
            },
            secondary: {
              DEFAULT: 'hsl(27, 96%, 61%)',
              foreground: 'hsl(0, 0%, 100%)',
            },
            accent: {
              DEFAULT: 'hsl(142, 76%, 36%)',
              foreground: 'hsl(0, 0%, 100%)',
            },
            background: 'hsl(210, 100%, 97%)',
            foreground: 'hsl(222, 47%, 11%)',
            muted: {
              DEFAULT: 'hsl(210, 40%, 96%)',
              foreground: 'hsl(215, 16%, 47%)',
            },
            card: 'hsl(0, 0%, 100%)',
            'card-foreground': 'hsl(222, 47%, 11%)',
            border: 'hsl(214, 32%, 91%)',
            input: 'hsl(214, 32%, 91%)',
            ring: 'hsl(217, 91%, 60%)',
          },
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out',
            'slide-up': 'slideUp 0.8s ease-out',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(20px)'},
              '100%': { opacity: '1', transform: 'translateY(0)' },
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
      background: linear-gradient(135deg, hsl(217, 91%, 60%) 0%, hsl(142, 76%, 36%) 100%);
    }
    
    .gradient-card {
      background: linear-gradient(135deg, hsl(217, 91%, 60%, 0.05) 0%, hsl(27, 96%, 61%, 0.05) 100%);
    }
  </style>
</head>
<body class="bg-background text-foreground min-h-screen">
  
  <!-- Toast Container -->
  <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
  
  <!-- Main Content -->
  <main class="min-h-screen flex items-center justify-center px-4 py-12">
    @yield('section')
  </main>
  
  <!-- JavaScript -->
  <script src="/js/app.js"></script>
</body>
</html>
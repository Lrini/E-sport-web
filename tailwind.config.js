/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'bg-green-100',
    'border',
    'border-green-400',
    'text-green-700',
    'px-4',
    'py-3',
    'rounded-lg',
    'mb-6',
    'relative',
    'absolute',
    'top-0',
    'bottom-0',
    'right-0',
    'hover:text-green-900',
  ],
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
      },
      keyframes: {
        'fade-in': {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' }
        },
        'slide-up': {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' }
        },
        'scale-in': {
          '0%': { opacity: '0', transform: 'scale(0.95)' },
          '100%': { opacity: '1', transform: 'scale(1)' }
        }
      },
      animation: {
        'fade-in': 'fade-in 0.6s ease-out',
        'slide-up': 'slide-up 0.6s ease-out',
        'scale-in': 'scale-in 0.4s ease-out',
      }
    },
  },
  plugins: [],
}


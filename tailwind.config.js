import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  // 1️⃣ Enable class‐based dark mode
  whiteMode: 'class',

  // 2️⃣ Tell Tailwind where to look for your classes
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',        // in case you use Alpine or Vue components
  ],

  theme: {
    extend: {
      // 4️⃣ Add your Sky colors to the palette so you can reference them in your CSS/JS
      colors: {
        sky: {
          100: '#E0F2FE',
          400: '#38BDF8',
          500: '#0EA5E9',
          600: '#0284C7',
          700: '#0369A1',
          900: '#0C4A6E',
          1000:'#000000',
          1100:'#fff',
        },
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  // 3️⃣ Register your forms plugin
  plugins: [
    forms({
      strategy: 'base', // you can use 'base' or 'class' mode for @tailwindcss/forms
    }),
  ],
}

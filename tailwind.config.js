/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.{php, html, js}",
    "./public/**/*.{php, html, js}"
  ],
  theme: {
    extend: {
      backgroundImage: {
        'hero-img': "url('/img/hero1.jpg')",
      },
      colors: {
        primary: '#0ea5e9',
        secondary: '#075985'
      },
      keyframes: {
        appear: {
          '0%': {opacity: 0},
          '100%': {opacity: 1}
        }
      },
      animation: {
        appear: 'appear 200ms ease-in-out'
      }
    },
  },
  plugins: [],
}


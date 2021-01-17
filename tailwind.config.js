module.exports = {
  purge: [
      './resources/views/**/*.blade.php',
      './resources/css/**/*.css',
      './resources/js/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            'bg-semi-75': 'rgba(0, 0, 0, 0.75)'
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/ui'),
      require('@tailwindcss/custom-forms'),
  ],
}

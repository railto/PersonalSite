module.exports = {
  purge: [
      './resources/views/**/*.blade.php',
      './resources/css/**/*.css',
      './resources/js/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/ui'),
      require('@tailwindcss/custom-forms'),
  ],
}

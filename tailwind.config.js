/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{html,css,js,php}"],
  darkMode: "class",
  theme: {
    extend: {
      fontFamily: {
        nunito: ["nunito", "san-serif"],
      },
    },
  },
  plugins: [],
};

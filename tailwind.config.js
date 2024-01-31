/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './views/**/*.{html,js,php,twig}', // Scan for HTML, JS, PHP, and Twig files in the views directory
    // './*.php', // Scan all PHP files in the root directory
    // Add other paths as needed
  ],
  theme: {
    extend: {},
  },
  plugins: [

  ],
}


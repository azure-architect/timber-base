import Alpine from 'alpinejs'
import Swup from 'swup';

// Set Alpine globally
window.Alpine = Alpine

// Initialize Swup
const swup = new Swup();

// Start Alpine
Alpine.start()

// Reinitialize Alpine whenever Swup replaces content
document.addEventListener('swup:contentReplaced', () => {
    Alpine.start(); // This is needed to re-boot Alpine for the new DOM elements
});

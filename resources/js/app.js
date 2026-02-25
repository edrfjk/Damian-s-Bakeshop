import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Cart counter
function updateCartCount() {
    const count = localStorage.getItem('cart_count') || 0;
    const badge = document.querySelector('.cart-count');
    if (badge) {
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    }
}

window.updateCartCount = updateCartCount;
document.addEventListener('DOMContentLoaded', updateCartCount);
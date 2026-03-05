import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('toastNotification', () => ({
    toasts: [],
    nextId: 0,
    show(message) {
        const id = this.nextId++;
        const toast = { id, message, visible: true };
        this.toasts.push(toast);
        setTimeout(() => {
            toast.visible = false;
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 300);
        }, 3000);
    }
}));

Alpine.data('addToCart', () => ({
    loading: false,
    submit(form) {
        this.loading = true;
        const formData = new FormData(form);
        window.axios.post(form.action, formData)
            .then(response => {
                if (response.data.success) {
                    window.dispatchEvent(new CustomEvent('cart-updated', {
                        detail: {
                            cartCount: response.data.cartCount,
                            message: response.data.message
                        }
                    }));
                }
            })
            .catch(() => {
                form.submit();
            })
            .finally(() => {
                this.loading = false;
            });
    }
}));

Alpine.start();

// Back to top button
document.addEventListener('DOMContentLoaded', function() {
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTop.classList.remove('hidden');
                backToTop.classList.add('flex');
            } else {
                backToTop.classList.add('hidden');
                backToTop.classList.remove('flex');
            }
        });
        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});

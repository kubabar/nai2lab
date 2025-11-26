/**
 * Main JavaScript file for AJP Website
 * Obsługa ogólnych funkcjonalności strony
 */

document.addEventListener('DOMContentLoaded', function () {

    // Mobile menu toggle
    initMobileMenu();

    // Smooth scrolling dla linków kotwicznych
    initSmoothScroll();

    // Lazy loading obrazów
    initLazyLoading();

    // Form validation enhancement
    enhanceFormValidation();

    // Back to top button
    initBackToTop();

    // Reset form after successful submission (with toast)
    initFormResetAfterSuccess();

    console.log('AJP Website loaded successfully');
});

/**
 * Inicjalizacja mobilnego menu (hamburger)
 */
function initMobileMenu() {
    const navMenu = document.querySelector('.nav-menu');

    // Sprawdź czy menu istnieje
    if (!navMenu) return;

    // Tworzenie przycisku hamburger
    const hamburger = document.createElement('button');
    hamburger.className = 'hamburger';
    hamburger.innerHTML = '☰';
    hamburger.setAttribute('aria-label', 'Toggle menu');

    const navbar = document.querySelector('.navbar .container');
    if (navbar) {
        navbar.insertBefore(hamburger, navMenu);
    }

    // Toggle menu on click
    hamburger.addEventListener('click', function () {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');

        // Zmiana ikony
        if (navMenu.classList.contains('active')) {
            hamburger.innerHTML = '✕';
        } else {
            hamburger.innerHTML = '☰';
        }
    });

    // Zamknij menu po kliknięciu w link
    const menuLinks = navMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
                hamburger.innerHTML = '☰';
            }
        });
    });
}

/**
 * Płynne przewijanie do sekcji
 */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Ignoruj puste hashtagi
            if (href === '#' || href === '#!') return;

            const target = document.querySelector(href);

            if (target) {
                e.preventDefault();

                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Lazy loading dla obrazów
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback dla starszych przeglądarek
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    }
}

/**
 * Ulepszenie walidacji formularzy
 */
function enhanceFormValidation() {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea');

        inputs.forEach(input => {
            // Real-time validation
            input.addEventListener('blur', function () {
                validateField(this);
            });

            // Usuń błąd podczas pisania
            input.addEventListener('input', function () {
                if (this.classList.contains('error')) {
                    this.classList.remove('error');
                    const errorMsg = this.parentElement.querySelector('.error-message');
                    if (errorMsg) errorMsg.remove();
                }
            });
        });

        // Walidacja przy submit
        form.addEventListener('submit', function (e) {
            let isValid = true;

            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();

                // Scroll do pierwszego błędu
                const firstError = form.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
    });
}

/**
 * Walidacja pojedynczego pola
 */
function validateField(field) {
    // Usuń poprzednie komunikaty błędów
    const existingError = field.parentElement.querySelector('.error-message');
    if (existingError) existingError.remove();
    field.classList.remove('error');

    let isValid = true;
    let errorMessage = '';

    // Sprawdź czy pole jest wymagane
    if (field.hasAttribute('required') && !field.value.trim()) {
        isValid = false;
        errorMessage = 'To pole jest wymagane';
    }

    // Walidacja email
    if (field.type === 'email' && field.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value)) {
            isValid = false;
            errorMessage = 'Podaj poprawny adres email';
        }
    }

    // Walidacja telefonu
    if (field.type === 'tel' && field.value) {
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        if (!phoneRegex.test(field.value)) {
            isValid = false;
            errorMessage = 'Podaj poprawny numer telefonu';
        }
    }

    // Minimalna długość
    if (field.hasAttribute('minlength')) {
        const minLength = parseInt(field.getAttribute('minlength'));
        if (field.value.length < minLength) {
            isValid = false;
            errorMessage = `Minimum ${minLength} znaków`;
        }
    }

    // Jeśli błąd, pokaż komunikat
    if (!isValid) {
        field.classList.add('error');

        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = errorMessage;
        errorDiv.style.color = '#e74c3c';
        errorDiv.style.fontSize = '0.9rem';
        errorDiv.style.marginTop = '0.25rem';

        field.parentElement.appendChild(errorDiv);
    }

    return isValid;
}

/**
 * Przycisk "Wróć do góry"
 */
function initBackToTop() {
    // Tworzenie przycisku
    const backToTopBtn = document.createElement('button');
    backToTopBtn.className = 'back-to-top';
    backToTopBtn.innerHTML = '↑';
    backToTopBtn.setAttribute('aria-label', 'Wróć do góry');
    backToTopBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 999;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    `;

    document.body.appendChild(backToTopBtn);

    // Pokaż/ukryj przycisk podczas scrollowania
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopBtn.style.opacity = '1';
            backToTopBtn.style.visibility = 'visible';
        } else {
            backToTopBtn.style.opacity = '0';
            backToTopBtn.style.visibility = 'hidden';
        }
    });

    // Scroll do góry po kliknięciu
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Hover effect
    backToTopBtn.addEventListener('mouseenter', () => {
        backToTopBtn.style.background = '#2980b9';
        backToTopBtn.style.transform = 'scale(1.1)';
    });

    backToTopBtn.addEventListener('mouseleave', () => {
        backToTopBtn.style.background = '#3498db';
        backToTopBtn.style.transform = 'scale(1)';
    });
}

/**
 * Reset formularza po udanym wysłaniu
 */
function initFormResetAfterSuccess() {
    // Sprawdź czy w URL jest parametr success
    const urlParams = new URLSearchParams(window.location.search);
    const hasSuccess = urlParams.get('success') === '1';

    if (hasSuccess) {
        // Znajdź wszystkie formularze
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.reset();
        });

        // Opcjonalnie: usuń parametr success z URL po 3 sekundach
        setTimeout(() => {
            if (window.history.replaceState) {
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        }, 3000);
    }
}

/**
 * Funkcje pomocnicze dostępne globalnie
 */
window.AJP = {
    /**
     * Wyświetl toast notification
     */
    showToast: function (message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;
        toast.style.cssText = `
            position: fixed;
            top: 100px;
            right: 30px;
            padding: 1rem 1.5rem;
            background: ${type === 'success' ? '#2ecc71' : type === 'error' ? '#e74c3c' : '#3498db'};
            color: white;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;

        document.body.appendChild(toast);

        // Auto remove po 3 sekundach
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    },

    /**
     * Format daty
     */
    formatDate: function (date) {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}.${month}.${year}`;
    },

    /**
     * Debounce function
     */
    debounce: function (func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
};

// Dodaj style dla animacji
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .hamburger {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        padding: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .hamburger {
            display: block;
        }
        
        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #2c3e50;
            padding: 1rem;
        }
        
        .nav-menu.active {
            display: flex;
        }
    }
`;
document.head.appendChild(style);
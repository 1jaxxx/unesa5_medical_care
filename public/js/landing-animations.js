/**
 * Modern Animations for Landing Page Partials
 * Using Intersection Observer API for scroll animations
 */

// Animation configurations
const animationConfig = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

// Initialize animations when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initNavbarAnimation();
    initHeroAnimation();
    initServicesAnimation();
    initAboutAnimation();
    initContactAnimation();
    initFooterAnimation();
    initScrollAnimations();
});

/**
 * Navbar Animation - Slide down with fade
 */
function initNavbarAnimation() {
    const navbar = document.querySelector('nav');
    if (!navbar) return;

    // Initial state
    navbar.style.opacity = '0';
    navbar.style.transform = 'translateY(-20px)';
    navbar.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

    // Animate in
    setTimeout(() => {
        navbar.style.opacity = '1';
        navbar.style.transform = 'translateY(0)';
    }, 100);

    // Navbar scroll effect
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            navbar.classList.add('scrolled');
            navbar.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.classList.remove('scrolled');
            navbar.style.boxShadow = 'none';
        }
        
        lastScroll = currentScroll;
    });
}

/**
 * Hero Section Animation - Stagger fade in
 */
function initHeroAnimation() {
    const heroElements = document.querySelectorAll('.hero-animate');
    
    heroElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 200 + (index * 150));
    });

    // Floating animation for hero image/icon
    const heroImage = document.querySelector('.hero-image');
    if (heroImage) {
        heroImage.style.animation = 'float 3s ease-in-out infinite';
    }
}

/**
 * Services Section Animation - Cards slide up
 */
function initServicesAnimation() {
    const serviceCards = document.querySelectorAll('.service-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0) scale(1)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, animationConfig);

    serviceCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px) scale(0.95)';
        card.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
        observer.observe(card);

        // Hover effect
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.03)';
            this.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '';
        });
    });
}

/**
 * About Section Animation - Slide from sides
 */
function initAboutAnimation() {
    const aboutContent = document.querySelector('.about-content');
    const aboutImage = document.querySelector('.about-image');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('about-content')) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0)';
                } else if (entry.target.classList.contains('about-image')) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0) rotate(0deg)';
                }
                observer.unobserve(entry.target);
            }
        });
    }, animationConfig);

    if (aboutContent) {
        aboutContent.style.opacity = '0';
        aboutContent.style.transform = 'translateX(-50px)';
        aboutContent.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(aboutContent);
    }

    if (aboutImage) {
        aboutImage.style.opacity = '0';
        aboutImage.style.transform = 'translateX(50px) rotate(5deg)';
        aboutImage.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(aboutImage);
    }
}

/**
 * Contact Section Animation - Form elements fade in
 */
function initContactAnimation() {
    const contactForm = document.querySelector('.contact-form');
    const contactInfo = document.querySelector('.contact-info');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const formElements = entry.target.querySelectorAll('input, textarea, button, .info-item');
                formElements.forEach((element, index) => {
                    setTimeout(() => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, index * 80);
                });
                observer.unobserve(entry.target);
            }
        });
    }, animationConfig);

    if (contactForm) {
        const formElements = contactForm.querySelectorAll('input, textarea, button');
        formElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        observer.observe(contactForm);
    }

    if (contactInfo) {
        const infoItems = contactInfo.querySelectorAll('.info-item');
        infoItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        observer.observe(contactInfo);
    }

    // Add ripple effect to submit button
    const submitBtn = document.querySelector('.contact-form button[type="submit"]');
    if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    }
}

/**
 * Footer Animation - Fade in from bottom
 */
function initFooterAnimation() {
    const footer = document.querySelector('footer');
    if (!footer) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, animationConfig);

    footer.style.opacity = '0';
    footer.style.transform = 'translateY(30px)';
    footer.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
    observer.observe(footer);
}

/**
 * General scroll animations for elements with data-animate attribute
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('[data-animate]');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const animationType = entry.target.dataset.animate;
                entry.target.classList.add('animated', animationType);
                observer.unobserve(entry.target);
            }
        });
    }, animationConfig);

    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

/**
 * Smooth scroll for anchor links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;

        e.preventDefault();
        const target = document.querySelector(href);
        
        if (target) {
            const offsetTop = target.offsetTop - 80; // Account for fixed navbar
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

/**
 * Add parallax effect to hero section
 */
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallaxElements = document.querySelectorAll('.parallax');
    
    parallaxElements.forEach(element => {
        const speed = element.dataset.speed || 0.5;
        element.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

/**
 * Add CSS animations via JavaScript
 */
const style = document.createElement('style');
style.textContent = `
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animated {
        animation-duration: 0.8s;
        animation-fill-mode: both;
    }

    .fadeInUp {
        animation-name: fadeInUp;
    }

    .fadeInLeft {
        animation-name: fadeInLeft;
    }

    .fadeInRight {
        animation-name: fadeInRight;
    }

    .scaleIn {
        animation-name: scaleIn;
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Smooth transitions for all interactive elements */
    button, a, .card, .service-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Loading state */
    .loading {
        opacity: 0;
        pointer-events: none;
    }

    .loaded {
        opacity: 1;
        pointer-events: auto;
    }
`;
document.head.appendChild(style);

// Page load animation
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});

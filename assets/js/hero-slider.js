/**
 * Hero Slider JavaScript
 * Dynamic background slider for hero section
 */

class HeroSlider {
    constructor() {
        this.slides = document.querySelectorAll('.hero-slide');
        this.indicators = document.querySelectorAll('.hero-indicator');
        this.controls = {
            prev: document.querySelector('.hero-prev'),
            next: document.querySelector('.hero-next')
        };
        this.currentSlide = 0;
        this.slideCount = this.slides.length;
        this.autoSlideInterval = null;
        this.isTransitioning = false;

        if (this.slideCount > 1) {
            this.init();
        }
    }

    init() {
        this.bindEvents();
        this.startAutoSlide();

        // Pause on hover
        const heroSection = document.querySelector('.hero-slider');
        if (heroSection) {
            heroSection.addEventListener('mouseenter', () => this.stopAutoSlide());
            heroSection.addEventListener('mouseleave', () => this.startAutoSlide());
        }

        // Pause on focus (accessibility)
        this.controls.prev && this.controls.prev.addEventListener('focus', () => this.stopAutoSlide());
        this.controls.next && this.controls.next.addEventListener('focus', () => this.stopAutoSlide());

        // Resume on blur
        this.controls.prev && this.controls.prev.addEventListener('blur', () => this.startAutoSlide());
        this.controls.next && this.controls.next.addEventListener('blur', () => this.startAutoSlide());
    }

    bindEvents() {
        // Control buttons
        if (this.controls.prev) {
            this.controls.prev.addEventListener('click', () => this.prev());
        }
        if (this.controls.next) {
            this.controls.next.addEventListener('click', () => this.next());
        }

        // Indicator buttons
        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => this.goTo(index));
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (document.activeElement.closest('.hero-slider')) {
                switch (e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        this.prev();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        this.next();
                        break;
                }
            }
        });

        // Touch/swipe support
        this.addTouchSupport();
    }

    addTouchSupport() {
        let startX = 0;
        let startY = 0;
        let endX = 0;
        let endY = 0;

        const heroSection = document.querySelector('.hero-slider');
        if (!heroSection) return;

        heroSection.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });

        heroSection.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            endY = e.changedTouches[0].clientY;
            this.handleSwipe(startX, startY, endX, endY);
        });
    }

    handleSwipe(startX, startY, endX, endY) {
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        const minSwipeDistance = 50;

        // Ensure horizontal swipe is more significant than vertical
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > minSwipeDistance) {
            if (deltaX > 0) {
                this.prev(); // Swipe right - go to previous
            } else {
                this.next(); // Swipe left - go to next
            }
        }
    }

    goTo(slideIndex) {
        if (this.isTransitioning || slideIndex === this.currentSlide) return;

        this.isTransitioning = true;

        // Hide current slide
        this.slides[this.currentSlide].classList.remove('active');
        if (this.indicators[this.currentSlide]) {
            this.indicators[this.currentSlide].classList.remove('active');
        }

        // Show new slide
        this.currentSlide = slideIndex;
        this.slides[this.currentSlide].classList.add('active');
        if (this.indicators[this.currentSlide]) {
            this.indicators[this.currentSlide].classList.add('active');
        }

        // Reset transition flag after animation
        setTimeout(() => {
            this.isTransitioning = false;
        }, 1000);

        // Announce slide change for screen readers
        this.announceSlideChange();
    }

    next() {
        const nextSlide = (this.currentSlide + 1) % this.slideCount;
        this.goTo(nextSlide);
    }

    prev() {
        const prevSlide = (this.currentSlide - 1 + this.slideCount) % this.slideCount;
        this.goTo(prevSlide);
    }

    startAutoSlide() {
        if (this.slideCount > 1) {
            this.stopAutoSlide(); // Clear any existing interval
            this.autoSlideInterval = setInterval(() => {
                this.next();
            }, 5000); // Change slide every 5 seconds
        }
    }

    stopAutoSlide() {
        if (this.autoSlideInterval) {
            clearInterval(this.autoSlideInterval);
            this.autoSlideInterval = null;
        }
    }

    announceSlideChange() {
        // Create announcement for screen readers
        const announcement = `Slide ${this.currentSlide + 1} of ${this.slideCount}`;
        const srAnnouncement = document.getElementById('sr-slider-announcement');
        if (srAnnouncement) {
            srAnnouncement.textContent = announcement;
        }
    }

    destroy() {
        this.stopAutoSlide();
        // Remove event listeners if needed
        // This method can be called when the slider is no longer needed
    }
}

// Initialize slider when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Create screen reader announcement element
    const srElement = document.createElement('div');
    srElement.id = 'sr-slider-announcement';
    srElement.className = 'sr-only';
    srElement.setAttribute('aria-live', 'polite');
    srElement.setAttribute('aria-atomic', 'true');
    document.body.appendChild(srElement);

    // Handle image loading errors
    const heroSlides = document.querySelectorAll('.hero-slide');
    heroSlides.forEach((slide, index) => {
        const bgImage = slide.style.backgroundImage;
        if (bgImage && bgImage.includes('url(')) {
            const imageUrl = bgImage.match(/url\(['"]?([^'"]+)['"]?\)/);
            if (imageUrl && imageUrl[1]) {
                const img = new Image();
                img.onerror = function () {
                    // Fallback to gradient background
                    const gradients = [
                        'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                        'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                        'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                        'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)'
                    ];
                    const gradientIndex = index % gradients.length;
                    slide.style.backgroundImage = gradients[gradientIndex];
                    console.warn(`Failed to load slider image: ${imageUrl[1]}, using gradient fallback`);
                };
                img.src = imageUrl[1];
            }
        }
    });

    // Initialize slider
    window.heroSlider = new HeroSlider();
});

// Handle page visibility change (pause when tab is hidden)
document.addEventListener('visibilitychange', function () {
    if (window.heroSlider) {
        if (document.hidden) {
            window.heroSlider.stopAutoSlide();
        } else {
            window.heroSlider.startAutoSlide();
        }
    }
});

// Cleanup on page unload
window.addEventListener('beforeunload', function () {
    if (window.heroSlider) {
        window.heroSlider.destroy();
    }
});
<!-- Back to Top Button -->
<a href="#" class="back-to-top" id="backToTop">
    <i class="fas fa-chevron-up"></i>
</a>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5.3.0 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS Animation JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Custom JS -->
<script>
    $(document).ready(function() {
        // Initialize AOS setelah DOM ready
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                once: true,
                offset: 50,
                disable: 'mobile'
            });
        }

        // Navbar scroll effect dengan throttling
        let ticking = false;

        function updateNavbar() {
            const navbar = $('.navbar');
            if ($(window).scrollTop() > 50) {
                navbar.addClass('scrolled');
            } else {
                navbar.removeClass('scrolled');
            }
            ticking = false;
        }

        $(window).on('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        });

        // Smooth scrolling for navigation links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const targetId = $(this).attr('href');
            const target = $(targetId);
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 70
                }, 600);
            }
        });

        // Counter animation
        function animateCounter($element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                $element.text(Math.floor(current).toLocaleString());
            }, 20);
        }

        // Intersection Observer for counters
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const $counter = $(entry.target);
                        const target = parseInt($counter.text().replace(/[^\d]/g, ''));
                        $counter.text('0');
                        animateCounter($counter, target);
                        observer.unobserve(entry.target);
                    }
                });
            });

            $('.stat-number').each(function() {
                observer.observe(this);
            });
        }

        // Card hover effects
        $('.program-card, .news-card').hover(
            function() {
                $(this).css('transform', 'translateY(-10px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );

        // Feature cards interactions
        $('.feature-card').each(function(index) {
            $(this).attr('data-aos-delay', (index * 150));
        });

        $('.feature-card').hover(
            function() {
                $('.feature-card').not(this).css({
                    'opacity': '0.7',
                    'transform': 'scale(0.98)'
                });
                $(this).find('.feature-icon').css('transform', 'rotate(360deg) scale(1.1)');
            },
            function() {
                $('.feature-card').css({
                    'opacity': '1',
                    'transform': 'scale(1)'
                });
                $(this).find('.feature-icon').css('transform', 'rotate(0deg) scale(1)');
            }
        );

        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('#backToTop').fadeIn();
            } else {
                $('#backToTop').fadeOut();
            }
        });

        $('#backToTop').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
            return false;
        });

        // Mobile menu handler
        $('.navbar-toggler').click(function() {
            $('.navbar-collapse').toggleClass('show');
        });

        // Enhanced dropdown behavior untuk program studi
        $('#programsDropdown').on('show.bs.dropdown', function() {
            $(this).parent().addClass('dropdown-active');
        });

        $('#programsDropdown').on('hide.bs.dropdown', function() {
            $(this).parent().removeClass('dropdown-active');
        });

        // Smooth hover effect untuk dropdown items
        $('.dropdown-item').hover(
            function() {
                $(this).siblings().css('opacity', '0.7');
            },
            function() {
                $(this).siblings().css('opacity', '1');
            }
        ); // Auto-hide alerts
        $('.alert.auto-hide').delay(5000).fadeOut();

        // Form validation enhancement
        $('.needs-validation').submit(function(e) {
            const form = $(this)[0];
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            $(form).addClass('was-validated');
        });

        // Tooltip dan Popover initialization
        $('[data-bs-toggle="tooltip"]').tooltip();
        $('[data-bs-toggle="popover"]').popover();

        // Search functionality
        $('.search-input').on('input', function() {
            const query = $(this).val();
            if (query.length >= 3) {
                console.log('Searching for:', query);
            }
        });

        // Close mobile menu when clicking outside
        $(document).click(function(e) {
            const navbar = $('.navbar-collapse');
            const toggler = $('.navbar-toggler');

            if (!navbar.is(e.target) && navbar.has(e.target).length === 0 &&
                !toggler.is(e.target) && toggler.has(e.target).length === 0) {
                navbar.removeClass('show');
            }
        });
    });

    // Global error handler untuk mencegah error JavaScript
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
    });
</script>
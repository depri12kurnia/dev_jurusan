<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title; ?></title>
<!-- Preload critical resources -->
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="https://unpkg.com">
<!-- Bootstrap 5.3.0 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- AOS Animation - Load after critical CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" media="print" onload="this.media='all'">
<!-- Custom CSS -->
<style>
    :root {
        --primary-color: #00B9AD;
        --secondary-color: #60C0D0;
        --tertiary-color: #A8E6CF;
        --accent-color: #F8FDFC;
        --text-dark: #2C3E50;
        --text-light: #6C757D;
        --border-color: #00B9AD;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
    }

    /* Navigation - Optimized for performance */
    .navbar {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        will-change: transform;
    }

    .navbar.scrolled {
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.12);
    }

    /* Dropdown styling untuk program studi */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 10px 0;
        max-height: 400px;
        overflow-y: auto;
    }

    .dropdown-header {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 16px 4px;
        margin-bottom: 4px;
    }

    .dropdown-item {
        padding: 8px 16px;
        transition: all 0.2s ease;
        border-radius: 5px;
        margin: 2px 8px;
    }

    .dropdown-item:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateX(5px);
    }

    .dropdown-item.ps-4 {
        padding-left: 24px;
        font-size: 0.9rem;
    }

    /* Dropdown animation */
    .dropdown-menu {
        animation: dropdownFadeIn 0.3s ease-out;
    }

    @keyframes dropdownFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Active dropdown state */
    .dropdown-active .nav-link {
        color: var(--primary-color) !important;
    }

    .navbar-brand {
        font-weight: 700;
        color: var(--primary-color) !important;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
    }

    .navbar-brand img {
        height: 50px;
        width: auto;
        max-width: 200px;
        object-fit: contain;
        margin-right: 10px;
    }

    .navbar-brand .brand-text {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .nav-link {
        font-weight: 500;
        color: var(--text-dark) !important;
        transition: color 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: var(--primary-color) !important;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background: var(--primary-color);
        transition: all 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    /* Dropdown Menu Styles */
    .dropdown-menu {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 0.5rem 0;
        margin-top: 0.5rem;
    }

    .dropdown-item {
        color: var(--text-dark);
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        transform: translateX(5px);
    }

    .dropdown-item i {
        width: 20px;
        margin-right: 10px;
        color: var(--primary-color);
    }

    .dropdown-item:hover i {
        color: white;
    }

    .dropdown-divider {
        border-top: 1px solid rgba(0, 185, 173, 0.2);
        margin: 0.5rem 0;
    }

    .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    /* Login Button Styles */
    .navbar .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: transparent;
        transition: all 0.3s ease;
    }

    /* Program Studi Detail Enhancements */
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }

    .icon-circle {
        transition: all 0.3s ease;
    }

    .icon-circle:hover {
        transform: scale(1.1);
    }

    /* Enhanced Nav Pills */
    .nav-pills .nav-link {
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 500;
        margin: 0 4px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .nav-pills .nav-link:not(.active):hover {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-color: var(--primary-color);
        box-shadow: 0 4px 15px rgba(0, 185, 173, 0.3);
    }

    /* Enhanced Cards */
    .card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 15px;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }

    /* Background Patterns */
    .bg-pattern-dots::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        pointer-events: none;
    }

    /* Animated Gradient */
    .gradient-animated {
        background: linear-gradient(-45deg, var(--primary-color), var(--secondary-color), var(--tertiary-color), var(--primary-color));
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Responsive Improvements */
    @media (max-width: 768px) {
        .nav-pills .nav-link {
            padding: 8px 16px;
            font-size: 0.9rem;
            margin: 2px;
        }

        .display-5 {
            font-size: 2rem;
        }

        .card-body {
            padding: 1rem;
        }
    }

    /* Text Enhancements */
    .text-white-75 {
        color: rgba(255, 255, 255, 0.75) !important;
    }

    .lh-lg {
        line-height: 1.8;
    }

    /* Badge Improvements */
    .badge {
        font-size: 0.8em;
        padding: 0.5em 1em;
        font-weight: 500;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    /* Program Detail CTA Enhancements */
    .hover-lift-sm {
        transition: all 0.3s ease;
    }

    .hover-lift-sm:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Stat Items Animation */
    .stat-item {
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateX(5px);
    }

    .stat-item .rounded-circle {
        transition: all 0.3s ease;
    }

    .stat-item:hover .rounded-circle {
        transform: scale(1.1);
    }

    /* Contact Links Enhancement */
    .contact-links a {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .contact-links a:hover {
        border-color: var(--primary-color);
        background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
        transform: translateX(5px);
    }

    /* CTA Button Enhancements */
    .btn-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-outline-light:hover {
        transform: translateY(-1px);
    }
    }

    .navbar .btn-outline-primary:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 185, 173, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .navbar-brand img {
            height: 40px;
        }

        .navbar-brand .brand-text {
            font-size: 1rem;
        }

        .dropdown-menu {
            border-radius: 8px;
            margin-top: 0.25rem;
        }

        .navbar .btn-outline-primary {
            margin-top: 0.5rem;
            margin-left: 0;
        }
    }

    @media (max-width: 575.98px) {
        .navbar-brand img {
            height: 35px;
        }

        .navbar-brand .brand-text {
            font-size: 0.9rem;
        }
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--tertiary-color) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="1000,100 1000,0 0,100"/></svg>');
        background-size: cover;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .btn-hero {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid white;
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-hero:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Stats Section */
    .stats {
        background: var(--accent-color);
        padding: 80px 0;
    }

    .stat-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: 15px;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
    }

    .stat-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-light);
        font-weight: 500;
    }

    /* Programs Section */
    .programs {
        padding: 100px 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .section-title p {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
    }

    .program-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        padding: 30px 25px;
        position: relative;
    }

    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .program-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .program-jenjang {
        text-align: center;
        margin-bottom: 15px;
    }

    .program-jenjang .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .program-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        text-align: center;
        line-height: 1.3;
    }

    .program-gelar {
        text-align: center;
        margin-bottom: 15px;
    }

    .program-description {
        color: var(--text-light);
        text-align: center;
        margin-bottom: 20px;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .program-meta {
        display: flex;
        justify-content: space-around;
        margin-bottom: 25px;
        padding: 15px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .meta-item {
        text-align: center;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    .meta-item i {
        color: var(--primary-color);
    }

    .program-link {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        text-decoration: none;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-align: center;
        width: 100%;
    }

    .program-link:hover {
        color: white;
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 185, 173, 0.3);
    }

    /* Features Section */
    .features {
        background: linear-gradient(135deg, #f8fdfc 0%, #e0f7f4 50%, #f8fdfc 100%);
        padding: 120px 0;
        position: relative;
        overflow: hidden;
    }

    .features::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(0,185,173,0.03)"><polygon points="0,0 1000,100 1000,0"/></svg>');
        background-size: cover;
    }

    .features-container {
        position: relative;
        z-index: 2;
    }

    .features-grid {
        display: grid;
        gap: 2rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        transform: translateX(-100%);
        transition: transform 0.4s ease;
    }

    .feature-card:hover::before {
        transform: translateX(0);
    }

    .feature-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 185, 173, 0.15);
        background: rgba(255, 255, 255, 0.95);
    }

    .feature-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .feature-icon {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-right: 1.5rem;
        flex-shrink: 0;
        box-shadow: 0 10px 25px rgba(0, 185, 173, 0.25);
        position: relative;
        overflow: hidden;
    }

    .feature-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-icon::before {
        transform: translateX(100%);
    }

    .feature-number {
        position: absolute;
        top: -10px;
        right: -10px;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--tertiary-color) 100%);
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .feature-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        line-height: 1.3;
    }

    .feature-subtitle {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .feature-description {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .feature-highlights {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .feature-highlight {
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.1) 0%, rgba(96, 192, 208, 0.1) 100%);
        color: var(--primary-color);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid rgba(0, 185, 173, 0.2);
    }

    .feature-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .feature-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transition: width 0.3s ease;
    }

    .feature-link:hover {
        color: var(--secondary-color);
        transform: translateX(5px);
    }

    .feature-link:hover::after {
        width: 100%;
    }

    .feature-link i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .feature-link:hover i {
        transform: translateX(3px);
    }

    /* Feature Image/Illustration */
    .feature-illustration {
        text-align: center;
        position: relative;
    }

    .feature-illustration i {
        font-size: 18rem;
        color: var(--primary-color);
        opacity: 0.08;
        animation: float 3s ease-in-out infinite;
    }

    .feature-stats {
        position: absolute;
        top: 20%;
        right: 10%;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        animation: float 3s ease-in-out infinite reverse;
    }

    .feature-stats-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.25rem;
    }

    .feature-stats-label {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* Responsive Grid */
    @media (min-width: 768px) {
        .features-grid {
            grid-template-columns: 1fr 1fr;
            align-items: start;
        }
    }

    @media (max-width: 767.98px) {
        .feature-card {
            padding: 2rem;
        }

        .feature-header {
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
        }

        .feature-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .feature-illustration i {
            font-size: 12rem;
        }

        .feature-stats {
            position: relative;
            top: auto;
            right: auto;
            margin-top: 2rem;
        }
    }

    /* News Section */
    .news {
        padding: 100px 0;
    }

    .news-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .news-image {
        height: 200px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--tertiary-color) 100%);
        position: relative;
        overflow: hidden;
    }

    .news-date {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.9);
        color: var(--text-dark);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .news-content {
        padding: 25px;
    }

    .news-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .news-excerpt {
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .news-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .news-link:hover {
        color: var(--secondary-color);
    }

    /* CTA Section */
    .cta {
        background: linear-gradient(135deg, var(--text-dark) 0%, #34495E 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
    }

    .cta h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .btn-cta {
        background: var(--primary-color);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-cta:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 185, 173, 0.4);
    }

    /* Footer */
    .footer {
        background: var(--text-dark);
        color: white;
        padding: 60px 0 20px;
    }

    .footer h5 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .footer a {
        color: #BDC3C7;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer a:hover {
        color: var(--primary-color);
    }

    .footer-bottom {
        border-top: 1px solid #34495E;
        margin-top: 40px;
        padding-top: 20px;
        text-align: center;
        color: #BDC3C7;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }

        .hero p {
            font-size: 1.1rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .feature-item {
            flex-direction: column;
            text-align: center;
        }

        .feature-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }
    }

    /* Animations */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: var(--primary-color);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: var(--dark-color);
        color: white;
        text-decoration: none;
        transform: translateY(-3px);
    }
</style>
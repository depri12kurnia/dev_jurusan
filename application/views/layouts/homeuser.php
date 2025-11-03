<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakultas Kesehatan - Universitas Nusantara</title>
    <!-- Bootstrap 5.3.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #00B9AD;
            --secondary-color: #60C0D0;
            --tertiary-color: #A8E6CF;
            --accent-color: #F8FDFC;
            --text-dark: #2C3E50;
            --text-light: #6C757D;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.15);
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
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?php echo base_url(); ?>public/settings/logo/logo.png" alt="Logo" onerror="this.style.display='none'">
                <span class="brand-text">Fakultas Kesehatan</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#programs" id="programsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-graduation-cap me-1"></i>Program Studi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="programsDropdown">
                            <?php if (!empty($program_studi_all)): ?>
                                <?php foreach ($program_studi_all as $prodi): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('program-studi/' . $prodi->slug) ?>">
                                            <i class="<?= $prodi->icon ?> me-2" style="color: <?= $prodi->warna ?>;"></i>
                                            <?= $prodi->jenjang ?> <?= $prodi->nama_prodi ?>
                                            <?php if ($prodi->akreditasi): ?>
                                                <span class="badge bg-success ms-1" style="font-size: 0.6em;">A</span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user-nurse me-2" style="color: #E8717A;"></i>S1 Keperawatan</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-baby me-2" style="color: #F4A7B9;"></i>D3 Kebidanan</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-stethoscope me-2" style="color: #00B9AD;"></i>Profesi Ners</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= site_url('program-studi') ?>"><i class="fas fa-list me-2"></i>Semua Program Studi</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i>Info Pendaftaran</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#features" id="facilitiesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-building me-1"></i>Fasilitas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="facilitiesDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-procedures"></i>Lab Keperawatan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heartbeat"></i>Lab Kebidanan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-hospital-alt"></i>Rumah Sakit Pendidikan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-microscope"></i>Lab Sains Dasar</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-book"></i>Perpustakaan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="academicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-university me-1"></i>Akademik
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="academicDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-alt"></i>Kalender Akademik</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i>Kurikulum</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-award"></i>Beasiswa</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-clipboard-check"></i>Uji Kompetensi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#news">
                            <i class="fas fa-newspaper me-1"></i>Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            <i class="fas fa-info-circle me-1"></i>Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('auth/login'); ?>">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                        <h1>Fakultas Kesehatan</h1>
                        <p>Membangun generasi tenaga kesehatan profesional yang kompeten dan berjiwa sosial tinggi. Bergabunglah dengan kami untuk memberikan pelayanan kesehatan terbaik bagi masyarakat!</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <button class="btn btn-hero">Daftar Sekarang</button>
                            <button class="btn btn-hero">Info Pendaftaran</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="text-center">
                            <i class="fas fa-user-nurse" style="font-size: 20rem; opacity: 0.1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-number"><?= isset($stats['total_prodi']) ? $stats['total_prodi'] : '3' ?>+</div>
                        <div class="stat-label">Program Studi</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-number"><?= isset($stats['total_mahasiswa']) ? number_format($stats['total_mahasiswa']) : '2,200' ?>+</div>
                        <div class="stat-label">Mahasiswa Aktif</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-number"><?= isset($stats['total_alumni']) ? number_format($stats['total_alumni']) : '5,500' ?>+</div>
                        <div class="stat-label">Alumni Sukses</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="stat-number"><?= isset($stats['rata_akreditasi_a']) ? $stats['rata_akreditasi_a'] : '3' ?></div>
                        <div class="stat-label">Prodi Terakreditasi A</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="programs">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Program Studi Unggulan</h2>
                <p>Program studi berkualitas dengan akreditasi A yang mempersiapkan tenaga kesehatan profesional dan kompeten</p>
            </div>

            <div class="row g-4">
                <?php if (!empty($program_studi_featured)): ?>
                    <?php foreach ($program_studi_featured as $index => $prodi): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="program-card" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>" style="--theme-color: <?= $prodi->warna ?>">
                                <div class="program-icon" style="background: linear-gradient(135deg, <?= $prodi->warna ?>20, <?= $prodi->warna ?>40); color: <?= $prodi->warna ?>;">
                                    <i class="<?= $prodi->icon ?>"></i>
                                </div>
                                <div class="program-jenjang">
                                    <span class="badge" style="background-color: <?= $prodi->warna ?>;"><?= $prodi->jenjang ?></span>
                                    <?php if ($prodi->akreditasi): ?>
                                        <span class="badge bg-success ms-1">Akreditasi <?= $prodi->akreditasi ?></span>
                                    <?php endif; ?>
                                </div>
                                <h4 class="program-title"><?= $prodi->nama_prodi ?></h4>
                                <div class="program-gelar mb-2">
                                    <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: <?= $prodi->gelar ?></small>
                                </div>
                                <p class="program-description">
                                    <?= $prodi->featured_description ?: $prodi->deskripsi ?: 'Program studi unggulan dengan kurikulum terkini dan fasilitas modern.' ?>
                                </p>
                                <div class="program-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-clock me-1"></i>
                                        <small><?= $prodi->durasi_studi ?> Semester</small>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-award me-1"></i>
                                        <small><?= $prodi->sks_total ?> SKS</small>
                                    </div>
                                </div>
                                <a href="<?= site_url('program-studi/' . $prodi->slug) ?>" class="program-link">
                                    Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Default programs jika tidak ada data -->
                    <div class="col-lg-4 col-md-6">
                        <div class="program-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="program-icon" style="background: linear-gradient(135deg, #E8717A20, #E8717A40); color: #E8717A;">
                                <i class="fas fa-user-nurse"></i>
                            </div>
                            <div class="program-jenjang">
                                <span class="badge" style="background-color: #E8717A;">S1</span>
                                <span class="badge bg-success ms-1">Akreditasi A</span>
                            </div>
                            <h4 class="program-title">Keperawatan</h4>
                            <div class="program-gelar mb-2">
                                <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: S.Kep</small>
                            </div>
                            <p class="program-description">Program Studi Keperawatan yang menghasilkan perawat profesional dengan kompetensi klinis dan kepemimpinan yang unggul.</p>
                            <div class="program-meta">
                                <div class="meta-item">
                                    <i class="fas fa-clock me-1"></i>
                                    <small>8 Semester</small>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-award me-1"></i>
                                    <small>144 SKS</small>
                                </div>
                            </div>
                            <a href="#" class="program-link">
                                Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="program-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="program-icon" style="background: linear-gradient(135deg, #F4A7B920, #F4A7B940); color: #F4A7B9;">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div class="program-jenjang">
                                <span class="badge" style="background-color: #F4A7B9;">D3</span>
                                <span class="badge bg-success ms-1">Akreditasi A</span>
                            </div>
                            <h4 class="program-title">Kebidanan</h4>
                            <div class="program-gelar mb-2">
                                <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: A.Md.Keb</small>
                            </div>
                            <p class="program-description">Program Diploma Kebidanan yang mempersiapkan bidan kompeten dalam pelayanan kesehatan ibu dan anak.</p>
                            <div class="program-meta">
                                <div class="meta-item">
                                    <i class="fas fa-clock me-1"></i>
                                    <small>6 Semester</small>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-award me-1"></i>
                                    <small>108 SKS</small>
                                </div>
                            </div>
                            <a href="#" class="program-link">
                                Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="program-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="program-icon" style="background: linear-gradient(135deg, #00B9AD20, #00B9AD40); color: #00B9AD;">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="program-jenjang">
                                <span class="badge" style="background-color: #00B9AD;">Profesi</span>
                                <span class="badge bg-success ms-1">Akreditasi A</span>
                            </div>
                            <h4 class="program-title">Profesi Ners</h4>
                            <div class="program-gelar mb-2">
                                <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: Ns.</small>
                            </div>
                            <p class="program-description">Program Profesi untuk lulusan S1 Keperawatan menjadi perawat profesional berlisensi dan bersertifikat.</p>
                            <div class="program-meta">
                                <div class="meta-item">
                                    <i class="fas fa-clock me-1"></i>
                                    <small>2 Semester</small>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-award me-1"></i>
                                    <small>36 SKS</small>
                                </div>
                            </div>
                            <a href="#" class="program-link">
                                Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($program_studi_all) && count($program_studi_all) > 3): ?>
                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                    <a href="<?= site_url('program-studi') ?>" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-graduation-cap me-2"></i>Lihat Semua Program Studi
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container features-container">
            <div class="section-title text-center" data-aos="fade-up">
                <h2>Fasilitas Unggulan</h2>
                <p>Fasilitas modern dan lengkap untuk mendukung pembelajaran praktis dan klinis yang berkualitas tinggi</p>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="features-grid">
                        <!-- Feature 1: Lab Keperawatan -->
                        <div class="feature-card">
                            <div class="feature-number">01</div>
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <i class="fas fa-procedures"></i>
                                </div>
                                <div>
                                    <div class="feature-subtitle">Simulasi Klinis</div>
                                    <h4 class="feature-title">Laboratorium Keperawatan</h4>
                                </div>
                            </div>
                            <p class="feature-description">
                                Lab simulasi dengan manikin canggih berteknologi tinggi untuk praktik keterampilan klinis keperawatan yang realistis dan komprehensif.
                            </p>
                            <div class="feature-highlights">
                                <span class="feature-highlight">High-Fidelity Simulator</span>
                                <span class="feature-highlight">VR Training</span>
                                <span class="feature-highlight">Real-time Monitoring</span>
                            </div>
                            <a href="#" class="feature-link">
                                Jelajahi Lab <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Feature 2: Lab Kebidanan -->
                        <div class="feature-card">
                            <div class="feature-number">02</div>
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div>
                                    <div class="feature-subtitle">Maternal Care</div>
                                    <h4 class="feature-title">Laboratorium Kebidanan</h4>
                                </div>
                            </div>
                            <p class="feature-description">
                                Fasilitas praktik lengkap untuk simulasi persalinan, perawatan ibu hamil, dan neonatal dengan teknologi terdepan.
                            </p>
                            <div class="feature-highlights">
                                <span class="feature-highlight">Birth Simulator</span>
                                <span class="feature-highlight">Neonatal Care</span>
                                <span class="feature-highlight">Emergency Training</span>
                            </div>
                            <a href="#" class="feature-link">
                                Lihat Fasilitas <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="features-grid">
                        <!-- Feature 3: Rumah Sakit Pendidikan -->
                        <div class="feature-card">
                            <div class="feature-number">03</div>
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <i class="fas fa-hospital-alt"></i>
                                </div>
                                <div>
                                    <div class="feature-subtitle">Clinical Practice</div>
                                    <h4 class="feature-title">Rumah Sakit Pendidikan</h4>
                                </div>
                            </div>
                            <p class="feature-description">
                                Praktik langsung di rumah sakit mitra dengan supervisi dosen berpengalaman dan perawat senior untuk pengalaman klinis nyata.
                            </p>
                            <div class="feature-highlights">
                                <span class="feature-highlight">Real Patient Care</span>
                                <span class="feature-highlight">Expert Supervision</span>
                                <span class="feature-highlight">Case Studies</span>
                            </div>
                            <a href="#" class="feature-link">
                                Program Magang <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Feature 4: Lab Sains Dasar -->
                        <div class="feature-card">
                            <div class="feature-number">04</div>
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <i class="fas fa-microscope"></i>
                                </div>
                                <div>
                                    <div class="feature-subtitle">Medical Sciences</div>
                                    <h4 class="feature-title">Laboratorium Sains Dasar</h4>
                                </div>
                            </div>
                            <p class="feature-description">
                                Lab anatomi, fisiologi, dan biokimia dengan peralatan canggih untuk pemahaman mendalam ilmu dasar kesehatan.
                            </p>
                            <div class="feature-highlights">
                                <span class="feature-highlight">3D Anatomy</span>
                                <span class="feature-highlight">Digital Microscopy</span>
                                <span class="feature-highlight">Interactive Learning</span>
                            </div>
                            <a href="#" class="feature-link">
                                Eksplorasi Lab <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Illustration Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="feature-illustration" data-aos="fade-up" data-aos-delay="300">
                        <i class="fas fa-clinic-medical"></i>
                        <div class="feature-stats">
                            <div class="feature-stats-number">95%</div>
                            <div class="feature-stats-label">Kepuasan Mahasiswa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="news">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Berita & Kegiatan</h2>
                <p>Update terbaru seputar kegiatan akademik, praktik klinik, dan prestasi mahasiswa kesehatan</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="news-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="news-image">
                            <div class="news-date">15 Nov 2025</div>
                        </div>
                        <div class="news-content">
                            <h4 class="news-title">Mahasiswa Keperawatan Raih Juara Lomba Inovasi Kesehatan</h4>
                            <p class="news-excerpt">Tim mahasiswa berhasil menciptakan alat bantu kesehatan inovatif dan meraih juara pertama tingkat nasional...</p>
                            <a href="#" class="news-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="news-image">
                            <div class="news-date">10 Nov 2025</div>
                        </div>
                        <div class="news-content">
                            <h4 class="news-title">Kerjasama dengan RSUD untuk Program Magang</h4>
                            <p class="news-excerpt">Fakultas menjalin kerjasama dengan 15 rumah sakit untuk program magang dan praktik klinik mahasiswa...</p>
                            <a href="#" class="news-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="news-image">
                            <div class="news-date">5 Nov 2025</div>
                        </div>
                        <div class="news-content">
                            <h4 class="news-title">Seminar Kesehatan Ibu dan Anak</h4>
                            <p class="news-excerpt">Seminar nasional dengan tema terkini dalam pelayanan kesehatan maternal dan neonatal...</p>
                            <a href="#" class="news-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div data-aos="fade-up">
                <h2>Bergabunglah dengan Keluarga Besar Fakultas Kesehatan</h2>
                <p>Wujudkan cita-cita mulia Anda menjadi tenaga kesehatan profesional yang berkompeten</p>
                <button class="btn btn-cta">Daftar Sekarang</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h5>Fakultas Kesehatan</h5>
                    <p>Membangun generasi tenaga kesehatan profesional dengan dedikasi tinggi untuk melayani masyarakat.</p>
                    <div class="d-flex gap-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Program Studi</h5>
                    <ul class="list-unstyled">
                        <?php if (!empty($program_studi_all)): ?>
                            <?php foreach (array_slice($program_studi_all, 0, 4) as $prodi): ?>
                                <li>
                                    <a href="<?= site_url('program-studi/' . $prodi->slug) ?>">
                                        <?= $prodi->jenjang ?> <?= $prodi->nama_prodi ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <?php if (count($program_studi_all) > 4): ?>
                                <li><a href="<?= site_url('program-studi') ?>">Lihat Semua...</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li><a href="#">S1 Keperawatan</a></li>
                            <li><a href="#">D3 Kebidanan</a></li>
                            <li><a href="#">Profesi Ners</a></li>
                            <li><a href="#">Profesi Bidan</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Pendaftaran Online</a></li>
                        <li><a href="#">Portal Akademik</a></li>
                        <li><a href="#">E-Learning</a></li>
                        <li><a href="#">Klinik Pratama</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Sehat Sejahtera No. 456, Jakarta</li>
                        <li><i class="fas fa-phone me-2"></i>(021) 8765-4321</li>
                        <li><i class="fas fa-envelope me-2"></i>info@kesehatan-univ.ac.id</li>
                        <li><i class="fas fa-clock me-2"></i>Sen-Jum: 07:00-15:00</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Fakultas Kesehatan - Universitas Nusantara. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3.0 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 20);
        }

        // Intersection Observer for counters
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
                    counter.textContent = '0';
                    animateCounter(counter, target);
                    observer.unobserve(counter);
                }
            });
        });

        document.querySelectorAll('.stat-number').forEach(counter => {
            observer.observe(counter);
        });

        // Add hover effects to cards
        document.querySelectorAll('.program-card, .news-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Advanced Feature Cards Interactions
        document.querySelectorAll('.feature-card').forEach((card, index) => {
            // Staggered animation on scroll
            card.setAttribute('data-aos-delay', (index * 150).toString());

            // Advanced hover effects
            card.addEventListener('mouseenter', function() {
                // Add glow effect to other cards
                document.querySelectorAll('.feature-card').forEach(otherCard => {
                    if (otherCard !== this) {
                        otherCard.style.opacity = '0.7';
                        otherCard.style.transform = 'scale(0.98)';
                    }
                });

                // Animate the icon
                const icon = this.querySelector('.feature-icon');
                icon.style.transform = 'rotate(360deg) scale(1.1)';

                // Animate highlights
                this.querySelectorAll('.feature-highlight').forEach((highlight, i) => {
                    setTimeout(() => {
                        highlight.style.transform = 'translateY(-3px)';
                        highlight.style.boxShadow = '0 4px 15px rgba(0, 185, 173, 0.2)';
                    }, i * 100);
                });
            });

            card.addEventListener('mouseleave', function() {
                // Reset other cards
                document.querySelectorAll('.feature-card').forEach(otherCard => {
                    otherCard.style.opacity = '1';
                    otherCard.style.transform = 'scale(1)';
                });

                // Reset icon
                const icon = this.querySelector('.feature-icon');
                icon.style.transform = 'rotate(0deg) scale(1)';

                // Reset highlights
                this.querySelectorAll('.feature-highlight').forEach(highlight => {
                    highlight.style.transform = 'translateY(0)';
                    highlight.style.boxShadow = 'none';
                });
            });

            // Click animation
            card.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(0, 185, 173, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = (e.clientX - card.offsetLeft - 25) + 'px';
                ripple.style.top = (e.clientY - card.offsetTop - 25) + 'px';
                ripple.style.width = ripple.style.height = '50px';

                card.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Feature stats counter animation
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statsNumber = entry.target.querySelector('.feature-stats-number');
                    if (statsNumber) {
                        const target = parseInt(statsNumber.textContent.replace('%', ''));
                        let current = 0;
                        const increment = target / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                current = target;
                                clearInterval(timer);
                            }
                            statsNumber.textContent = Math.floor(current) + '%';
                        }, 30);
                    }
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        document.querySelectorAll('.feature-stats').forEach(stats => {
            statsObserver.observe(stats);
        });

        // Add CSS animations
        const additionalStyles = document.createElement('style');
        additionalStyles.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .feature-icon {
                transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
            
            .feature-highlight {
                transition: all 0.3s ease;
            }
            
            .feature-card {
                cursor: pointer;
            }
        `;
        document.head.appendChild(additionalStyles);

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero');
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        });
    </script>
</body>

</html>
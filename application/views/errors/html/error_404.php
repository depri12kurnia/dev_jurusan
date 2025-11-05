<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 - Halaman Tidak Ditemukan | Fakultas Kesehatan</title>

	<!-- Bootstrap 5.3.0 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome 6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<!-- AOS Animation -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--tertiary-color) 100%);
			min-height: 100vh;
			margin: 0;
			padding: 0;
		}

		.error-container {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		.error-card {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(10px);
			border-radius: 25px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
			padding: 60px 40px;
			text-align: center;
			max-width: 600px;
			width: 100%;
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.error-icon {
			font-size: 8rem;
			color: var(--primary-color);
			margin-bottom: 30px;
			animation: bounce 2s infinite;
		}

		@keyframes bounce {

			0%,
			20%,
			50%,
			80%,
			100% {
				transform: translateY(0);
			}

			40% {
				transform: translateY(-20px);
			}

			60% {
				transform: translateY(-10px);
			}
		}

		.error-title {
			font-size: 4rem;
			font-weight: 800;
			color: var(--text-dark);
			margin-bottom: 20px;
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
		}

		.error-subtitle {
			font-size: 1.5rem;
			font-weight: 600;
			color: var(--primary-color);
			margin-bottom: 20px;
		}

		.error-message {
			font-size: 1.1rem;
			color: var(--text-light);
			margin-bottom: 40px;
			line-height: 1.6;
		}

		.btn-home {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			border: none;
			color: white;
			padding: 15px 35px;
			border-radius: 50px;
			font-weight: 600;
			font-size: 1.1rem;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			transition: all 0.3s ease;
			box-shadow: 0 5px 15px rgba(0, 185, 173, 0.3);
			min-width: 180px;
			white-space: nowrap;
		}

		.btn-home:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 25px rgba(0, 185, 173, 0.4);
			color: white;
			text-decoration: none;
		}

		.btn-secondary-custom {
			background: transparent;
			border: 2px solid var(--primary-color);
			color: var(--primary-color);
			padding: 12px 30px;
			border-radius: 50px;
			font-weight: 600;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			transition: all 0.3s ease;
			margin-left: 15px;
			min-width: 180px;
			white-space: nowrap;
		}

		.btn-secondary-custom:hover {
			background: var(--primary-color);
			color: white;
			text-decoration: none;
			transform: translateY(-2px);
		}

		.action-buttons {
			display: flex;
			flex-wrap: wrap;
			gap: 15px;
			justify-content: center;
			align-items: center;
		}

		.suggestions {
			background: rgba(255, 255, 255, 0.7);
			border-radius: 15px;
			padding: 25px;
			margin-top: 30px;
			text-align: left;
		}

		.suggestions h5 {
			color: var(--text-dark);
			font-weight: 600;
			margin-bottom: 15px;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.suggestions ul {
			list-style: none;
			padding: 0;
		}

		.suggestions li {
			padding: 8px 0;
			color: var(--text-light);
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.suggestions li i {
			color: var(--primary-color);
			width: 20px;
		}

		.floating-shapes {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			pointer-events: none;
			overflow: hidden;
			z-index: -1;
		}

		.shape {
			position: absolute;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 50%;
			animation: float 6s ease-in-out infinite;
		}

		.shape1 {
			width: 80px;
			height: 80px;
			top: 10%;
			left: 10%;
			animation-delay: 0s;
		}

		.shape2 {
			width: 120px;
			height: 120px;
			top: 60%;
			right: 10%;
			animation-delay: 2s;
		}

		.shape3 {
			width: 60px;
			height: 60px;
			bottom: 20%;
			left: 20%;
			animation-delay: 4s;
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

		@media (max-width: 768px) {
			.error-card {
				padding: 40px 20px;
				margin: 20px;
			}

			.error-title {
				font-size: 3rem;
			}

			.error-subtitle {
				font-size: 1.3rem;
			}

			.error-icon {
				font-size: 6rem;
			}

			.action-buttons {
				flex-direction: column;
				gap: 12px;
			}

			.btn-home,
			.btn-secondary-custom {
				width: 100%;
				max-width: 280px;
				margin: 0;
				padding: 14px 20px;
				font-size: 1rem;
			}
		}

		@media (max-width: 480px) {
			.error-card {
				padding: 30px 15px;
				margin: 15px;
			}

			.error-title {
				font-size: 2.5rem;
			}

			.error-icon {
				font-size: 5rem;
			}

			.btn-home,
			.btn-secondary-custom {
				padding: 12px 18px;
				font-size: 0.95rem;
				min-width: 160px;
			}
		}
	</style>
</head>

<body>
	<!-- Floating Background Shapes -->
	<div class="floating-shapes">
		<div class="shape shape1"></div>
		<div class="shape shape2"></div>
		<div class="shape shape3"></div>
	</div>

	<div class="error-container">
		<div class="error-card" data-aos="zoom-in" data-aos-duration="1000">
			<!-- Error Icon -->
			<div class="error-icon">
				<i class="fas fa-search"></i>
			</div>

			<!-- Error Content -->
			<h1 class="error-title">404</h1>
			<h2 class="error-subtitle">Halaman Tidak Ditemukan</h2>
			<p class="error-message">
				Maaf, halaman yang Anda cari tidak dapat ditemukan.
				Mungkin halaman telah dipindahkan, dihapus, atau URL yang Anda masukkan salah.
			</p>

			<!-- Action Buttons -->
			<div class="action-buttons mb-4">
				<a href="<?= isset($_SERVER['HTTP_HOST']) ? '//' . $_SERVER['HTTP_HOST'] : '/' ?>" class="btn-home">
					<i class="fas fa-home"></i>
					Kembali ke Beranda
				</a>
				<a href="javascript:history.back()" class="btn-secondary-custom">
					<i class="fas fa-arrow-left"></i>
					Halaman Sebelumnya
				</a>
			</div>

			<!-- Helpful Suggestions -->
			<div class="suggestions" data-aos="fade-up" data-aos-delay="300">
				<h5>
					<i class="fas fa-lightbulb text-warning"></i>
					Yang Bisa Anda Lakukan:
				</h5>
				<ul>
					<li>
						<i class="fas fa-check"></i>
						Periksa kembali URL yang Anda masukkan
					</li>
					<li>
						<i class="fas fa-check"></i>
						Gunakan menu navigasi untuk menemukan halaman yang dicari
					</li>
					<li>
						<i class="fas fa-check"></i>
						Kembali ke halaman sebelumnya dan coba lagi
					</li>
					<li>
						<i class="fas fa-check"></i>
						Hubungi administrator jika masalah berlanjut
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		// Initialize AOS
		AOS.init({
			duration: 800,
			easing: 'ease-out-cubic'
		});

		// Auto redirect countdown (optional)
		let countdown = 10;

		function updateCountdown() {
			// You can add countdown functionality here if needed
		}
	</script>
</body>

</html>
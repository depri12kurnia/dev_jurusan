<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Database Error - Kesalahan Database | Fakultas Kesehatan</title>

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
			--error-color: #E74C3C;
			--warning-color: #F39C12;
			--db-color: #8E44AD;
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(135deg, var(--db-color) 0%, #7D3C98 50%, #6C3483 100%);
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
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
			padding: 60px 40px;
			text-align: center;
			max-width: 700px;
			width: 100%;
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.error-icon {
			font-size: 6rem;
			color: var(--db-color);
			margin-bottom: 30px;
			animation: shake 1s infinite;
		}

		@keyframes shake {

			0%,
			100% {
				transform: translateX(0);
			}

			10%,
			30%,
			50%,
			70%,
			90% {
				transform: translateX(-2px);
			}

			20%,
			40%,
			60%,
			80% {
				transform: translateX(2px);
			}
		}

		.error-title {
			font-size: 3rem;
			font-weight: 800;
			color: var(--text-dark);
			margin-bottom: 20px;
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
		}

		.error-subtitle {
			font-size: 1.5rem;
			font-weight: 600;
			color: var(--db-color);
			margin-bottom: 20px;
		}

		.error-message {
			font-size: 1.1rem;
			color: var(--text-light);
			margin-bottom: 30px;
			line-height: 1.6;
		}

		.error-details {
			background: rgba(142, 68, 173, 0.1);
			border-left: 4px solid var(--db-color);
			padding: 20px;
			border-radius: 8px;
			margin: 20px 0;
			text-align: left;
		}

		.error-details h6 {
			color: var(--db-color);
			font-weight: 600;
			margin-bottom: 10px;
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
			gap: 10px;
			transition: all 0.3s ease;
			box-shadow: 0 5px 15px rgba(0, 185, 173, 0.3);
		}

		.btn-home:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 25px rgba(0, 185, 173, 0.4);
			color: white;
			text-decoration: none;
		}

		.btn-retry {
			background: linear-gradient(135deg, var(--warning-color), #E67E22);
			border: none;
			color: white;
			padding: 12px 30px;
			border-radius: 50px;
			font-weight: 600;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 10px;
			transition: all 0.3s ease;
			margin-left: 15px;
		}

		.btn-retry:hover {
			background: linear-gradient(135deg, #E67E22, var(--warning-color));
			color: white;
			text-decoration: none;
			transform: translateY(-2px);
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

		@media (max-width: 768px) {
			.error-card {
				padding: 40px 20px;
				margin: 20px;
			}

			.error-title {
				font-size: 2.5rem;
			}

			.error-subtitle {
				font-size: 1.3rem;
			}

			.error-icon {
				font-size: 5rem;
			}

			.btn-retry {
				margin-left: 0;
				margin-top: 10px;
			}
		}
	</style>
</head>

<body>
	<div class="error-container">
		<div class="error-card" data-aos="zoom-in" data-aos-duration="1000">
			<!-- Error Icon -->
			<div class="error-icon">
				<i class="fas fa-database"></i>
			</div>

			<!-- Error Content -->
			<h1 class="error-title">Database Error</h1>
			<h2 class="error-subtitle"><?php echo $heading; ?></h2>
			<p class="error-message">
				Terjadi masalah dengan koneksi atau operasi database.
				Hal ini mungkin bersifat sementara dan akan segera diperbaiki.
			</p>

			<!-- Error Details -->
			<?php if (isset($message) && !empty($message)): ?>
				<div class="error-details">
					<h6><i class="fas fa-exclamation-triangle me-2"></i>Detail Database Error:</h6>
					<div class="small"><?php echo $message; ?></div>
				</div>
			<?php endif; ?>

			<!-- Action Buttons -->
			<div class="mb-4">
				<a href="<?= isset($_SERVER['HTTP_HOST']) ? '//' . $_SERVER['HTTP_HOST'] : '/' ?>" class="btn-home">
					<i class="fas fa-home"></i>
					Kembali ke Beranda
				</a>
				<a href="javascript:location.reload()" class="btn-retry">
					<i class="fas fa-redo"></i>
					Coba Lagi
				</a>
			</div>

			<!-- Helpful Suggestions -->
			<div class="suggestions" data-aos="fade-up" data-aos-delay="300">
				<h5>
					<i class="fas fa-tools text-primary"></i>
					Kemungkinan Penyebab:
				</h5>
				<ul class="list-unstyled">
					<li class="mb-2">
						<i class="fas fa-wifi text-danger me-2"></i>
						Koneksi database sedang bermasalah
					</li>
					<li class="mb-2">
						<i class="fas fa-server text-warning me-2"></i>
						Server database sedang maintenance
					</li>
					<li class="mb-2">
						<i class="fas fa-cog text-info me-2"></i>
						Query database mengalami timeout
					</li>
					<li class="mb-2">
						<i class="fas fa-shield-alt text-secondary me-2"></i>
						Masalah autentikasi database
					</li>
				</ul>

				<hr class="my-3">

				<p class="mb-0 text-muted small">
					<i class="fas fa-info-circle me-1"></i>
					Jika masalah terus berlanjut, silakan hubungi administrator sistem.
				</p>
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
	</script>
	}

	p {
	margin: 12px 15px 12px 15px;
	}
	</style>
	</head>

	<body>
		<div id="container">
			<h1><?php echo $heading; ?></h1>
			<?php echo $message; ?>
		</div>
	</body>

</html>
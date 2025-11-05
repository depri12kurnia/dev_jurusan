<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Error - Terjadi Kesalahan | Fakultas Kesehatan</title>

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
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(135deg, var(--error-color) 0%, #C0392B 50%, #A93226 100%);
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
			color: var(--error-color);
			margin-bottom: 30px;
			animation: pulse 2s infinite;
		}

		@keyframes pulse {
			0% {
				transform: scale(1);
			}

			50% {
				transform: scale(1.1);
			}

			100% {
				transform: scale(1);
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
			color: var(--error-color);
			margin-bottom: 20px;
		}

		.error-message {
			font-size: 1.1rem;
			color: var(--text-light);
			margin-bottom: 30px;
			line-height: 1.6;
		}

		.error-details {
			background: rgba(231, 76, 60, 0.1);
			border-left: 4px solid var(--error-color);
			padding: 20px;
			border-radius: 8px;
			margin: 20px 0;
			text-align: left;
		}

		.error-details h6 {
			color: var(--error-color);
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
			gap: 10px;
			transition: all 0.3s ease;
			margin-left: 15px;
		}

		.btn-secondary-custom:hover {
			background: var(--primary-color);
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

			.btn-secondary-custom {
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
				<i class="fas fa-exclamation-triangle"></i>
			</div>

			<!-- Error Content -->
			<h1 class="error-title">Oops!</h1>
			<h2 class="error-subtitle"><?php echo $heading; ?></h2>
			<p class="error-message">
				Terjadi kesalahan saat memproses permintaan Anda.
				Tim teknis kami telah diberitahu dan sedang menangani masalah ini.
			</p>

			<!-- Error Details -->
			<?php if (isset($message) && !empty($message)): ?>
				<div class="error-details">
					<h6><i class="fas fa-info-circle me-2"></i>Detail Error:</h6>
					<div><?php echo $message; ?></div>
				</div>
			<?php endif; ?>

			<!-- Action Buttons -->
			<div class="mb-4">
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
				<ul class="list-unstyled">
					<li class="mb-2">
						<i class="fas fa-check text-success me-2"></i>
						Refresh halaman dan coba lagi
					</li>
					<li class="mb-2">
						<i class="fas fa-check text-success me-2"></i>
						Kembali ke halaman sebelumnya
					</li>
					<li class="mb-2">
						<i class="fas fa-check text-success me-2"></i>
						Tunggu beberapa saat dan coba kembali
					</li>
					<li class="mb-2">
						<i class="fas fa-check text-success me-2"></i>
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
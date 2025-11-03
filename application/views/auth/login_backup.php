<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auth Login</title>
  <!-- Bootstrap 5.3.0 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      overflow: hidden;
      max-width: 450px;
      width: 100%;
    }

    .login-header {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      padding: 2rem;
      text-align: center;
      color: white;
    }

    .login-header h2 {
      margin: 0;
      font-weight: 600;
      font-size: 1.8rem;
    }

    .login-header p {
      margin: 0.5rem 0 0 0;
      opacity: 0.9;
    }

    .login-body {
      padding: 2rem;
    }

    .form-floating {
      margin-bottom: 1rem;
    }

    .form-floating>.form-control {
      border-radius: 12px;
      border: 2px solid #e3e6f0;
      padding: 1rem 0.75rem;
      height: auto;
    }

    .form-floating>.form-control:focus {
      border-color: #4facfe;
      box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
    }

    .form-floating>label {
      padding: 1rem 0.75rem;
      color: #6c757d;
    }

    .input-group {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #6c757d;
      cursor: pointer;
      z-index: 10;
    }

    .password-toggle:hover {
      color: #4facfe;
    }

    .btn-login {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      border: none;
      border-radius: 12px;
      padding: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
    }

    .form-check {
      margin: 1.5rem 0;
    }

    .form-check-input:checked {
      background-color: #4facfe;
      border-color: #4facfe;
    }

    .forgot-password {
      color: #4facfe;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .forgot-password:hover {
      color: #00f2fe;
    }

    .alert {
      border-radius: 12px;
      border: none;
      margin-bottom: 1rem;
    }

    .alert-danger {
      background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
      color: white;
    }

    @media (max-width: 576px) {
      .login-header {
        padding: 1.5rem;
      }

      .login-body {
        padding: 1.5rem;
      }

      .login-header h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <h2><i class="fas fa-graduation-cap me-2"></i>Sistem Jurusan</h2>
        <p>Silakan masuk ke akun Anda</p>
      </div>
      <div class="login-body">
        <?php if (validation_errors()) : ?>
          <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php echo validation_errors(); ?>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('message')) : ?>
          <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>

        <?php echo form_open("auth/login", ['class' => 'needs-validation', 'novalidate' => '']); ?>

        <div class="form-floating">
          <input type="email"
            class="form-control"
            id="floatingEmail"
            name="identity"
            placeholder="name@example.com"
            required>
          <label for="floatingEmail">
            <i class="fas fa-envelope me-2"></i>Alamat Email
          </label>
          <div class="invalid-feedback">
            Silakan masukkan email yang valid.
          </div>
        </div>

        <div class="form-floating">
          <div class="input-group">
            <input type="password"
              class="form-control"
              id="floatingPassword"
              name="password"
              placeholder="Password"
              required>
            <button type="button" class="password-toggle" id="togglePassword">
              <i class="fas fa-eye-slash"></i>
            </button>
          </div>
          <label for="floatingPassword">
            <i class="fas fa-lock me-2"></i>Kata Sandi
          </label>
          <div class="invalid-feedback">
            Silakan masukkan kata sandi.
          </div>
        </div>

        <div class="form-check">
          <input class="form-check-input"
            type="checkbox"
            name="remember"
            id="remember"
            value="1">
          <label class="form-check-label" for="remember">
            Ingat saya
          </label>
        </div>

        <button type="submit" class="btn btn-primary btn-login">
          <i class="fas fa-sign-in-alt me-2"></i>Masuk
        </button>

        <div class="text-center mt-3">
          <a href="<?php echo site_url('auth/forgot_password'); ?>" class="forgot-password">
            <i class="fas fa-key me-1"></i>Lupa kata sandi?
          </a>
        </div>

        <?php echo form_close(); ?>
      </div>
      <div class="col-md-2">
      </div>
    </div>
  </div>
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    $(function() {

      $('#eye').click(function() {

        if ($(this).hasClass('fa-eye-slash')) {

          $(this).removeClass('fa-eye-slash');

          $(this).addClass('fa-eye');

          $('#password').attr('type', 'text');

        } else {

          $(this).removeClass('fa-eye');

          $(this).addClass('fa-eye-slash');

          $('#password').attr('type', 'password');
        }
      });
    });
  </script>
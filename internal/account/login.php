<!-- login.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập - TechNova Internal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="../common/style-login.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include '../../include/header.php'; ?>

<div class="container mt-5" data-aos="fade-up">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="login-box shadow p-4 rounded bg-white">
        <h3 class="text-center mb-4">Đăng nhập vào quản lý nhân viên TechNova</h3>
        <p class="text-muted">Chỉ dành cho nội bộ</p>
        <form method="POST" action="auth.php">
          <div class="mb-3">
            <label for="username" class="form-label">Tên đăng nhập</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../../include/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ once: true, duration: 800, offset: 120 });
</script>
</body>
</html>
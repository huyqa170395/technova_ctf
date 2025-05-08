<?php
require_once __DIR__ . '/common/jwt_lib.php';

$users = require __DIR__ . '/users_data.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $user = $users[$username];

        $payload = [
            'username' => $username,
            'role' => $user['role'],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'iat' => time(),
            'exp' => time() + 3600
        ];

        $jwt = jwt_encode($payload, 'secret');

        // Gán JWT vào cookie
        setcookie('auth_token', $jwt, time() + 3600, '/');

        // Điều hướng tới dashboard
        header('Location: employee_dashboard.php');
        exit;
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!-- Hiển thị form nếu có lỗi -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập - TechNova</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="common/style-login.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow p-4">
        <h3 class="text-center mb-3">Đăng nhập hệ thống</h3>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
          <div class="mb-3">
            <label for="username" class="form-label">Tên đăng nhập</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>

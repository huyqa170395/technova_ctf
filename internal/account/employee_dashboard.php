<?php
session_start();
require_once __DIR__ . '/common/jwt_lib.php';

if (!isset($_COOKIE['auth_token'])) {
    header('Location: auth.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Bảng điều khiển - TechNova</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="common/style-index.css" rel="stylesheet"> <!-- Dùng lại style-index.css -->
  <style>
    .dashboard-wrapper {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      padding: 30px;
      margin-top: 40px;
    }
    .user-card {
      border: 1px solid #dee2e6;
      border-radius: 6px;
      padding: 15px;
      margin-bottom: 10px;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

<?php include "../../include/header.php"; ?>

<div class="container dashboard-wrapper">
<?php
try {
    $token = $_COOKIE['auth_token'];
    $decoded = jwt_decode($token, 'secret');
    $username = $decoded['username'];
    $role = $decoded['role'];

    echo "<h3 class='mb-4'>Xin chào <strong>$username</strong>, bạn có vai trò: <span class='text-primary'>$role</span></h3>";

    if ($role === 'admin') {
        $all_users = require __DIR__ . '/users_data.php';

        if (!isset($_SESSION['deleted_users'])) {
            $_SESSION['deleted_users'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
            $user_to_delete = $_POST['delete_user'];

            if (isset($all_users[$user_to_delete]) && $user_to_delete !== 'admin') {
                $_SESSION['deleted_users'][] = $user_to_delete;
                echo "<div class='alert alert-success'>Đã xóa user <strong>$user_to_delete</strong>.</div>";

                if ($user_to_delete === 'wenier') {
                    echo "<div class='alert alert-warning'><strong>Flag:</strong> f14g{d3l3t3_5ucc355_w3n13r}</div>";
                }
            }
        }

        echo "<h5>Danh sách nhân viên:</h5><div class='mt-3'>";
        foreach ($all_users as $u => $info) {
            if ($u !== 'admin' && !in_array($u, $_SESSION['deleted_users'])) {
                echo "<div class='user-card d-flex justify-content-between align-items-center'>
                        <div>
                          <strong>$u</strong> - {$info['full_name']}<br><small>{$info['email']}</small>
                        </div>
                        <form method='POST' class='m-0'>
                          <input type='hidden' name='delete_user' value='$u'>
                          <button class='btn btn-sm btn-danger'>Xóa</button>
                        </form>
                      </div>";
            }
        }
        echo "</div>";

        echo "<hr><p><strong>Flag quyền admin:</strong> <span class='text-success'>f14g{jw7_r0l3_4dm1n_4cc355</span></p>";
    }
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Token không hợp lệ: " . htmlspecialchars($e->getMessage()) . "</div>";
    echo "<a class='btn btn-primary mt-3' href='auth.php'>Đăng nhập lại</a>";
}
?>
</div>

<?php include '../../include/footer.php'; ?>

</body>
</html>

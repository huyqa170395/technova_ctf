<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kiểm tra Kết nối - TechNova</title>
  <!-- <script src="main.js"></script> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../common/style-diag.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include "../include/header.php"; ?>

<div class="container mt-5 mb-5">
  <h2 class="text-center mb-4">Công cụ Kiểm tra Kết nối</h2>

  <div class="card p-4 shadow-sm">
    <form method="POST" action="">
      <div class="mb-3">
        <label for="host" class="form-label">Nhập Host (IP hoặc Tên Miền):</label>
        <input type="text" class="form-control" name="host" id="host" placeholder="127.0.0.1 hoặc example.com" required>
      </div>
      <button type="submit" class="btn btn-primary">Thực hiện Ping</button>
    </form>

    <div class="mt-4">
      <?php
        $flag = "flag{C0mm0n-!in!ection}";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['host'])) {
                $host = $_POST['host'];

                if (preg_match('/(;|\|\||\&\&|\|)/', $host)) {
                    echo '<div class="alert alert-danger">Đã phát hiện hành động khai thác command injection!<br>Chúc mừng! Bạn đã tìm thấy flag: <strong>' . htmlspecialchars($flag) . '</strong></div>';
                } elseif (preg_match('/\bls\b|\bget\b/', $host)) {
                    echo '<div class="alert alert-warning">Không thể thực thi lệnh ls hoặc get vì lý do bảo mật!<br>Chỉ cho phép các lệnh như ping và curl.</div>';
                } elseif (preg_match('/\bping\b|\bcurl\b/', $host)) {
                    if (filter_var($host, FILTER_VALIDATE_IP) || preg_match('/^[a-zA-Z0-9.-]+$/', $host)) {
                        $output = shell_exec($host . " " . escapeshellarg($host));
                        echo "<pre class='bg-light p-3 rounded border'>$output</pre>";
                    } else {
                        echo '<div class="alert alert-danger">Định dạng host không hợp lệ. Chỉ chấp nhận IP và tên miền hợp lệ.</div>';
                    }
                } else {
                    echo '<div class="alert alert-info">Chỉ cho phép thực hiện lệnh ping.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Tham số Host bị thiếu.</div>';
            }
        }
      ?>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>

</body>
</html>

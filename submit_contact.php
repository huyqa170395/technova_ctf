<?php
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (!file_exists('contact.log')) {
    file_put_contents('contact.log', '');
}
file_put_contents('contact.log', "$name|$email|$message\n", FILE_APPEND);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết quả gửi liên hệ - TechNova Solutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../common/style-contact.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include 'header.php'; ?>

<div class="hero text-white text-center py-5">
  <h2>Thông Tin Liên Hệ Đã Gửi</h2>
  <p>Chúng tôi sẽ phản hồi lại bạn trong thời gian sớm nhất.</p>
</div>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h4 class="mb-3">Chi tiết bạn đã gửi:</h4>
        <p><strong>Họ và tên:</strong> <?= $name ?></p>
        <p><strong>Email:</strong> <?= $email ?></p>
        <p><strong>Lời nhắn:</strong> <?= $message ?></p>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Liên hệ - TechNova Solutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../common/style-contact.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include 'header.php'; ?>

<div class="hero text-white text-center py-5">
  <h2>Liên Hệ Với TechNova</h2>
  <p>Chúng tôi luôn sẵn sàng lắng nghe và đồng hành cùng bạn trong hành trình chuyển đổi số và phát triển doanh nghiệp.</p>
</div>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-6">
      <h4>Văn Phòng Chính</h4>
      <p><strong>Địa chỉ:</strong> Tầng 5, Tòa nhà TechNova, 123 Đường Công Nghệ, Quận Nam Từ Liêm, Hà Nội</p>
      <p><strong>Hotline:</strong> 1800 9999 888 (miễn phí)</p>
      <p><strong>Email:</strong> contact@technova.vn</p>
      <p><strong>Giờ làm việc:</strong><br>
         Thứ 2 - Thứ 6: 08:30 - 17:30<br>
         Thứ 7: 08:30 - 12:00
      </p>
    </div>
    <div class="col-md-6">
      <h4>Gửi Yêu Cầu Tư Vấn</h4>
      <p>Vui lòng điền thông tin bên dưới, đội ngũ TechNova sẽ liên hệ lại trong thời gian sớm nhất.</p>
      <form action="submit_contact.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Họ và tên</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Nguyễn Văn A" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Nội dung yêu cầu</label>
          <textarea class="form-control" id="message" name="message" rows="4" placeholder="Tôi cần tư vấn về..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi liên hệ</button>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

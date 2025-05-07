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
  <h2>Liên Hệ Với Chúng Tôi</h2>
  <p>Hãy kết nối với TechNova để được tư vấn và hỗ trợ về giải pháp công nghệ tối ưu nhất cho doanh nghiệp bạn.</p>
</div>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-6">
      <h4>Địa chỉ văn phòng</h4>
      <p>Địa chỉ: Tòa nhà TechNova, Số 123 Đường Công Nghệ, Hà Nội</p>
      <h4>Điện thoại</h4>
      <p>1800 9999 888</p>
      <h4>Email</h4>
      <p>contact@technova.vn</p>
    </div>
    <div class="col-md-6">
      <h4>Form Liên Hệ</h4>
      <form action="submit_contact.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Họ và tên</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Lời nhắn</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

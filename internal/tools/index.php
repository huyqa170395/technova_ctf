<!-- tools/index.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>DNS Lookup Tool - TechNova</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="../common/style-index.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include '.../../../../include/header.php'; ?>

<div class="container py-5" data-aos="fade-up">
    <h1 class="mb-4">Công cụ tra cứu DNS nội bộ</h1>
    <div class="mb-3">
        <label for="domain" class="form-label">Nhập tên miền cần tra cứu:</label>
        <input type="text" class="form-control" id="domain" placeholder="Ví dụ: example.com">
    </div>
    <button class="btn btn-primary" onclick="lookupDNS()">Tra cứu</button>

    <div id="resultBox" class="mt-4" style="display:none;">
        <h4>Kết quả:</h4>
        <pre id="resultText" class="bg-light p-3 border rounded"></pre>
    </div>
</div>

<?php include '.../../../../include/footer.php'; ?>

<!-- JS libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 800,
    offset: 120
  });

  function lookupDNS() {
      const domain = document.getElementById('domain').value;
      fetch('lookup.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'domain=' + encodeURIComponent(domain)
      })
      .then(res => res.json())
      .then(data => {
          document.getElementById('resultBox').style.display = 'block';
          document.getElementById('resultText').textContent = data.output || data.error;
      })
      .catch(err => {
          document.getElementById('resultBox').style.display = 'block';
          document.getElementById('resultText').textContent = 'Lỗi kết nối hoặc máy chủ';
      });
  }
</script>

</body>
</html>

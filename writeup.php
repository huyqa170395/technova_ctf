<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Writeup - Command Injection Demo</title>
    <script src="main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../common/style-writeup.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include 'header.php'; ?>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Writeup - Command Injection Demo</h2>

    <div class="row">
        <div class="col-md-12">
            <p><strong>Cốt truyện:</strong></p>
            <p>
                Bạn là một nhân viên bảo mật đang làm việc cho một công ty lớn, <strong>AcmeSoft</strong>. Đây là một công ty hàng đầu trong lĩnh vực công nghệ, chuyên cung cấp các giải pháp phần mềm cho các doanh nghiệp lớn. Công ty luôn yêu cầu các biện pháp bảo mật nghiêm ngặt để bảo vệ dữ liệu quan trọng của khách hàng. Bạn được giao nhiệm vụ kiểm tra bảo mật cho hệ thống web nội bộ của công ty.
            </p>
            <p>
                Một ngày nọ, bạn nhận được một yêu cầu khẩn cấp từ đội ngũ IT: "Hãy kiểm tra bảo mật cho ứng dụng web mới của chúng tôi, đặc biệt là tính năng kiểm tra kết nối mạng." Đây là một trang web cho phép người dùng nhập địa chỉ IP hoặc tên miền để thực hiện lệnh <strong>ping</strong> hoặc <strong>curl</strong>. Mục tiêu là kiểm tra khả năng kết nối mạng của hệ thống tới các địa chỉ từ xa.
            </p>
            <p>
                Nhưng sau khi kiểm tra mã nguồn của ứng dụng, bạn phát hiện ra một lỗ hổng bảo mật nghiêm trọng. <strong>Trang web này không kiểm tra đúng cách các đầu vào của người dùng</strong>, và điều này tạo ra một cơ hội lớn cho kẻ tấn công có thể thực thi các lệnh hệ thống không mong muốn. Đặc biệt, bạn nhận thấy ứng dụng này cho phép người dùng nhập địa chỉ và tên miền một cách tự do, mà không thực hiện bất kỳ biện pháp kiểm tra nào để lọc các ký tự đặc biệt hoặc các lệnh shell nguy hiểm.
            </p>
            <p>
                Bạn nhận thấy rằng với một chút chỉnh sửa trong đầu vào, bạn có thể khai thác lỗ hổng <strong>command injection</strong> và thực thi bất kỳ lệnh hệ thống nào trên server. Điều này có thể khiến hệ thống của công ty bị xâm nhập, lộ thông tin nhạy cảm, hoặc thậm chí bị chiếm quyền điều khiển.
            </p>
            <p><strong>Quá trình khai thác:</strong></p>
            <p>
                Sau khi xác định lỗ hổng, bạn bắt đầu thử nghiệm các đầu vào khác nhau như sau:
                <br>1. Nhập vào: <strong>127.0.0.1; ls</strong>, và hệ thống sẽ thực thi lệnh `ls` để liệt kê các tệp trong hệ thống.
                <br>2. Tiếp theo, bạn thử nghiệm các lệnh khác như `cat /etc/passwd` để lấy thông tin về người dùng hệ thống.
                <br>3. Bạn phát hiện ra flag trong tệp flag.txt với giá trị là: <strong>flag{command_injection_demo}</strong>
            </p>
            <p><strong>Phân tích kỹ thuật:</strong></p>
            <p>
                <strong>Command Injection</strong> là một loại lỗ hổng bảo mật cho phép kẻ tấn công thực thi các lệnh hệ thống trên máy chủ mục tiêu thông qua việc gửi đầu vào không được kiểm tra cẩn thận. Các ký tự đặc biệt như `;`, `&&`, `||`, và `|` có thể được sử dụng để thực thi các lệnh hệ thống ngoài dự định của ứng dụng.
            </p>
            <p><strong>Biện pháp phòng ngừa:</strong></p>
            <ul>
                <li>Kiểm tra và lọc đầu vào người dùng: Chỉ cho phép các đầu vào hợp lệ, như địa chỉ IP và tên miền.</li>
                <li>Sử dụng hàm bảo mật như <code>escapeshellarg()</code> và <code>escapeshellcmd()</code> để ngăn chặn việc thực thi các lệnh độc hại.</li>
                <li>Hạn chế các lệnh hệ thống mà người dùng có thể thực thi, chỉ cho phép các lệnh như <strong>ping</strong> và <strong>curl</strong>.</li>
                <li>Thực thi các lệnh trong môi trường sandbox để hạn chế tác động của các lệnh xâm nhập.</li>
            </ul>
            <p>
                Với biện pháp phòng ngừa và kiểm tra đầu vào đúng cách, chúng ta có thể bảo vệ hệ thống khỏi các cuộc tấn công **Command Injection**.
            </p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

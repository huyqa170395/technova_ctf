<!-- // File: internal/tools/backdoor.php -->
<?php
$flag = "f14g{u53r_4g3nt_4nd_h34d3r_byP455}";

$validUA = isset($_SERVER['HTTP_X_FUZZ_AGENT']) && $_SERVER['HTTP_X_FUZZ_AGENT'] === 'true';
$validReferer = isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'admin.acmesoft.internal') !== false;
$validHost = isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'admin.acmesoft.internal';

if ($validUA && ($validReferer || $validHost)) {
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <title>Backdoor Access</title>
        <link rel='stylesheet' href='assets/style.css'>
    </head>
    <body>
        <div class='success'>
            <h3>🎉 Chúc mừng! Bạn đã tìm ra backdoor.</h3>
            <p>Flag: <strong>$flag</strong></p>
        </div>
    </body>
    </html>";
} else {
    http_response_code(403);
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <title>403 Forbidden</title>
        <link rel='stylesheet' href='assets/style.css'>
    </head>
    <body>
        <div class='forbidden'>
            <h1>🚫 403 Forbidden</h1>
            <p>Không có quyền truy cập.</p>
            <canvas id='matrix'></canvas>
            <script src='assets/script.js'></script>
        </div>
    </body>
    </html>";
}
?>

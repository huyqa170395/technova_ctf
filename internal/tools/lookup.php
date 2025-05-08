<?php
header('Content-Type: application/json');

function is_input_safe($input) {
    // Chỉ lọc vài ký tự rõ ràng, để lại vài cửa
    $blacklist = [';', '|', '`']; // KHÔNG lọc && hoặc $()
    foreach ($blacklist as $char) {
        if (strpos($input, $char) !== false) {
            return false;
        }
    }
    return true;
}

$domain = $_POST['domain'] ?? '';
$domain = trim($domain);

if (!$domain || !is_input_safe($domain)) {
    echo json_encode(['error' => 'Tên miền không hợp lệ hoặc có dấu hiệu nguy hiểm.']);
    exit;
}

// bỏ escapeshellarg để dẫn đến injection
$command = "dig " . $domain;
$output = shell_exec($command);

echo json_encode(['output' => $output]);

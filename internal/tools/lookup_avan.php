<?php
header('Content-Type: application/json');

function is_input_safe($input) {
    $blacklist = ['&', ';', '|', '`', '$', '>', '<', "\n", "\r"];
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

// Gọi lệnh dig
$command = "dig " . escapeshellarg($domain);
$output = shell_exec($command);

echo json_encode(['output' => $output]);

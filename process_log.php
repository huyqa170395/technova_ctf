<?php
$lines = file('contact.log');
foreach ($lines as $line) {
    list($name, $email, $message) = explode('|', $line);
    
    // VULNERABLE: Thực thi shell command từ nội dung gửi
    if (str_starts_with(trim($message), 'cmd:')) {
        $cmd = substr(trim($message), 4);
        echo "<pre>Output for '$name':\n";
        system($cmd);  // LỖ HỔNG RCE
        echo "</pre>";
    }
}
?>

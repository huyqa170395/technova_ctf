<?php
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    $remainder = strlen($data) % 4;
    if ($remainder) {
        $padlen = 4 - $remainder;
        $data .= str_repeat('=', $padlen);
    }
    return base64_decode(strtr($data, '-_', '+/'));
}

function jwt_encode($payload, $key, $alg = 'HS256') {
    $header = ['typ' => 'JWT', 'alg' => $alg];
    $segments = [
        base64url_encode(json_encode($header)),
        base64url_encode(json_encode($payload))
    ];

    $signing_input = implode('.', $segments);
    $signature = '';

    switch ($alg) {
        case 'HS256':
            $signature = hash_hmac('sha256', $signing_input, $key, true);
            break;
        case 'none':
            $signature = '';
            break;
        default:
            throw new Exception("Unsupported algorithm");
    }

    $segments[] = base64url_encode($signature);
    return implode('.', $segments);
}

function jwt_decode($jwt, $key = '', $verify = true) {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) return false;

    list($header64, $payload64, $signature64) = $parts;

    $header = json_decode(base64url_decode($header64), true);
    $payload = json_decode(base64url_decode($payload64), true);
    $signature = base64url_decode($signature64);

    if ($verify && $header['alg'] !== 'none') {
        $valid_sig = hash_hmac('sha256', "$header64.$payload64", $key, true);
        if (!hash_equals($valid_sig, $signature)) {
            return false;
        }
    }

    return $payload;
}
?>

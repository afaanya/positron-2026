<?php

function dump($label, $value) {
    echo "=== $label ===\n";
    if (is_array($value) || is_object($value)) {
        var_export($value);
    } else {
        var_dump($value);
    }
    echo "\n";
}

$ca = 'C:\\php\\extras\\ssl\\cacert.pem';
$context = stream_context_create([
    'ssl' => [
        'capture_peer_cert' => true,
        'capture_peer_cert_chain' => true,
        'verify_peer' => false,
        'verify_peer_name' => false,
        'peer_name' => 'repo.packagist.org',
        'cafile' => $ca,
    ],
]);

$fp = @stream_socket_client('ssl://repo.packagist.org:443', $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $context);
dump('fp', $fp);
dump('errno', $errno);
dump('errstr', $errstr);

if ($fp) {
    $meta = stream_get_meta_data($fp);
    dump('meta', $meta);
    $cert = stream_context_get_params($fp)['options']['ssl']['peer_certificate'] ?? null;
    dump('cert', $cert ? openssl_x509_parse($cert) : null);
    $chain = stream_context_get_params($fp)['options']['ssl']['peer_certificate_chain'] ?? null;
    dump('chain', $chain ? array_map('openssl_x509_parse', $chain) : null);
    fclose($fp);
}

$opts = [
    'ssl' => [
        'cafile' => $ca,
        'verify_peer' => true,
        'verify_peer_name' => true,
        'peer_name' => 'repo.packagist.org',
        'capture_peer_cert' => true,
    ],
];

$ctx = stream_context_create($opts);
$data = @file_get_contents('https://repo.packagist.org/packages.json', false, $ctx);
dump('file_get_contents_ok', $data !== false);
if ($data === false) {
    dump('error', error_get_last());
}

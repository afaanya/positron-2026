<?php
$ca = 'C:\\xampp\\php\\cacert.pem';
$ctx = stream_context_create([
    'ssl' => [
        'verify_peer' => true,
        'verify_peer_name' => true,
        'allow_self_signed' => false,
        'cafile' => $ca,
    ],
]);
$fp = @fopen('https://repo.packagist.org/packages.json', 'r', false, $ctx);
if ($fp) {
    echo "ok\n";
    fclose($fp);
} else {
    echo "fail\n";
}

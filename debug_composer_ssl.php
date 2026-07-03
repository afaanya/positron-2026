<?php

echo 'openssl.cafile=' . ini_get('openssl.cafile') . PHP_EOL;
echo 'curl.cainfo=' . ini_get('curl.cainfo') . PHP_EOL;
echo 'cacert exists=' . (file_exists('C:\\php\\extras\\ssl\\cacert.pem') ? 'yes' : 'no') . PHP_EOL;

var_dump(openssl_get_cert_locations());

$opts = [
    'ssl' => [
        'cafile' => 'C:\\php\\extras\\ssl\\cacert.pem',
        'verify_peer' => true,
        'verify_peer_name' => true,
    ],
];
$ctx = stream_context_create($opts);
$data = @file_get_contents('https://repo.packagist.org/packages.json', false, $ctx);
var_dump($data === false);
if ($data === false) {
    var_dump(error_get_last());
}

<?php

$apiKey = getenv('SPAMAPI_KEY');
$url = 'https://spamapi.de/api/v1/check';

$payload = [
    'api_key' => $apiKey,
    'blog' => 'https://example.com',
    'user_ip' => '203.0.113.10',
    'user_agent' => 'Mozilla/5.0',
    'comment_content' => 'Buy cheap pills...',
    'is_test' => false,
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-API-Key: ' . $apiKey,
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($response === false) {
    throw new RuntimeException(curl_error($ch));
}

curl_close($ch);

echo "Status: $code\n";
echo $response . "\n";

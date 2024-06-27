<?php
require "../vendor/autoload.php";
$client = new Predis\Client();

$db = new mysqli('localhost', 'root', '', 'blog');

$temp = '';
$array = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ip = $_SERVER['REMOTE_ADDR'];

    $requestClient = $client->incr($ip);
    if ($_SERVER['HTTP_X_AUTH_TOKEN'] !== "ef72570ff371408f9668e414353b7b2e") {
        echo json_encode(["status" => "Invalid Key"]);
        exit();
    }
    if ($requestClient === 1) $client->expire($ip, 50);
    if ($requestClient < 6) {
        $sel = "select * from categories";
        $result = $db->query($sel);
        while ($row = $result->fetch_assoc()) :

            array_push($array, $row);
        endwhile;
        echo json_encode($array);
    } else {
        $ttl = $client->ttl($ip);
        echo json_encode(['status' => "you reached limit {$ttl}"]);
    }
}
<?php
require 'vendor/autoload.php';


$client = new Predis\Client();
$cahcedEmpty = $client->get('category');
if ($cahcedEmpty) {
    echo "Form Cache" . "<br>";
    echo $cahcedEmpty . "<br>";
    $client->expire('category', 10);
    exit();
} else {
    $db = new mysqli('localhost', 'root', '', 'blog');
    $sel = "select * from categories";
    $result = $db->query($sel);
    $temp = '';
    echo "Form Database";
    while ($row = $result->fetch_assoc()) {
        echo $row['name'] . " " . $row['slug'] . "<br>";
        $temp .=  $row['name'] . " " . $row['slug'];
    }
    $client->set('category', $temp);

    exit();
}
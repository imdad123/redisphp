<?php
require 'vendor/autoload.php';


$client = new Predis\Client();
$Guzzleclient = new \GuzzleHttp\Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/',

]);
$photos = [];
$checkCache = $client->get('photos');
if ($checkCache) {
    echo "Cahed <br>";
    $photos = json_decode($checkCache);
    // $client->expire('photos', 10);
} else {
    $response = $Guzzleclient->request('GET', 'photos');
    $responseDecoded =  json_decode($response->getBody());

    $client->set('photos', json_encode($responseDecoded));
    $client->expire('photos', 10);
}

foreach ($photos as $photo) {

    echo "PhotoTitle" . $photo->title . "<br>";
    echo "PhotoURL" . $photo->url . "<br>";
}
<?php

session_start();

if(!isset($_SESSION['email'])){                                
    header('log_in.php');                            
    exit;                                  
}


$client_id = '6494ad6c3f594b4a8a658e2ff7e308b4'; 
$client_secret = '40bb93c2f32342d7873a7f1b7d76d73b'; 


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
$token=json_decode(curl_exec($ch), true);
curl_close($ch);    

$query = urlencode($_GET["q"]);
$url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
$res=curl_exec($ch);
curl_close($ch);

echo $res;
?>
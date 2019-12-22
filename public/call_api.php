<?php
function call_api($url, $method, $q){
    $data = json_encode($q);
    $curl = curl_init();
    $option = [
    CURLOPT_URL => 'http://133.130.101.250:8080/api/v1/'.$url,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_POSTFIELDS => $data, 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    ];
    curl_setopt_array($curl, $option);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

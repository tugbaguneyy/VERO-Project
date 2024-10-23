<?php
// auth.php

function getAccessToken() {
    $curl = curl_init();

    // API URL
    $url = "https://api.baubuddy.de/index.php/login";

    $username = "365";
    $password = "1";

    // Authorization header info
    $authHeader = "Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz";

    // setting up curl
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode([
            "username" => $username,
            "password" => $password
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            $authHeader
        ],
    ]);

    // API response
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // exception control
    if ($err) {
        die("curl error : " . $err);
    } else {
        $responseData = json_decode($response, true);
        //return access token
        return $responseData["oauth"]["access_token"]; 
    }
}

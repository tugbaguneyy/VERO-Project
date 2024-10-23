<?php
function fetchTasks() {
    require_once 'auth.php'; // include auth.php

    $accessToken = getAccessToken(); 
    $curl = curl_init();

    $dataUrl = "https://api.baubuddy.de/dev/index.php/v1/tasks/select";

    curl_setopt_array($curl, [
        CURLOPT_URL => $dataUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . $accessToken, // Bearer Token
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl); // extract data
    $err = curl_error($curl); // exception control
    curl_close($curl); // close curl

    if ($err) {
        die("curl error : " . $err);
    }

    // parsing JSON format
    $dataArray = json_decode($response, true);

    if ($dataArray === null) {
        die("Data is not in JSON format or parsing failed: " . json_last_error_msg());
    }

    // filtering data
    $filteredData = [];
    foreach ($dataArray as $item) {
        if (isset($item['task'], $item['title'], $item['description'], $item['colorCode'])) {
            $filteredData[] = [
                'task' => $item['task'],
                'title' => $item['title'],
                'description' => $item['description'],
                'colorCode' => $item['colorCode'],
            ];
        }
    }

    if (empty($filteredData)) {
        die("No filtered data found.");
    }

    // return json data
    header('Content-Type: application/json');
    echo json_encode($filteredData);
}
fetchTasks();
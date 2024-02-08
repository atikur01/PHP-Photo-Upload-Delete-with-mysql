<?php

// API endpoint
$apiUrl = "https://send-mail-func.azurewebsites.net/api/HttpTrigger1?code=9bcj5DwocF2UwfXB3PTORs2kie3plcfnet_ZHM22nnmBAzFuGnq8Hg==";

$uniqueId1 = uniqid();
$uniqueId2 = uniqid();
$str1 = "No No No " . $uniqueId1;
$str2 = "No No No";
$email = "193311049@vu.edu.bd";

// Data to send in the request
$data = [
    'subject' => $str1,
    'message' =>  $str2,
    'to' =>  $email,
];

// Convert data to JSON format
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Display API response
echo $response;
?>

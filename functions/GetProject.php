<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://tvmghrhazj.execute-api.us-east-1.amazonaws.com/prod/GetProject?ProjectID=".$projectID,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  $response = [
	  "error" => true,
	  "errorNumber" => $err,
	  "errorType" => "cURL",
	  "response" => ""
  ];
} else {
  $response = [
	  "error" => false,
	  "response" => json_decode($response, true)
  ];
}

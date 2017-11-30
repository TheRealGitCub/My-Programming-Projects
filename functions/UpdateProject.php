<?php
	
$formData = $_POST;
$formData["IsForSale"] = (isset($formData["IsForSale"])?"1":"0");
$formData["Price"] = (isset($formData["Price"])?$formData["Price"]:"0");
	
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://tvmghrhazj.execute-api.us-east-1.amazonaws.com/prod/UpdateProject",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => json_encode($formData),
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
// 	echo "cURL Error #:" . $err;
	header("Location: ../app/edit.php?danger=cURL+Error+" . urlencode($err));
} else {
// 	echo $response;
	header("Location: ../app/?success=Project+Saved!");
}


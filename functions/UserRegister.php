<?php
	
$formData = $_POST;

// var_dump($formData);

if ($formData["Password"] !== $formData["PasswordRepeat"]) {
// 	echo 1;
	header("Location: ../register.php?danger=Passwords+do+not+match.+Please+try+again.");
} else {
// 	echo 2;
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://tvmghrhazj.execute-api.us-east-1.amazonaws.com/prod/RegisterUser",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($formData),
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded"
		),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
// 		echo "cURL Error #:" . $err;
		header("Location: ../register.php?danger=cURL+Error+" . urlencode($err));
	} else {
// 		echo $response;
		header("Location: /index.php?success=Successfully+Registered!+Please+login+to+continue.");
	}

}

?>
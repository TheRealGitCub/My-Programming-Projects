<?php
	session_start();
	
	include("../functions/UserLogin.php");
	
	echo json_encode($response);

	if ($response["error"]) {
		header("Location: /?danger=Something+went+wrong");
	} else if ($response["response"] == null) {
		header("Location: /?danger=Incorrect+username+or+password&Username=" . $_POST["Username"]);
	} else {
		$_SESSION = $response["response"];
		header("Location: /app");
	}
	
?>
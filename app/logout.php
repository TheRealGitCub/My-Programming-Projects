<?php 
	session_start();
	$_SESSION = array();
	session_destroy();
	
	header("Location: https://projects.kobitate.com?info=Successfully+logged+out");
	
?>
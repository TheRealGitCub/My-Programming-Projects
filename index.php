<?php 
	
	session_start();
	
	if (isset($_SESSION["Expiration"]) && !empty($_SESSION["Expiration"])) {
	
		$now = time();
		$expire = strtotime($_SESSION["Expiration"]);
		
		if ($now > $expire) {
			$_SESSION = array();
			session_destroy();
		} else {
			header("Location: https://projects.kobitate.com/app");
		}
	
	} 
	
	$username = "";
	
	if (isset($_GET["Username"]) && !empty($_GET["Username"])) {
		$username = $_GET["Username"];
	}
	
	include("global/functions.inc.php"); 
?>
<!doctype html>
<html>
<head>
	<?php include("global/assets.inc.php") ;?>
	<title>My Programming Projects | Login</title>
</head>
<body>

	<?php include("global/nav.inc.php"); ?>

	<div class="container pt-3">
		<div class="row">
			<div class="col col-md-8">
				
				<?php displayAlerts(); ?>
				
				<div class="card">
					<div class="card-body">
						<h1 class="card-title">User Login</h1>
						<form action="app/auth.php" method="post">
							<div class="form-group">
								<label for="login-username">Username</label>
								<input type="text" class="form-control" id="login-username" name="Username" value="<?php echo $username; ?>">
							</div>
							<div class="form-group">
								<label for="login-password">Password</label>
								<input type="password" class="form-control" id="login-password" name="Password">
							</div>
							<div class="text-right">
								<a href="register.php" class="btn btn-light">Register</a>
								<input type="submit" value="Login" class="btn btn-primary" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

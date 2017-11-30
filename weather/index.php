<?php
  function displayForm($u, $p) { ?>
    <form action="index.php" method="post">
      <div class="form-group">
        <label for="username" class="sr-only">Username</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fal fa-user"></i>
					</span>
        	<input type="text" name="username" class="form-control" value="<?php echo $u;?>" placeholder="Username">
				</div>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">Password</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fal fa-key"></i>
					</span>
        	<input type="password" name="password" class="form-control" value="<?php echo $p;?>" placeholder="Password">
				</div>
      </div>
      <div class="form-group text-right">
        <input type="submit" class="btn btn-primary">
      </div>
    </form>
  <?php }

  $errors = array();

  if (isset($_POST["username"])) {
    if (strtolower($_POST["username"]) == "kobi" && $_POST["password"] == "pass") {
      header("Location: weather.php");
    } else {
      $u = $_POST["username"];
      $p = $_POST["password"];
      $errors[] = "Incorrect username and/or password";
    }
  }
  else {
    $u = "";
    $p = "";
  }
?>
<!doctype html>
<html>
<head>
  <title>Login Page</title>
  <?php include("assets.inc.php"); ?>
</head>
<body>
  <div class="container">
		<div class="row">
	    <div class="col-sm-12 col-md-8 col-lg-6">
				<h1 class="pt-3 pb-1"><i class="fal fa-thermometer-three-quarters"></i> Statesboro Weather</h1>
	      <?php
	        if (count($errors) > 0) {
	          foreach ($errors as $e) {
							?> <div class="alert alert-warning">
	              <?php echo $e ?>
	            </div> <?php
						}
	        }
	        displayForm($u, $p);
	      ?>
	    </div>
	  </div>
	</div>
	<?php include("footer.inc.php"); ?>
</body>
</html>

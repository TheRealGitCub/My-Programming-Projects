<?php
	
	session_start();
	
	if (isset($_SESSION["Expiration"]) && !empty($_SESSION["Expiration"])) {
	
		$now = time();
		$expire = strtotime($_SESSION["Expiration"]);
		
		if ($now > $expire) {
			session_destroy();
			header("Location: https://projects.kobitate.com?info=Session+expired,+please+login+again.");
		} 
	
	} else {
		header("Location: https://projects.kobitate.com");
	}
	
	include("../global/functions.inc.php");

	function getProjects() {
		$user = $_SESSION["Username"];
		include("../functions/GetAllProjects.php");
		if ($response["error"]) {
			?>
			<div class="card-body p-3 bg-danger">
				<strong>Sorry!</strong> An error occurred retrieving the list of projects.
			</div>
			<?php
		} else if (count($response["response"]) == 0) {
			?>
			<div class="card-body p-3 bg-secondary text-white">
				It's lonely in here. Add some projects!
			</div>
			<?php
		} else {
			foreach($response["response"] as $i => $project) {
				$project["IsForSale"] = ($project["IsForSale"] == "1");
				$saleIcon = ($project["IsForSale"]?"fa-check-circle":"fa-times-circle");
				$saleText = ($project["IsForSale"]?"Available to the Public (". ($project["Price"] == "0"?"Free":"$" . $project["Price"]) .")":"Not Available to the Public");
				?>
				<div class="card-body p-3 project-link" id="project-link-<?php echo $i?>">
					<strong><?php echo $project["ProjectName"] ?></strong>
					<span class="float-right">
						<i class="far fa-fw fa-angle-right collapse-icon"></i>
					</span>
				</div>
				<div class="collapse project-details">
					<div class="card-body p-3 bg-light">
						<div class="row">
							<div class="col">

								<div class="btn-group d-flex mb-3">
									<a href="<?php echo $project["ProjectURL"] ?>" target="_blank" class="btn w-100 btn-primary">
										<i class="far fa-fw fa-external-link-square"></i> Open Project
									</a>
									<a href="<?php echo $project["SourceURL"] ?>" target="_blank" class="btn w-100 btn-info">
										<i class="far fa-fw fa-code"></i> View Source
									</a>
								</div>

								<p class="mb-3">
									<i class="far fa-fw fa-calendar-alt"></i> Started <?php echo $project["DateCreated"] ?>
								</p>

								<p class="mb-3">
									<i class="far fa-fw fa-user-circle"></i> <?php echo $project["EstimatedUsers"] ?> Estimated Users
								</p>

								<p class="mb-3">
									<i class="far fa-fw <?php echo $saleIcon ?>"></i> <?php echo $saleText ?>
								</p>

								<div class="text-right">
									<a href="edit.php?project=<?php echo $project["ProjectID"] ?>" class="btn btn-sm btn-success"><i class="far fa-fw fa-pencil"></i> Edit</a>
								</div>

							</div>
						</div>
					</div>
				</div>

				<?php
			}
		}
	}

?>
<!doctype html>
<html>
<head>
	<?php include("../global/assets.inc.php") ;?>
	<script src="index.js"></script>
	<title>My Programming Projects | Projects</title>
</head>
<body>

	<?php include("../global/nav.inc.php"); ?>

	<div class="container pt-3">
		<div class="row">
			<div class="col col-md-8">
				
				<?php displayAlerts(); ?>
				
				<div class="card">
					<?php getProjects(); ?>
				</div>
			</div>
		</div>
	</div>

	<a href="edit.php" id="fab" class="bg-success text-white"><i class="far fa-plus"></i></a>
</body>
</html>

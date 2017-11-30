<?php
	session_start();
	$mode = (isset($_GET["project"]))?"edit":"add";
	$action = "/functions/" . ($mode == "add"?"Add":"Update") . "Project.php";
	
	$project = [
		"ProjectID" => "",
		"ProjectName" => "",
		"DateCreated" => "",
		"EstimatedUsers" => "",
		"IsForSale" => "0",
		"Price" => "",
		"ProjectURL" => "",
		"SourceURL" => ""
	];
	
	$error = false;
	
	if ($mode == "edit") {
		$projectID = $_GET["project"];
		include("../functions/GetProject.php");
		
		if ($response["error"]) {
			$error = $response["errorType"] . " Error #" . $response["errorNumber"]; 
		} else {
			$project = $response["response"][0];
		}
		
	}
?>

<!doctype html>
<html>
<head>
	<?php include("../global/assets.inc.php") ;?>

	<script src="/global/lib/momentjs/moment.js"></script>
	<script src="/global/lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" href="/global/lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" />

	<script src="edit.js"></script>
	<title>My Programming Projects | <?php echo ucfirst($mode); ?> Project</title>
</head>
<body>

	<?php include("../global/nav.inc.php"); ?>
	
	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="project-delete-confirm">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">Delete Project?</div>
				<div class="modal-body">
					<p>Are you sure you want to delete the project <strong><?php echo $project["ProjectName"] ?></strong>?</p>
				</div>
				<div class="modal-footer text-right">
					<button type="button" class="btn btn-secondary" id="project-delete-confirm-no">No</button>
					<form action="/functions/DeleteProject.php" method="POST">
						<input type="hidden" name="ProjectID" value="<?php echo $projectID ?>" />
						<input type="submit" value="Yes, Delete" class="btn btn-danger" id="project-delete-confirm-yes">
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container pt-3 pb-3">
		<div class="row">
			<div class="col col-md-8">
				<?php if ($error !== false) {
					alert("error", $error, false);
				} ?>
				<div class="card">
					<form action="<?php echo $action ?>" method="POST">
						<?php if ($mode == "edit") {
							?> 
							<input type="hidden" name="ProjectID" value="<?php echo $projectID ?>" />
							<?php
						} ?>
						<input type="hidden" name="User" value="<?php echo $_SESSION["Username"]; ?>" />
						<div class="card-body">
							<h2 class="card-title"><?php echo ucfirst($mode); ?> Project</h2>
							<div class="row">
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label for="project-name">Name</label>
										<input type="text" class="form-control" name="ProjectName" id="project-name" value="<?php echo $project["ProjectName"] ?>" />
									</div>
									<div class="form-group">
										<label for="project-date">Start Date</label>
										<div class="input-group">
											<input type="date" class="form-control" id="project-date" name="DateCreated" value="<?php echo $project["DateCreated"] ?>" />
											<span class="input-group-btn">
												<button id="project-date-today" class="btn btn-primary">Today</button>
											</span>
										</div>
									</div>
									<hr class="d-lg-none" />
								</div>
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label for="project-users">Estimated Users</label>
										<input type="number" class="form-control" name="EstimatedUsers" id="project-users" value="<?php echo $project["EstimatedUsers"] ?>" />
									</div>
									<div class="row">
										<div class="col-12 col-lg-5 col-xl-4">
											<div class="form-group">
												<label class="d-none d-lg-block">Availability</label>
												<input type="checkbox" name="IsForSale" id="project-forsale" <?php echo ($project["IsForSale"] == "1"?"checked":"") ?> />
												<label for="project-forsale">Public</label>
											</div>
										</div>
										<div class="col-12 col-lg-7 col-xl-8">
											<div class="form-group">
												<label class="d-none d-lg-block">&nbsp;</label>
												<label for="project-price" class="d-lg-none">Price</label>
												<div class="input-group">
													<span class="input-group-addon">$</span>
													<input type="number" step="0.01" min="0" class="form-control" name="Price" id="project-price" value="<?php echo $project["Price"] ?>" <?php echo ($project["IsForSale"] == "1"?"":"disabled") ?> />
												</div>

											</div>
										</div>
									</div>
									<hr class="d-lg-none" />
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label for="project-projecturl">Project URL</label>
										<input type="text" class="form-control" name="ProjectURL" id="project-projecturl" placeholder="http://example.com" value="<?php echo $project["ProjectURL"] ?>" />
									</div>
								</div>
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label for="project-sourceurl">Source Code URL</label>
										<input type="text" class="form-control" name="SourceURL" id="project-sourceurl" placeholder="http://example.com" value="<?php echo $project["SourceURL"] ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-center">
							<input type="submit" value="Save Project" class="btn btn-lg btn-success w-100">
							<?php if ($mode == "edit") { ?>
								<button id="project-delete" class="mt-1 btn btn-sm btn-danger px-5"  data-toggle="modal" data-target="#project-delete-confirm">Delete Project</button>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

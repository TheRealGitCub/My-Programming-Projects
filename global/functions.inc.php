<?php
	
	function alert($type, $content, $dismissable = true) {
		?>
		<div class="alert alert-<?php echo $type ?> <?php echo ($dismissable?"alert-dismissible":"") ?> fade show" role="alert">
			<?php echo $content ?>
			<?php if ($dismissable) { ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			<?php } ?>
		</div>
		<?php
	}
	
	function displayAlerts() {
		if (isset($_GET["success"])) {
			alert("success", $_GET["success"]);
		}
		
		if (isset($_GET["danger"])) {
			alert("danger", $_GET["danger"]);
		}
		
		if (isset($_GET["warning"])) {
			alert("warning", $_GET["warning"]);
		}
		
		if (isset($_GET["info"])) {
			alert("info", $_GET["info"]);
		}
	}
	
?>
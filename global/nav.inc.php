<nav class="navbar navbar-dark bg-dark fixed-top">
	<div class="container">
		<a href="/index.php" class="navbar-brand mr-auto">My Programming Projects</a>
		<?php if (isset($_SESSION["SessionID"]) && !empty($_SESSION["SessionID"])) { ?>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="btn btn-primary" href="/app/logout.php">Log Out</a>
				</li>
			</ul>
		<?php } ?>
		<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-links">
			<span class="navbar-toggler-icon"></span>
		</button> -->
	</div>
</nav>

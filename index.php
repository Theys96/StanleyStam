<?php
require_once('php/config.php');
require_once('php/functions.php');
require_once('php/model.php');
require_once('php/auth.php');
$Auth = new Auth($con);
$Model = new Model($con);
require_once('php/router.php');
$Auth->autoAuth();

if (file_exists('php/code/' . $page . '.php')) {
	require_once('php/code/' . $page . '.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<!--Info-->
		<title>Stanleystam</title>
		<link rel="shortcut icon" type="image/png" href="/apple-touch-icon.png"/>
		<link rel="manifest" type="application/json" href="/manifest.json">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="#222A0A">
		<meta name="theme-color" content="#222A0A" />

		<!--Resources-->
		<link rel="stylesheet" type="text/css" href="/style/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/style/style.css">
		<script src="/jquery.js"></script>
		<?php
		if (isset($_COOKIE['style'])) {
			echo '<link rel="stylesheet" type="text/css" href="/style/'.$_COOKIE['style'].'.css">';
		} else {
			echo '<link rel="stylesheet" type="text/css" href="/style/dark.css">';
		}
		echo "\n";
		?>
	</head>
	<body>
		<div class="container-fluid">
			<div><h1 class='text-center py-3'>Stanleystam</h1></div>
			<div class="row">
				<div class="col-sm-4">

					<div class="card my-3">
						<?php
						menu($page, $Auth);
						?>
					</div>

				</div>
	  			<div class="col-sm-8">

					<?php
					if (file_exists('php/page/' . $page . '.php')) {
						require_once('php/page/' . $page . '.php');
					}
					?>

	  			</div>
			</div>
		</div>
	</body>
</html>

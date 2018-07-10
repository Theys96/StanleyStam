<?php
if (isset($action) && isset($_SESSION['userID'])) {

	$data = $Model->activityById($a)->data();

	if ($action == 'disable_p' && in_array($_SESSION['user'], $data['organisators']) ) {
		$Model->activityById($a)->disablePrecencies();
	}
	else if ($action == 'enable_p' && in_array($_SESSION['user'], $data['organisators']) ) {
		$Model->activityById($a)->enablePrecencies();
	}
	else if ($action == 'aanmelden') {
		$Model->activityById($a)->signOn($_SESSION['userID']);
	}
	else if ($action == 'afmelden') {
		$Model->activityById($a)->signOff($_SESSION['userID']);
	}

	header('Location: /a/' . $a);
}
if ($action == 'aanmelden' && isset($_POST['id'])) {
	$Model->activityById($a)->signOn(intval($_POST['id']));
}
?>

<?php
if (isset($_POST['style']) && in_array($_POST['style'], array('dark', 'light', 'lollypop', 'hyves'))) {
	setcookie("style", $_POST['style'], time() + 86400 * 365);
	header('Location: /settings');
}
?>
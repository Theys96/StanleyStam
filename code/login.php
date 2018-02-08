<?php
if ($Auth->isAuth()) {
	header('Location: /logout');
}
if (isset($_POST['id']) && isset($_POST['password'])) {
	if ($Auth->auth($_POST['id'], $_POST['password'])) {
		header('Location: /');
	}
}
?>
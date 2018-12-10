<?php
// Check ID
if (!$Auth->isAuth()) {
	header('Location: /login');	
}

if (count($_POST) > 0) {
	$user = $Model->userById($_SESSION['userID']);
}

if (isset($_POST['oldPass'])) {
	if ($_POST['newPass1'] == $_POST['newPass2']) {
		if ($user->getPassword($_POST['oldPass'])) {
			if (strlen($_POST['newPass1']) > 3) {
				$user->updatePassword($_POST['newPass1']);
				$message = "Wachtwoord veranderd.";
				} else {
				$message = "Wachtwoord te kort.";	
				}
			} else {
			$message = "Wachtwoord incorrect.";
			}
		} else {
		$message = "Wachtwoorden komen niet overeen.";
		}
	}

if (isset($_POST['schermnaam'])) {
	if (strlen($_POST['schermnaam']) <= 15) {
		$user->updateSchermnaam($_POST['schermnaam']);
	} else {
		$message = "Je schermnaam mag maximaal 15 tekens bevatten.";
	}
}

if (isset($_POST['mail'])) {
	if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
		$user->updateMail($_POST['mail']);
	} else {
		$message = "Geef een juist e-mail adres op.";
	}
}
?>
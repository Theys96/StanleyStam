<?php
// Check ID
if (!$Auth->isAuth()) {
	header('Location: /login');	
}

if (isset($_POST['oldPass'])) {
	if ($_POST['newPass1'] == $_POST['newPass2']) {
		$user = $Model->userById($_SESSION['userID']);
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
?>
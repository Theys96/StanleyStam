<?php
Class Auth {

	private $con;

	function __construct($con) {
		$this->con = $con;
	}

	function auth($id, $password) {
		$lid = $this->con->query("SELECT * FROM leden WHERE id=" . $id)->fetch_assoc();
		if ($password == $lid['wachtwoord'] || md5($password) == $lid['wachtwoord']) {
			$_SESSION['user'] = $lid['voornaam'];
			$_SESSION['userID'] = $lid['id'];
			$_SESSION['userTier'] = $lid['tier'];
			setcookie("autouser", $lid['id'], time() + 86400 * 365);
			setcookie("autopass", $lid['wachtwoord'], time() + 86400 * 365);
			return 1;
			}
		else {
			return 0;
		}
	}
	
	function isAuth() {
		if (isset($_SESSION['user']) && isset($_SESSION['userID'])) {
			return 1;
		}
		return 0;
	}
	
	function autoAuth() {
		if (!$this->isAuth()) {
			if (isset($_COOKIE["autouser"]) && isset($_COOKIE["autopass"])) {
				$this->auth($_COOKIE["autouser"], $_COOKIE["autopass"]);
			}
		}
	}

	function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['userID']);
		setcookie("autouser", null, time() - 1000);
		setcookie("autopass", null, time() - 1000);
	}
}
?>

<?php
if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
	$h = $_POST['hash'];
	$lid = $_POST['lid'];
	$query = $con->query("SELECT * FROM wachtwoordreset WHERE active=1 AND lid=".$lid." AND sha1='".$h."'");
	
	if ($query->num_rows > 0) {
		$user = $Model->userById($lid);
		if ($_POST['pass1'] == $_POST['pass2']) {
			$newPass = $_POST['pass1'];
			if (strlen($newPass) > 3) {
				$user->updatePassword($newPass);
				$con->query("UPDATE wachtwoordreset SET active=0 WHERE lid=".$lid);
				$warning = "Wachtwoord veranderd. Klik <a href='/login'>hier</a> om in te loggen.";
			} else {
				$warning = "Wachtwoord te kort.";	
			}
		} else {
			$warning = "De opgegeven wachtwoorden komen niet overeen.";
		}
	} else {
		$warning = "Er is iets misgegaan.";
	}
}

if (isset($_POST['mail'])) {
$subject = "stanleystam.nl | Reset je wachtwoord";
$message = "
<html>
<head>
  <title>stanleystam.nl | Reset je wachtwoord</title>
</head>
<body>
  <p>Hoi %s,</p>
  <p>Iemand (hopelijk jijzelf) heeft aangegeven dat je je wachtwoord op <a href='http://stanleystam.nl'>stanleystam.nl</a>
  bent vergeten. Om een nieuw wachtwoord in te stellen, ga dan naar de volgende link:<br />
  <a href='%s'>%s</a></p>
  <p>Groetjes,</p>
  <p>Thijs</p>
</body>
</html>
";
$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
$headers[] = 'From: Thijs <thijs@stanleystam.nl>';

	$query = $con->query("SELECT * FROM leden WHERE LOWER(mail)=LOWER('".$con->real_escape_string($_POST['mail'])."')");
	if ($query->num_rows > 0) {
		$user = $query->fetch_assoc();
		$hash = hash("sha1",$user['id'] . time());
		$con->query("UPDATE wachtwoordreset SET active=0 WHERE lid=".$user['id']);
		$con->query("INSERT INTO wachtwoordreset (lid,sha1) VALUES (".$user['id'].",'".$hash."')");
		
		$headers[] = sprintf("To: %s <%s>", $user['voornaam'], $user['mail']);
		$to = $user['mail'];
		$url = $baseUrl . "/wachtwoord/" . $hash;
		$message = sprintf($message, $user['voornaam'], $url, $url);
		mail($to, $subject, $message, implode("\r\n", $headers));
		//echo $to . "<br />";
		//echo $subject . "<br />";
		//echo $message . "<br />";
		//echo implode("\r\n", "<br />");
	}
	$message = "Er is een e-mail verstuurd naar het opgegeven e-mail adres, als deze bij een stamlid hoort.";
	$warning = "Let op: De verzonden e-mail is waarschijnlijk in je spambox terecht gekomen."
}

if (isset($posthash)) {
	$query = $con->query("SELECT * FROM wachtwoordreset LEFT JOIN leden ON wachtwoordreset.lid=leden.id WHERE wachtwoordreset.active=1 AND wachtwoordreset.sha1='" . $con->real_escape_string($posthash) . "'");
	if ($query->num_rows > 0) {
		$data = $query->fetch_assoc();
		$reset = true;
	} else {
		header('location: /login');
	}
}
?>
<?php
$request = explode('/',substr($_SERVER['REQUEST_URI'], 1));
if (isset($_SESSION['user'])) {
	$page = 'agenda';
} else {
	$page = 'front';
}

if (in_array($request[0], array('a', 'agenda', 'actiepunten', 'front', 'opkomsten', 'kampen', 'acties', 'groepsraden', 'geschiedenis', 'barkaart', 'profiel', 'settings', 'login', 'logout') )) {
	$page = $request[0];
}
if ($page == 'agenda' || $page == 'geschiedenis') {
	if (isset($request[1])) {
		$limit = intval($request[1]);
	} else {
		$limit = 5;
	}
	if ($request[1] == 'all') {
		$limit = -1;
	}
}
if ($page == 'a') {
	$a = $request[1];
	if (isset($request[2])) {
		$action = $request[2];
	}
}
?>
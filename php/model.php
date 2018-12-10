<?php
Class Activity {

	private $db;
	public $id;
	private $data = array();

	function __construct(Mysqli $con, $id) {
		$this->db = $con;
		$this->id = $id;
		$this->init();
	}

	function init() {
		$query = $this->db->query("SELECT *, DATEDIFF(date_start, NOW()) > 0 AS active FROM activities WHERE id=" . $this->id);
		if ($query->num_rows == 1) {
			$this->data = $query->fetch_assoc();
			
			# organisatie
			$list = $this->data['organisators'];
			$this->data['organisators'] = array();
			if ($list != "") {
				$query2 = $this->db->query("SELECT * FROM leden WHERE id IN (".$list.")");
				while ($p = $query2->fetch_assoc()) {
					$this->data['organisators'][$p['id']] = $p['schermnaam'];
				}
			}
			
			
			# aanwezigen
			$query2 = $this->db->query("SELECT * FROM activities_p LEFT JOIN leden ON activities_p.lid=leden.id WHERE act=" . $this->id . " ORDER BY leden.voornaam");
			$this->data['precencies'] = array();
			while ($p = $query2->fetch_assoc()) {
				$this->data['precencies'][$p['id']] = $p['schermnaam'];
			}
		}
	}

	function data() {
		return $this->data;
	}

	function disablePrecencies() {
		$this->db->query("UPDATE activities SET p=0 WHERE id=" . $this->data['id']);
	}

	function enablePrecencies() {
		$this->db->query("UPDATE activities SET p=1 WHERE id=" . $this->data['id']);
	}

	function signOn($user) {
		$this->db->query("INSERT INTO activities_p (lid,act) VALUES (".$user.",".$this->data['id'].")");
	}

	function signOff($user) {
		$this->db->query("DELETE FROM activities_p WHERE lid=".$user." AND act=".$this->data['id']);
	}

}

Class User {

	private $db;
	private $data = array();

	function __construct(Mysqli $con, $id) {
		$this->db = $con;
		$query = $con->query("SELECT *, DATEDIFF(NOW(),sinds) AS dagen FROM leden WHERE id=" . $id);
		if ($query->num_rows == 1) {
			$this->data = $query->fetch_assoc();
		}
	}

	function data() {
		return $this->data;
	}

	function getPassword($password) {
		return ($password == $this->data['wachtwoord'] || md5($password) == $this->data['wachtwoord']); // BAD!
	}

	function updatePassword($password) {
		$this->db->query("UPDATE leden SET wachtwoord='".md5($password)."' WHERE id=" . $this->data['id']);
	}
	
	function updateSchermnaam($naam) {
		$this->db->query("UPDATE leden SET schermnaam='".$this->db->real_escape_string($naam)."' WHERE id=" . $this->data['id']);
	}
	
	function updateMail($mail) {
		$this->db->query("UPDATE leden SET mail='".$this->db->real_escape_string($mail)."' WHERE id=" . $this->data['id']);
	}

}

Class Todo {

	private $id;
	private $data;

	function __construct(Mysqli $con, $data) {
		$this->db = $con;
		$this->data = $data;
		$this->data['organisators'] = explode(',', $this->data['organisators']);
	}

	function data() {
		return $this->data;
	}

}

Class Model {

	private $db;

	function __construct(Mysqli $con) {
		$this->db = $con;
	}

	function userById($id) {
		return new User($this->db, $id);
	}

	function activityById($id) {
		return new Activity($this->db, $id);
	}

	function activitiesByQuery($query) {
		$activities = array();
		$query = $this->db->query($query);
		if ($query->num_rows > 0) {
			while ($act = $query->fetch_assoc()) {
				$activities[$act['id']] = $this->activityById($act['id']);
			}
		}
		return $activities;
	}

	function futureActivities($limit) {
		$query = "SELECT id FROM `activities` WHERE date_end >= DATE(NOW()) ORDER BY date_start";
		if (isset($limit) && $limit > 0) {
			$query = $query . " LIMIT " . $limit;
		}
		return $this->activitiesByQuery($query);
	}

	function futureActivitiesOfType($type) {
		$query = "SELECT id FROM `activities` WHERE date_end >= DATE(NOW()) AND type='".$type."' ORDER BY date_start";
		return $this->activitiesByQuery($query);
	}

	function historyActivities($limit) {
		$query = "SELECT id FROM `activities` WHERE date_end <= DATE(NOW()) ORDER BY date_start DESC";
		if (isset($limit) && $limit > 0) {
			$query = $query . " LIMIT " . $limit;
		}
		return $this->activitiesByQuery($query);
	}

	function historyActivitiesOfType($type) {
		$query = "SELECT id FROM `activities` WHERE date_end <= DATE(NOW()) AND type='".$type."' ORDER BY date_start DESC";
		return $this->activitiesByQuery($query);
	}

	function todosByQuery($query) {
		$todos = array();
		$query = $this->db->query($query);
		if ($query->num_rows > 0) {
			while ($todo = $query->fetch_assoc()) {
				$todos[$todo['id']] = new Todo($this->db, $todo);
			}
		}
		return $todos;
	}

	function currentTodos() {
		$query = "SELECT * FROM todos WHERE archived=0 ORDER BY status_date DESC";
		return $this->todosByQuery($query);
	}

	function archivedTodos() {
		$query = "SELECT * FROM todos WHERE archived=1 ORDER BY status_date DESC";
		return $this->todosByQuery($query);
	}
}
?>

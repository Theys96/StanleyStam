<?php
if ($action == 'aanmelden') {
  echo '<div class="card my-3">' . "\n";
  echo '<div class="card-header p-1"></div>' . "\n";
  echo '<div class="card-block">' . "\n";
  echo '<p>Je probeert je aan te melden voor de onderstaande opkomst/activiteit, maar je bent niet aangemeld. Wie ben je?</p>';
  require("a_userForm.php");
  echo '</div>';
  echo '<div class="card-footer p-1"></div>' . "\n";
  echo '</div>';
}
require_once('php/activities.php');
printActivity($Model->activityById($a));
?>

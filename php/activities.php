<?php

function printHeader($title, $type, $type_color) {
	echo '
		<div class="card-header">
			<div class="row">
				<div class="col-md-9 text-center">
					<h4>' . $title . '</h4>
				</div>
				<div class="col-md-3">
					<div class="w-100 h-100 align-middle badge badge-' . $type_color . '">
						<h6 class="pt-1">' . $type . '</h6>
					</div>
				</div>
			</div>
		</div>';
}

function printRow($label, $value) {
	echo '<div class="col-5 text-bold">'.$label.'</div>' . "\n";
	echo '<div class="col-7 text-justify">' . $value . '</div>' . "\n";
}

function printActivity(Activity $activity) {
	$act = $activity->data();
	$color = array(
		'opkomst' => 'primary',
		'kamp' => 'success',
		'activiteit' => 'info',
		'groepsraad' => 'danger'
		);

	/* Header of the card */
	echo '<div class="card my-3">' . "\n";
	printHeader($act['name'], $act['type'], $color[$act['type']]);

	/* Body of the card */
	echo '<div class="card-block">' . "\n";
		echo '<div class="row">' . "\n";
			printRow("Datum", formatData($act['date_start'], $act['date_end']));

			if (count($act['organisators']) > 0) {
				printRow("Organisatie", implode('<br />', $act['organisators']));
			}

			if ($act['p']) {
				echo '<div class="col-5 text-bold">Aanwezig ('.count($act['precencies']).')</div>' . "\n";
				echo '<div class="col-7">';
				$present = printListHighlighted($act['precencies'], $_SESSION['user']);
				echo '</div>';
			}

		echo "</div>\n";

		if ($act['description'] != '') {
			echo '<hr /><p class="card-text description-text">' . $act['description'] . '</p>';
		}
	echo '</div>';

		/* Footer of the card */
		echo '<div class="card-footer p-1">';
		$active = ($act['active'] && $act['p'] && isset($_SESSION['user']));
		$org = ($act['active'] && isset($_SESSION['user']) && in_array($_SESSION['user'], $act['organisators']));
		if ($active || $org) {
			echo '<div class="row">';
			if ($active) {
				if ($present) {
					echo "<div class='col-md-12'><a class='btn btn-danger m-0 w-100' href='/a/".$act['id']."/afmelden'>Afmelden</a></div>";
				} else {
					echo "<div class='col-md-12'><a class='btn btn-success m-0 w-100' href='/a/".$act['id']."/aanmelden'>Aanmelden</a></div>";
				}
			}
			if ($org) {
				/* User organiseert activiteit */
				if ($act['p']) {
					echo "<div class='col-md-6'>
					<a class='btn btn-warning w-100 py-2 my-2' href='/a/".$act['id']."/disable_p'>Aanmelden uitschakelen</a>
					</div>\n";
					echo '<div class="col-md-6">
					<input type="text" value="http://stanleystam.nl/a/'.$act['id'].'/aanmelden" class="form-control py2 my-2" readonly />
					</div>';
				} else {
					echo "<div class='col-md-3'></div><div class='col-md-6'><a class='btn btn-success btn w-100 py-1 my-2' href='/a/".$act['id']."/enable_p'>Aanmelden inschakelen</a>
						</div><div class='col-md-3'></div>\n";
				}
			}
			echo '</div>';
		}
		echo '</div>';
	echo '</div>';
}

function printNoActivities() {
	echo '
	<div class="card my-3">
		<div class="card-header">
			<h4 class="card-title">Niets gevonden</h4>
		</div>
		<div class="card-block"><p><i>Hier is op dit moment even niets.</i></p></div>
	</div>';
}

function printActivitiesList($act) {
	foreach ($act as $activity) {
		printActivity($activity);
	}
	if (count($act) == 0) {
		printNoActivities();
	}
}

function printActivities($model, $limit) {
	printActivitiesList($model->futureActivities($limit));
}

function printActivitiesBackward($model, $limit) {
	printActivitiesList($model->historyActivities($limit));
}

function printActivitiesOfType($model, $type) {
	printActivitiesList($model->futureActivitiesOfType($type));
}

function printActivitiesOfTypeBackward($model, $type) {
	printActivitiesList($model->historyActivitiesOfType($type));
}
?>

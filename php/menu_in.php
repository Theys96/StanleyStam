<div class="card-header"></div>
<div class="card-block">
	<div class="p-3">
		<div class="row">
			<div class="col-2 small-logo"></div>
			<div class="col-9">
				<h4>Welkom, <?php echo $_SESSION['user'] ?></h4>
				<?php
				echo "<h5>";
				switch ($_SESSION['userTier']) {
					default:
						break;

					case 0:
						echo "oud-lid";
						break;

					case 1:
						echo "lid";
						break;

					case 2:
						echo "actief lid";
						break;

					case 3:
						echo "bestuurslid";
						break;
				}
				echo "</h5>";
				?>
			</div>
		</div>
	</div>
	<div class="btn-group-vertical w-100 my-2">
		<?php
		echo pageLink('agenda', 'Agenda', $page);
		echo pageLink('opkomsten', 'Opkomsten', $page);
		echo pageLink('kampen', 'Kampen', $page);
		echo pageLink('acties', 'Activiteiten', $page);
		echo pageLink('groepsraden', 'Groepsraden', $page);
		echo pageLink('geschiedenis', 'Geschiedenis', $page);
		?>
	</div>
	<div class="btn-group-vertical w-100 my-2">
		<?php
		echo pageLink('profiel', 'Profiel', $page);
		echo pageLink('actiepunten', 'Actiepunten', $page);
		echo '<a target="_blank" href="https://drive.google.com/open?id=0B4LgpuRYDJaPOVJsakxMU3BENmc" class="btn btn-stanley btn-outline-primary">Documenten</a>';
		echo pageLink('barkaart', 'Barkaart', $page);
		?>
	</div>
	<div class="btn-group-vertical w-100 my-2">
		<?php
		echo pageLink('settings', 'Instellingen', $page);
		echo pageLink('logout', 'Uitloggen', $page);
		?>
	</div>
</div>

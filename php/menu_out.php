<div class="card-header"></div>
<div class="card-block">
	<div class="btn-group-vertical w-100 my-2">
		<?php
		echo pageLink('front', 'Stanleystam', $page);
		?>
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
		echo pageLink('actiepunten', 'Actiepunten', $page);
		echo pageLink('barkaart', 'Barkaart', $page);
		?>
	</div>
	<div class="btn-group-vertical w-100 my-2">
		<?php
		echo pageLink('settings', 'Instellingen', $page);
		echo pageLink('login', 'Inloggen', $page);
		?>
	</div>
</div>

<?php
$query = $con->query("SELECT * FROM `barkaarten` WHERE DATE_ADD(datum, INTERVAL 12 DAY) > NOW() ORDER BY datum DESC LIMIT 1");
if ($query->num_rows == 1) {
	$link = $query->fetch_assoc();
	$link = $link['link'];
	}
else {
	$link = false;
	}
?>
<div class="card my-3">
	<div class="card-header">
		<h4 class="card-title">Barkaart</h4>
	</div>
	<div class="card-block">
		<?php
		if ($link !== false) {
			echo "<p>Welkom op de bestelpagina voor barkaarten van de Stanleystam.</p>\n";
			echo "<p>De onderstaande link gaat naar een iDeal betaal pagina. Bij betaling van een barkaart via die pagina ontvangt de penningmeester een melding dat je een kaart besteld hebt.</p>";
			echo "<p>Let op: de naam behorende bij de betalende rekening wordt gebruikt om vast te stellen voor wie de kaart bedoeld is.</p>\n";
			echo "<h4><a target='_blank' href='" . $link . "'>Betalen (iDeal)</a></h4>\n";
		} else {
			echo "<p>Helaas is het op dit moment niet mogelijk om barkaarten te bestellen. Dit probleem kan worden verholpen door de penningmeester.</p>";
		}
		?>
	</div>
</div>
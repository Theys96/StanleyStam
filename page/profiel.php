<?php
// Lid info
$lid = $Model->userById($_SESSION['userID'])->data();
if (isset($message)) {
	echo "<<div class='alert alert-warning'>" . $message . "</div>\n";
}
?>
<div class="card my-3">
	<div class="card-header">
		<h4 class="card-title text-center">Profiel</h4>
	</div>
	<div class="card-block">
		<div class="row">

			<div class="col-sm-6 text-bold">Naam</div>
			<div class="col-sm-6"><?php echo $lid['voornaam'] . " " . $lid['achternaam']; ?></div>

			<div class="col-sm-6 text-bold">E-mailadres</div>
			<div class="col-sm-6"><?php echo $lid['mail']; ?></div>

			<div class="col-sm-6 text-bold">Scouting NL lidnummer</div>
			<div class="col-sm-6"><?php echo $lid['scoutnummer']; ?></div>

			<div class="col-sm-6 text-bold">Lid sinds</div>
			<div class="col-sm-6"><?php echo $lid['sinds']; ?><br /><small>(<?php echo $lid['dagen']; ?> dagen geleden)</small></div>

			<div class="col-sm-6 text-bold">Geboortedatum</div>
			<div class="col-sm-6"><?php echo $lid['geboortedag']; ?></div>

		</div>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6"><a class="btn btn-stanley w-100" onClick="$('#editPassword').slideDown(); $(this).fadeOut();">Wachtwoord wijzigen</a></div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>

<div class="card mb-3 hidden" id="editPassword">
	<div class="card-header text-center"><h3>Wachtwoord wijzigen</h3></div>
	<form method='post'>
		<div class='card-block'>
			<div class="form-group">
				<label for="oldPass" class="m-0">Oud wachtwoord</label>
				<input type="password" class="form-control" name='oldPass' id='oldPass' />
			</div>
			<div class="form-group">
				<label for="newPass1" class="m-0">Nieuw wachtwoord</label>
				<input type="password" class="form-control" name='newPass1' id='newPass1' />
			</div>
			<div class="form-group">
				<label for="newPass2" class="m-0">Herhaal nieuw wachtwoord</label>
				<input type="password" class="form-control" name='newPass2' id='newPass2' />
			</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 mb-0 form-group">
					<input type="submit" class="form-control btn btn-stanley" value="Wijzig" />
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</form>
</div>

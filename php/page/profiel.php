<?php
// Lid info
$lid = $Model->userById($_SESSION['userID'])->data();
if (isset($message)) {
	echo "<<div class='alert alert-warning'>" . $message . "</div>\n";
}
?>
<script>
function toggleEdit(name) {
	$('.' + name).hide();
	$('.edit-' + name).show();
}
</script>
<div class="card my-3">
	<div class="card-header">
		<h4 class="card-title text-center">Profiel</h4>
	</div>
	<div class="card-block">
	  <form method='post'>
		<div class="row">

			<div class="col-sm-6 text-bold">Naam</div>
			<div class="col-sm-6"><?php echo $lid['voornaam'] . " " . $lid['achternaam']; ?></div>
			
			<div class="col-sm-6 text-bold">Schermnaam</div>
			<div class="col-sm-5 schermnaam"><?php echo $lid['schermnaam']; ?></div>
			<div class="col-sm-1 schermnaam"><a class='icon' href='#' onClick='toggleEdit("schermnaam")'>&#x270E;</a></div>
			<div class="input-group col-sm-6 edit-schermnaam" style="display: none;">
			  <input type="text" class="form-control" value="<?php echo $lid['schermnaam']; ?>" name="schermnaam" />
			  <div class="input-group-append">
			    <input class="btn btn-stanley btn-outline-primary" type="submit" value="Bijwerken" />
			  </div>
			</div>
			
			<div class="col-sm-6 text-bold">E-mailadres</div>
			<div class="col-sm-5 mail"><?php echo $lid['mail']; ?></div>
			<div class="col-sm-1 mail"><a class='icon' href='#' onClick='toggleEdit("mail")'>&#x270E;</a></div>
			<div class="input-group col-sm-6 edit-mail" style="display: none;">
			  <input type="text" class="form-control" value="<?php echo $lid['mail']; ?>" name="mail" />
			  <div class="input-group-append">
			    <input class="btn btn-stanley btn-outline-primary" type="submit" value="Bijwerken" />
			  </div>
			</div>

			<div class="col-sm-6 text-bold">Scouting NL lidnummer</div>
			<div class="col-sm-6"><?php echo $lid['scoutnummer']; ?></div>

			<div class="col-sm-6 text-bold">Lid sinds</div>
			<div class="col-sm-6"><?php echo $lid['sinds']; ?><br /><small>(<?php echo $lid['dagen']; ?> dagen geleden)</small></div>

			<div class="col-sm-6 text-bold">Geboortedatum</div>
			<div class="col-sm-6"><?php echo $lid['geboortedag']; ?></div>

		</div>
	  </form>
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

<?php
if (isset($message)) {
	echo "<div class='alert alert-success'>" . $message . "</div>\n";
}
if (isset($warning)) {
	echo "<div class='alert alert-warning'>" . $warning . "</div>\n";
}
if (!$reset) :
?>
<div class="card">
	<div class="card-header text-center"><h3>Wachtwoord vergeten?</h3></div>
	<div class='card-block'>
		<form method='post'>
			<div class="form-group">
				<label for="inputMail">Geef je e-mail adres op:</label>
				<input type="text" class="form-control" name='mail' id="inputMail" />
			</div>
			<div class="form-group text-center">
				<input type='submit' class='btn btn-primary' value='Verzenden' />
			</div>
	  	</form>
  	</div>
</div>
<?php 
endif;
if ($reset == true) :
?>
<div class="card">
	<div class="card-header text-center"><h3>Wachtwoord opnieuw instellen</h3></div>
	<div class='card-block'>
		<form method='post'>
			<input type='hidden' name='hash' value='<?php echo $posthash; ?>' />
			<input type='hidden' name='lid' value='<?php echo $data['lid']; ?>' />
			<div class="form-group">
				<label for="inputPass">Geef een nieuw wachtwoord op:</label>
				<input type="password" class="form-control" name='pass1' id="inputPass" />
			</div>
			<div class="form-group">
				<label for="inputPass2">Herhaal wachtwoord:</label>
				<input type="password" class="form-control" name='pass2' id="inputPass2" />
			</div>
			<div class="form-group text-center">
				<input type='submit' class='btn btn-primary' value='Verzenden' />
			</div>
	  	</form>
  	</div>
</div>
<?php endif; ?>
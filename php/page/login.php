<div class="card">
	<div class="card-header text-center"><h3>Login</h3></div>
	<div class='card-block'>
		<form method='post'>
			<div class="form-group">
				<label for="inputUsername">Naam</label>
				<select class="form-control" name="id">
					<option selected disabled>Kies je naam</option> 
					<?php
					$leden = $con->query("SELECT leden.id, schermnaam FROM leden WHERE leden.tier > 0 ORDER BY voornaam ASC");
					while ($lid = $leden->fetch_assoc()) {
						echo "<option value='".$lid['id']."'>".$lid['schermnaam']."</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="inputPassword">Wachtwoord</label>
				<input type="password" class="form-control" name='password' id="inputPassword" />
				<small class="form-text text-muted"><a href='/wachtwoord'>Wachtwoord vergeten?</a></small>
			</div>
			<div class="form-group text-center">
				<input type='submit' class='btn btn-primary' value='Login' />
			</div>
	  	</form>
  	</div>
</div>
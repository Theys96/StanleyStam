<form method='post'>
  <div class="form-group">
    <label for="inputUsername">Naam</label>
    <select class="form-control" name="id">
      <option selected disabled>Kies je naam</option>
      <?php
      $leden = $con->query("SELECT leden.id, CONCAT(leden.voornaam, ' ', leden.achternaam) AS naam FROM leden WHERE leden.tier > 0 ORDER BY voornaam ASC");
      while ($lid = $leden->fetch_assoc()) {
        echo "<option value='".$lid['id']."'>".$lid['naam']."</option>";
      }
      ?>
    </select>
  </div>
  <div class="form-group text-center">
    <input type='submit' class='btn btn-success' value='Aanmelden' />
  </div>
</form>

<div class="card my-3">
  <img class="card-img-top img-fluid" src="/front.jpg" alt="Stamhok">
  <div class="card-body p-3">
    <p class="card-text">Welkom op de homepage van de Stanleystam, de stam (18+ groep) van <a target="_blank" href="//www.zwerversgroningen.nl">Scoutinggroep "De Zwervers" Groningen</a>.
  </div>
  <?php
  if ($Auth->isAuth()) {
    echo "<div class='card-body p-3'>\n";
    $leden = $con->query("SELECT leden.schermnaam AS naam FROM leden WHERE leden.tier > 0 ORDER BY schermnaam ASC");
    echo "<p class='card-text'>Op dit moment bestaat de stam uit " . $leden->num_rows . " leden:</p>\n";
    echo "<div class='row'>\n";
    while ($lid = $leden->fetch_assoc()) {
      echo "<div class='col-3'>".$lid['schermnaam']."</div>";
    }
    echo "</div>\n";
    echo "</div>\n";
  }
  ?>
  <div class="card-body p-3">
  	<h4>Contact</h4>
    <div class='row'>
    	<div class='col-4'><b>E-mail</b></div>
    	<div class='col-8'><a href='mailto:bestuur@stanleystam.nl'>bestuur@stanleystam.nl</a></div>
    	<div class='col-4'><b>Adres</b></div>
    	<div class='col-8'>Het Stamhok<br />Clubgebouw "De Til"<br />Concourslaan 2<br />9727 KD  Groningen</div>
    </div>
  </div>
</div>

<!DOCTYPE html>
<html>
<head>
<title>Stanleystam | RSA STYLE</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" type="image/png" href="logo.png"/>
<base target="_blank">
<script src="http://j.mp/jqymin"></script>
<script>
function showAfwezig(title, afwezig)
	{
	if ($('#' + title + '_afwezig').html() == '')
		{
		$('#' + title + '_afwezig').html(afwezig);
		}
	else
		{
		$('#' + title + '_afwezig').html('');
		}
	}
</script>
<?php
include 'config.php';

//Begin programma
function formatDatum($datum)
    {
    $maand = array('','januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december');
    $datum = new DateTime($datum);
    return $datum->format('j ') . $maand[$datum->format('n')];
    }

function formatData($datum1,$datum2)
    {
    $maand = array('','januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december');
    $datum1 = new DateTime($datum1);
    $datum2 = new DateTime($datum2);
    if ($datum1->format('Y') == $datum2->format('Y'))
        {
        if ($datum1->format('m') == $datum2->format('m'))
            {
            if ($datum1->format('d') == $datum2->format('d'))
                {
                return $datum1->format('j ') . $maand[$datum1->format('n')] . $datum1->format(' Y');
                }
            else
                {
                return $datum1->format('j ') . "t/m " . $datum2->format('j ') . $maand[$datum2->format('n')] . $datum1->format(' Y');
                }
            }
        else
            {
            return $datum1->format('j ') . $maand[$datum1->format('n')] . " t/m " . $datum2->format('j ') . $maand[$datum2->format('n')] . $datum1->format(' Y');
            }
        }
    else
        {
        return $datum1->format('j ') . $maand[$datum1->format('n')]  . $datum1->format(' Y') . " t/m " . $datum2->format('j ') . $maand[$datum2->format('n')] . $datum2->format(' Y');
        }
    }

$con = new Mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
if ($mysqli->connect_error) {
    die('Verbinding mislukt (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }

if (isset($_POST['naam']))
    {
    if ($_POST['naam'] != "Kies je naam")
        {
        $opkomst = $con->query("SELECT * FROM activities WHERE type='opkomst' AND id='" . $_POST['opkomst'] . "'")->fetch_array();
        //$afwezig = explode(',',$opkomst['afwezig']);
        //if ($afwezig[0] == '') unset($afwezig[0]);
        //if (in_array($_POST['naam'],$afwezig))
        //    unset($afwezig[array_search($_POST['naam'],$afwezig)]);
        //else
        //    $afwezig[] = $_POST['naam'];
        //$afwezig = implode(',',$afwezig);
        //$con->query("UPDATE opkomsten SET afwezig='$afwezig' WHERE id='" . $_POST['opkomst'] . "'");
        }
    }

//Opkomsten
$query = $con->query("SELECT * FROM activities WHERE type='opkomst' AND DATE_ADD(date_start, INTERVAL 20 HOUR) > NOW() ORDER BY date_start ASC");
$opkomsten['Komende Opkomst'] = $query->fetch_assoc();
$opkomsten['Daarna'] = $query->fetch_assoc();

//Kampen
$query = $con->query("SELECT * FROM activities WHERE type='kamp' AND date_end > NOW()"); 
$kampen = array();
while ($row = $query->fetch_assoc())
    {
    //if ($row['link'] != '')
    ///   $row['naam'] = "<a href='" . $row['link'] . "'>" . $row['naam'] .  "</a>";
    $kampen[] = $row;
    }

//Acties
$query = $con->query("SELECT * FROM activities WHERE type='activiteit' AND date_end > NOW()"); 
$acties = array();
while ($row = $query->fetch_assoc())
    {
    //if ($row['link'] != '')
    //    $row['naam'] = "<a href='" . $row['link'] . "'>" . $row['naam'] .  "</a>";
    $acties[] = $row;
    }
?>
</head>
<body>
    <a style='color: white; text-align: left; font-size: 0.7em;' href='/settings' target='_self'>Terug naar de normale site</a>
<div id='container'>
<h1>Stanleystam</h1>
<?php
$query_leden = $con->query("SELECT * FROM leden WHERE tier>0 ORDER BY voornaam");
while($leden[] = $query_leden->fetch_assoc()) {}
foreach ($opkomsten as $titel => $opkomst)
    {
    if (!isset($opkomst))
        {
        echo "<h2>" . $titel . "</h2>\n<div class='upcoming'>\n<h3>Onbekend</h3>\n<p>Deze opkomst is nog onbekend.</p>\n</div>";
        }
    else
        {
        $opkomst['organisators'] = implode(', ',explode(',',$opkomst['organisators']));
        /*
        $opkomst['afwezig'] = explode(',',$opkomst['afwezig']);
        if ($opkomst['afwezig'][0] == '') unset($opkomst['afwezig'][0]);
        */
        
        echo "<h2>" . $titel . "</h2>\n";
        echo "<div class='upcoming'>\n";
        echo "<h3>" . $opkomst['name'] . "</h3>\n";
        echo "<p><b>" . formatDatum($opkomst['date_start']) . "</b></p>\n";
        echo "<p>" . $opkomst['description'] . "</p>\n";
        echo "<p><b>Georganiseerd door: </b>" . $opkomst['organisators'] . "</p>\n";
        /*
        echo "<p><b>Aanwezig:</b> " . (count($leden) - count($opkomst['afwezig'])) . "/" . count($leden) . " (<span onClick='showAfwezig(\"" . $titel . "\",\"" . implode("<br />",$opkomst['afwezig']) . "\")' title='" . implode("\n",$opkomst['afwezig']) . "'>" . count($opkomst['afwezig']) . " afwezig</span>)</p>";
        echo "<p id='" . $titel . "_afwezig'></p>";
        echo "<form method='post' target='_self'><input type='hidden' name='opkomst' value='" . $opkomst['id'] . "' /><p><b>Afmelden/Aanmelden: </b><select name='naam'>\n";
        echo "<option selected disabled>Kies je naam</option>\n";
        foreach ($leden as $lid)
            {
            if (isset($lid['voornaam']))
            	echo "<option value='" . $lid['voornaam'] . "'>" . $lid['voornaam'] . "</option>\n";
            }
        echo "</select><input type='submit' value='OK' /></p></form>\n";
        */
        echo "</div>\n";
        }
    }
?>
<h2>Kampen</h2>
<div class="groen">
<table class="table">
<?php
if (count($kampen) == 0)
    {
    echo "<i>Geen kampen op dit moment.</i>";
    }
foreach ($kampen as $kamp)
    {
    echo "<tr><td>" . $kamp['name'] . "</td><td>" . formatData($kamp['date_start'],$kamp['date_end']) . "</td></tr>\n";
    }
?>
</table>
</div>
<h2>Overig</h2>
<div class="groen">
<table class="table">
<?php
if (count($acties) == 0)
    {
    echo "<i>Geen acties op dit moment.</i>";
    }
foreach ($acties as $actie)
    {
    echo "<tr><td>" . $actie['name'] . "</td><td>" . formatData($actie['date_start'],$actie['date_end']) . "</td></tr>\n";
    }
?>
</table>
</div>
<h2>Verjaardagen</h2>
<div class="oranje">
<p><b>Eerstvolgende verjaardag: </b></p>
<?php
$jarige = $con->query("SELECT * FROM verjaardagen LIMIT 1")->fetch_array();
echo "<p>" . $jarige['voornaam'] . " wordt " . ($jarige['leeftijd']+1) . " op " . formatDatum($jarige['verjaardag']) . ".<p>\n";
?>
</div>
</div>
</body>
</html>
<?php
$con->close();
?>

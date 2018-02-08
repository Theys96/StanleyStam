<div class="card my-3" id="items">
	<div class="card-block">
		Aantal items:  
		<div class="btn-group ml-3">
		    <a href='/geschiedenis/1' class="btn btn-stanley">1</a>
		    <a href='/geschiedenis/5' class="btn btn-stanley">5</a>
		    <a href='/geschiedenis/10' class="btn btn-stanley">10</a>
		    <a href='/geschiedenis/20' class="btn btn-stanley">20</a>
		    <a href='/geschiedenis/all' class="btn btn-stanley">alles</a>
		</div>
	</div>
</div>
<?php
require_once('php/activities.php');
printActivitiesBackward($Model, $limit)
?>

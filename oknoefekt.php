

<?php
mysql_query("SET NAMES 'utf8'");



	echo '<div id="oknoefekt" class="pokaoknoefekt">
	<div class="pokaoknohexefekt" >


	<div id="usunramka"  style="position:absolute; right:31px; top:1px;" >
	<input type="button" id="usunx" onclick="poka(';?>'oknoefekt'<?php echo');">
	</div> 

	<div id="kolkowykrzyknik"></div>

	<div class="pokaoknotrescefekt" >

	'.$efekt.'
	<input type="button" style="pointer-events:auto; position:absolute; top:0px; left:0px; width:100%; height:100%;border:0px; background:none;" onclick="poka(';?>'oknoefekt'<?php echo');">

	</div>
	</div></div>';


?>
<?php
mysql_query("SET NAMES 'utf8'");

	$naglowek=$cel[specjalne]; 


	// ZAMKNIJ
	echo '<div id="akcja'.$id_pola.'" class="pokaoknoprod" style="display:block;">
	<div class="pokaoknohexprod" >
	<div id="usunramkaprod" >
	<form><input type="button" id="usunx" onclick="poka(';?>'akcja<?php echo $id_pola;?>'<?php echo');"></form>
	</div> 
	<div class="pokaoknotrescprod">';

	echo'<div class="pokaoknonaglowekprod">'.$naglowek.'</div>';

	if ($plik!==''){include 'lokacje/produkcja.php';} 

	echo'</div></div></div>';


?>
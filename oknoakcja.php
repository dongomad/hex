<?php
mysql_query("SET NAMES 'utf8'");

	if ($cel[skrypt]=='tnij'){$naglowek='drzewo';  $plik='lokacje/wydobycie.php';  } 
	elseif ($cel[skrypt]=='wykuwaj'){$naglowek='skała'; $plik='lokacje/wydobycie.php'; }
	elseif ($cel[skrypt]=='rozwoj')
		{
		if ($cel[specjalne]=='pal'){$naglowek='krwawy pal';} 
		if ($cel[specjalne]=='oltarz'){$naglowek='ołtarz';} 
		$plik='lokacje/rozwoj.php'; } 
	

	elseif ($cel[skrypt]=='piecz'){$naglowek='ognisko'; $plik='lokacje/ognisko.php';} 
	elseif ($cel[skrypt]=='low'){$naglowek='łowisko'; $plik='lokacje/wydobycie.php';}




	// ZAMKNIJ
	echo '<div id="akcja'.$id_pola.'" class="pokaokno" style="display:block;">
	<div class="pokaoknohex" >
	<div id="usunramka" >
	<form><input type="button" id="usunx" onclick="poka(';?>'akcja<?php echo $id_pola;?>'<?php echo');"></form>
	</div> 
	<div class="pokaoknotresc">';

	echo'<div class="pokaoknonaglowek">'.$naglowek.'</div>';

	if ($plik!==''){include $plik;} 

	echo'

	</div>
	</div></div>';


?>
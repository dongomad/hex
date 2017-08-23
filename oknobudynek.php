<?php
mysql_query("SET NAMES 'utf8'");

	$cel = mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$id_pola LIMIT 1;"));

	if ($_GET[akcja]==$cel[skrypt]){echo"<script>var e = document.getElementById('akcja$z1');  e.style.display = 'block' ; </script>"; $a=1;}







	echo '<div id="budynek'.$id_pola.'" class="pokaokno">
	<div class="pokaoknohex" >


	<div id="usunramka" >
	<form><input type="button" id="usunx" onclick="poka(';?>'budynek<?php echo $id_pola;?>'<?php echo');"></form>
	</div> 

	<div class="pokaoknotresc">
	<div class="pokaoknonaglowek">'.$naglowek.'</div>

	'.$efekt.'

<div  id="button'.$cel[skrypt].'">
<form><input type="button" style="pointer-events:auto; width:100%; height:100%; background-color:transparent; border:0px; color:transparent;" value="'.$id_pola.'" onclick="ajax(1,';?>'<?php echo $cel[skrypt];?>'<?php echo',this.value,0,0)"></form>
<div id="button'.$cel[skrypt].'grafika"></div>
</div>

	</div>
	</div></div>';


?>
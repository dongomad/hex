


<?php

	$idbestii=$mapa[$id_pola][przeciwnik];
	$bestia = mysql_fetch_array(mysql_query("SELECT id,nazwa FROM users WHERE id=$idbestii LIMIT 1;"));
	$staty = mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$idbestii LIMIT 1;"));  
	$progk= (floor (10*$staty[akondycja]/$staty[kondycja]))*10; if ($progk>100){$progk=100;} $progz=(floor (10*$staty[azycie]/$staty[zycie]))*10; if ($progz>100){$progz=100;}
			$rs=(($statystyki[sila]+$statystyki[dodajsila])-($staty[sila]+$staty[dodajsila]+floor($user[poziom]/2)))/(floor($user[poziom]/2)+$staty[sila]+$staty[dodajsila]); if ($rs<0){$czaszki= floor ($rs*(-10));}
			$rz=(($statystyki[zrecznosc]+$statystyki[dodajzrecznosc])-(floor($user[poziom]/2)+$staty[zrecznosc]+$staty[dodajzrecznosc]))/(floor($user[poziom]/2)+$staty[zrecznosc]+$staty[dodajzrecznosc]); if ($rz<0){$czaszki=$czaszki + floor ($rz*(-10));} if ($czaszki>10){$czaszki=10;} 


	echo '<div id="walka'.$id_pola.'" class="pokaokno">
	<div class="pokaoknohex" >


	<div id="usunramka" >
	<form><input type="button" id="usunx" onclick="poka(';?>'walka<?php echo $id_pola;?>'<?php echo');"></form>
	</div>



	<div class="pokaoknotresc">
	<div class="pokaoknonaglowek">'.$bestia[nazwa].'</div>

	<div style=" background: url(postaci/'.$bestia[id].'.png) 0px 0px;pointer-events:none; background-size:120px; width:120px; min-height:120px; margin: 10px auto;"></div>


		<div style="position:absolute; left:26px; top:90px; height:70px;width:60px; z-index:3;">
		<div class="statyprogres"  title="kondycja"><div class="statyprogreszaw" style="background-color:darkgreen;  height: '.$progk.'%;"></div></div>
		<div class="statyprogres" title="życie"><div class="statyprogreszaw" style="background-color:darkred;  height: '.$progz.'%;"  ></div></div>
		</div>';

		// CZASZKI:

		if ($czaszki>0){echo'<div style="position:absolute; right:26px; top:90px; height:70px;width:60px; z-index:3;" title="przewaga przeciwnika">';
		$c=0; while ($c<$czaszki){echo'<div id="czaszka"></div>'; $c++;} echo'</div>';} 
		echo'

<div  id="buttonatak"  title="zaatakuj">
<form><input type="button" style="pointer-events:auto; width:100%; height:100%; background-color:transparent; border:0px; color:transparent;" value="'.$id_pola.'" onclick="ajax('.$cal.',';?>'walka'<?php echo',this.value,0,0)"></form>
<div id="buttonatakgrafika"></div>
</div>

	</div>
	</div></div>';
$czaszki=0;

?>
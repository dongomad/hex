
<script type="text/javascript">
function rusz (ile) {
       	var e = document.getElementById("przewijkazaw"),
       	currentPos = (parseInt(document.getElementById('przewijkazaw').style.left, 10) || 0);
       	e.style.left = currentPos + ile + 'px';
}
</script>


<?php 
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';
//require_once 'funkcje/abagaz.php';
$user = user::getData('', '');
$staty= mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$user[id] LIMIT 1;")); 


echo '
<div class="rama">
<div class="ramazaw">

	<div class="ramamenu">

	<div  class="button" style="position:relative; margin:5px 10px 5px 50px;" title="statystyki">
	<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="21" onclick="ajax(this.value,0,0,0)">
	<img src="grafika/postacpostac.png" class="buttongrafika">
	</div>

	<div  class="button" style="position:relative; margin:5px 10px;" title="umiejętnosci">	
	<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="22" onclick="ajax(this.value,0,0,0)">
	<img src="grafika/umiejetnosci.png" class="buttongrafika">
	</div>

	<div  class="button" style="position:relative; margin:5px 10px;" title="zawody">
	<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="23" onclick="ajax(this.value,0,0,0)">
	<img src="grafika/zawody.png" class="buttongrafika">
	</div>

	</div>

<div class="ramareszta">';

if ($_GET[cal]==22){echo 'umiejętności';}
elseif ($_GET[cal]==23){echo 'zawody';}
elseif ($_GET[cal]==24){echo 'czary';}
else {

if ($staty[rozwoj]<1){$dodaje='display:none;';}


echo '
<div class="postaclewa" style="color:silver;font-weight:bold;">
<center><b style=" text-transform: uppercase; color:gold;">'.$user[nazwa].'</b></center>

<form>
<table style="font-size:90%;border:0px; line-height:30px; position:absolute; top:50px; font-weight:bold;">

<tr><td id="statynazwa"><center>ATAK:</center></td><td id="statytlo">'.$staty[atak].'</td><td>+</td><td id="statytlo">'.$staty[dodajatak].'</td><td> x </td><td id="statytlo"> '.$staty[bonusatak].'</td><td> % </td><td style="position:relative;"><input id="dodaj" style="'.$dodaje.'"type="button" value="atak" onclick="ajax(21,';?>'dodaj'<?php echo',this.value,0,0)"></td></tr>
<tr><td id="statynazwa">OBRONA:</td><td id="statytlo">'.$staty[obrona].'</td><td>+</td><td id="statytlo">'.$staty[dodajobrona].'</td><td> x </td><td id="statytlo"> '.$staty[bonusobrona].'</td><td> % </td><td style="position:relative;"><input id="dodaj" style="'.$dodaje.'"type="button" value="obrona" onclick="ajax(21,';?>'dodaj'<?php echo',this.value,0,0)"></td></tr>
<tr><td id="statynazwa">SIŁA:</td><td id="statytlo">'.$staty[sila].'</td><td>+</td><td id="statytlo">'.$staty[dodajobrona].'</td><td></td><td></td><td></td><td style="position:relative;"><input id="dodaj" style="'.$dodaje.'"type="button" value="sila" onclick="ajax(21,';?>'dodaj'<?php echo',this.value,0,0)"></td></tr>
</form>



</table>



</div>

<div class="postacprawa">



<div class="przewijkacal">
	<input type="button" id="przewijkalewo" onclick="rusz(40);">
	<input type="button" id="przewijkaprawo" onclick="rusz(-40);">

<div class="przewijkaokno">
<div id="przewijkazaw" class="przewijkazaw">

<img src="grafika/umiejetnosci.png" style="width:52px; float:left;">
<img src="grafika/umiejetnosci.png" style="width:52px; float:left;">
<img src="grafika/umiejetnosci.png" style="width:52px; float:left;">
<img src="grafika/umiejetnosci.png" style="width:52px; float:left;">
<img src="grafika/umiejetnosci.png" style="width:52px; float:left;">
<img src="grafika/umiejetnosci.png" style="width:52px; float:left;">



</div></div></div>


<div class="widokpostac">
<img src="postaciduze/'.$user[plec].'.png" style="width:100%; height:100%; position:absolute; top:-20px; left:0px; z-index:5;">';

$umieszczone=mysql_fetch_array(mysql_query("SELECT * FROM umieszczone WHERE id_gracza='$user[id]' ;")); 
$i=1; while ($i<10)
{$item = mysql_fetch_array(mysql_query("SELECT * FROM unikalne WHERE id_przedmiotu=$umieszczone[$i];")); 
if ($item[wyswietl]!=''){
if ($i==7){$index=3;} elseif ($i==2){$index=4;} elseif ($i==5){$index=6;} elseif ($i==1 or $i==9){$index=7;} elseif ($i==6){$index=8;} elseif ($i==4){$index=9;} else {$index=10;}      
if (($i!==3 or $umieszczone[2]!==$umieszczone[3]) and file_exists("umieszczone/$item[nazwa].png")){echo '<img src="umieszczone/'.$item[nazwa].'.png" style="width:100%;  height:100%; position:absolute; top:-20px; left:0px; z-index:'.$index.';"> ';}} $i++;} 
echo'
</div>

</div>';


}// koniec elsa że postać
echo'</div></div></div>';// zamkniecie wszystkich ram


?>



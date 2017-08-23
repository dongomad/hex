<?php  
include 'blokada.php';
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';


// FUNKCJE:


$user = user::getData('', '');
$statystyki= mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$user[id] LIMIT 1;")); 

$cal=$_GET[cal]; $szer=60;








	echo '<div id="postacokno" class="pokaoknoprod" style="display:block;pointer-events:auto;">
	<div class="pokaoknohexprod" >
	<div id="usunramkaprod" >
	<form><input type="button" id="usunx" onclick="ajax (1);"></form>
	</div> 
	<div class="pokaoknotrescprod">';

	echo'<div class="pokaoknonaglowekprod">'.$user[nazwa].'</div>';

echo '<div style="top:150px; position:relative;left:50px; width:250px; height:250px;">
<img src="postaciduze/'.$user[id].'.png" style="width:100%; height:100%; z-index:5; position:absolute; left:0px;">

';

$umieszczone=mysql_fetch_array(mysql_query("SELECT * FROM umieszczone WHERE id_gracza='$user[id]' ;")); 
$i=1; while ($i<10)
{$item = mysql_fetch_array(mysql_query("SELECT * FROM unikalne WHERE id_przedmiotu=$umieszczone[$i];")); 
if ($item[wyswietl]!=''){
if ($i==7){$index=3;} elseif ($i==2){$index=6;} elseif ($i==5){$index=6;} elseif ($i==1 or $i==9){$index=7;} elseif ($i==6){$index=8;} elseif ($i==4){$index=9;} else {$index=10;}      
if (($i!==3 or $umieszczone[2]!==$umieszczone[3]) and file_exists("umieszczone/$item[nazwa].png")){echo '<img src="umieszczone/'.$item[nazwa].'.png" style="width:100%;  height:100%; position:absolute; top:0px; left:0px; z-index:'.$index.';"> ';}} $i++;} 

echo'</div></div>';




	echo'</div></div>';










?>


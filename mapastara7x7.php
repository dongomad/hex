﻿<?php  
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';

$user = user::getData('', ''); 
$statystyki= mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$user[id] LIMIT 1;")); 

//mysql_query("UPDATE $user[mapa] SET  skrypt='tnij', specjalne='drzewo', surowiec=200 WHERE id_pola=$user[lokalizacja]  "); 

// RUCH

if ($_GET[akcja]=='ruch'){
$id_pola = $_GET[z1]; 

$obecne= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$user[lokalizacja] LIMIT 1;")); 


if (($id_pola==$user[lokalizacja]-47) or ($id_pola==$user[lokalizacja]+47) or ($id_pola==$user[lokalizacja]-46) or ($id_pola==$user[lokalizacja]+46) or ($id_pola==$user[lokalizacja]+1) or ($id_pola==$user[lokalizacja]-1)){$q=$id_pola;}
else {$q=0;}

if ($q>0){

$cel= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$q LIMIT 1;")); 

if ($cel[skrypt]=='blokada' or $cel[skrypt]=='tnij' or $cel[skrypt]=='low' or $cel[skrypt]=='piecz'  or $cel[skrypt]=='wykuwaj'){$zak=1;}
elseif ($cel[skrypt]=='walka' or $cel[przeciwk]>0){echo 'trlololo walka';}


else{
if ($id_pola==$user[lokalizacja]+1){$ruch='ruchp';}

mysql_query("UPDATE users SET lokalizacja=$cel[id_pola] WHERE id=$user[id]"); 
$user = user::getData('', '');

}// koniec elsa że doszło do ruchu

}}// koniec ifa że q>0 i e akcja=ruch

else{
$cel= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$_GET[z1] LIMIT 1;")); 

switch ($cel[skrypt]){

case walka: echo 'walkawalka'; break;
case tnij: include 'oknoakcja.php'; break;
case wykuwaj: include 'oknoakcja.php'; break;
case rozwoj: include 'oknoakcja.php'; break;

}//koniec switcha
}//koniec elsa






// STYLE:



$obecne= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$user[lokalizacja] LIMIT 1;")); 

$inni = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE mapa=$user[mapa] and ;")); 

$now2= date("Y-m-d G:i:s", time ()-120 );
$inni=(mysql_query("SELECT id, nazwa, lokalizacja FROM users WHERE mapa='$user[mapa]' and online>'$now2'  and id NOT LIKE '$user[id]' LIMIT 10;"));
while ($inny= mysql_fetch_array($inni)){$ini[$inny[lokalizacja]][id]=$inny[id]; $ini[$inny[lokalizacja]][nazwa]=$inny[nazwa]; }


$sz=90;  $im=9;



echo'<div class="mapa"><div id="mapazaw">';


$mapa=$_SESSION[maapa];  

$i=1;
while ($i<=$im){
$i2=1;

if ($i==1 or $i==7){$i2m=4;}
elseif ($i==2 or $i==6){$i2m=5;}
elseif ($i==3 or $i==5){$i2m=6;}
else { $i2m=$im;}

$top=$sz/2+$i*($sz+6)/-4;
$left= (7-$i2m)*$sz/2;

if ($i>4 ){$mod=7-$i;} else {$mod=3;}
$idp=$obecne[id_pola]-(4-$i)*46 - $mod;




echo '<div style="width:'.($sz*$i2m).'px; height:'.$sz.'px; float:left;  position:relative; top:'.$top.'px; margin-left: '.$left.'px;"> '; // div kolumna

while ($i2<=$i2m){

$id_pola=$idp; $idp++;



echo '<div id="p'.$mapa[$id_pola][typ].'" style="position:relative; overflow:visible; float:left;">  ';

if ($mapa[$id_pola][specjalne]!==''){echo'<div style="position:absolute; z-index:3; pointer-events:none;  " id="s'.$mapa[$id_pola][specjalne].'" ></div> ';} 
//if ($ini[$id_pola][id]>0){echo '<img  src="postaci/'.$ini[$id_pola][id].'.png" title="'.$ini[$id_pola][nazwa].'" style="position:absolute;bottom:0px; left:0px; width:'.($sz).'px; z-index:3;"/>';}

if ($id_pola==$user[lokalizacja]){ echo '<div id="postac" style="z-index:3; "></div> ';}

// PRZYCISKI RUCHU/AKCJI :
elseif (($mapa[$id_pola][skrypt]!=='blokada') and (($id_pola==$user[lokalizacja]-47) or ($id_pola==$user[lokalizacja]+47) or ($id_pola==$user[lokalizacja]-46) or ($id_pola==$user[lokalizacja]+46) or ($id_pola==$user[lokalizacja]+1) or ($id_pola==$user[lokalizacja]-1)))
{

// WALKA:
if ($mapa[$id_pola][skrypt]=='walka'){echo '<input type="button" id="przyciskwalki"  value="'.$id_pola.'" onclick="poka(';?>'walka<?php echo $id_pola;?>'<?php echo' );">';
include 'oknowalka.php';}

elseif ($mapa[$id_pola][skrypt]!==''){
echo '<input type="button" id="przyciskakcji"  value="'.$id_pola.'" onclick=" ajax('.$_GET[cal].',';?>'<?php echo $mapa[$id_pola][skrypt];?>' <?php echo' ,this.value,0,0)">';
}// koniec elseifa że akcja

// RUCH:
else {echo '<input type="button" id="przyciskruchu"  value="'.$id_pola.'" onclick=" ajax('.$_GET[cal].',';?>'ruch' <?php echo' ,this.value,0,0)">';}// koniec elsa że normalny ruch
}// koniec elseifa że przyciski ruchu

if ($mapa[$id_pola][skrypt]=='walka'){echo '<img  src="postaci/'.$mapa[$id_pola][przeciwnik].'.png" style="position:absolute;bottom:0px; left:0px; width:'.$sz.'px; z-index:3; pointer-events:none;"/> ';}



echo '</div>'; $i2++;} 

echo ' </div>';// koniec diva kolumny

$i++;}





echo'</form></div></div>';



?>

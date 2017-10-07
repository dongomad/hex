<?php  
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';

$user = user::getData('', ''); 
$statystyki= mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$user[id] LIMIT 1;")); 

// DO ZMIANY: pobieranie z ustawień informacji, czy dblclick przy wchodzeniu w lokalizacje - opcje: '' albo 'dbl'
$dbl='';


//mysql_query("UPDATE $user[mapa] SET  skrypt='produkcja', specjalne='kowal', surowiec=0, przeciwnik=0 WHERE id_pola=$user[lokalizacja]  "); 

//mysql_query("UPDATE $user[mapa] SET  specjalne='wieza' WHERE id_pola=$user[lokalizacja]  "); 

//mysql_query("UPDATE $user[mapa] SET  przeciwnik=11, skrypt='walka' WHERE id_pola=$user[lokalizacja]  "); 


// RUCH

$id_pola = $_GET[z1]; 
$obecne= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$user[lokalizacja] LIMIT 1;")); 
$cel= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$q LIMIT 1;")); 



if (($id_pola==$user[lokalizacja]-47) or ($id_pola==$user[lokalizacja]+47) or ($id_pola==$user[lokalizacja]-46) or ($id_pola==$user[lokalizacja]+46) or ($id_pola==$user[lokalizacja]+1) or ($id_pola==$user[lokalizacja]-1)){$q=$id_pola;}
else {$q=0;}

if ($_GET[akcja]=='ruch'){

if ($q>0){

if ($cel[skrypt]=='blokada' or $cel[skrypt]=='tnij' or $cel[skrypt]=='low' or $cel[skrypt]=='piecz'  or $cel[skrypt]=='wykuwaj'){$zak=1;}
elseif ($user[energia]<1){$efekt='nie masz energii!';}
else{

mysql_query("UPDATE users SET lokalizacja=$q, energia=energia-1 WHERE id=$user[id]"); 
$user = user::getData('', '');

}// koniec elsa że doszło do ruchu

}}// koniec ifa że q>0 i e akcja=ruch

elseif (($akcja==$cel[skrypt] and $cel[id_pola]>0) or $akcja==walkagracz ){


switch ($akcja){

case walka: require 'funkcje/walka.php';  walka (0,0,$cal); break;
case walkagracz: require 'funkcje/walka.php';  walka ($z1,samtowpisalem,$cal); break;
case tnij: include 'oknoakcja.php'; break;
case wykuwaj: include 'oknoakcja.php'; break;
case rozwoj: include 'oknoakcja.php'; break;
case produkcja: include 'oknoprodukcja.php'; break;


default: include 'oknoakcja.php'; break;

}//koniec switcha

if ($przekazanazmiennaowalce>0){echo 'walka!'; require_once 'funkcje/walka.php'; walka($przekazanazmiennaowalce,samtowpisalem,$cal,$akcja,$z1,$z2,$z3);}

}//koniec elsa



$obecne= mysql_fetch_array(mysql_query("SELECT * FROM $user[mapa] WHERE id_pola=$user[lokalizacja] LIMIT 1;")); 


$now2= date("Y-m-d G:i:s", time ()-120 );
$inni=(mysql_query("SELECT id, nazwa, lokalizacja FROM users WHERE mapa='$user[mapa]'  and id NOT LIKE '$user[id]' ;")); //and online>'$now2'
while ($inny= mysql_fetch_array($inni)){$ini[$inny[lokalizacja]][id]=$inny[id]; $ini[$inny[lokalizacja]][nazwa]=$inny[nazwa]; }


$sz=90;  $im=9;



echo'<div class="mapa"><div id="mapazaw">';


$mapa=$_SESSION[maapa];  $p=0;


$i=1;
while ($i<=$im){
$i2=1;

if ($i==1 or $i==$im){$i2m=floor($im/2)+1;}
elseif ($i==2 or $i==$im-1){$i2m=floor($im/2)+2;}
elseif ($i==3 or $i==$im-2){$i2m=floor($im/2)+3;}
elseif ($i==4 or $i==$im-3){$i2m=floor($im/2)+4;}
else { $i2m=$im;}

$top=$sz/2+$i*($sz+6)/-4;
$left= (7-$i2m)*$sz/2;


if ($i>4 ){$mod=$im-$i;} else {$mod=floor($im/2);}
$idp=$obecne[id_pola]-(floor($im/2)+1-$i)*46 - $mod;


echo '<div style="width:'.($sz*$i2m).'px; height:'.$sz.'px; float:left;  position:relative; top:'.$top.'px; margin-left: '.$left.'px;"> '; // div kolumna

while ($i2<=$i2m){

$id_pola=$idp; $idp++;




echo '<div id="p'.$mapa[$id_pola][typ].'" style="position:relative; overflow:visible; float:left;">  ';

if ($mapa[$id_pola][specjalne]!==''){echo'<div style="position:absolute; z-index:3; pointer-events:none;  " id="s'.$mapa[$id_pola][specjalne].'" ></div> ';} 


// INNI GRACZE
if ($ini[$id_pola][id]>0){$l=0;$leftp=0;$ilutu=0;
$innitu=(mysql_query("SELECT id, nazwa,lokalizacja FROM users WHERE mapa='$user[mapa]' and lokalizacja=$id_pola  and id NOT LIKE '$user[id]' ;")); //and online>'$now2'
$ilutu=mysql_num_rows($innitu); if($ilutu>1){$leftp=floor($ilutu/2)*20;} 

while ($innytu=mysql_fetch_array($innitu)){$index=2+$ilutu-$l; if ($index>8){$index=8;}
echo '<div style="z-index:'.$index.'; ';

if (file_exists("postaci/$innytu[id].png")){echo' background: url(postaci/'.$innytu[id].'.png) ';}
else {echo' background: url(postaci/brak.png) ';}

echo'0px 0px;  background-size:'.($sz*1.6).'px; width:'.($sz*1.6).'px; height:'.($sz*1.6).'px;
position:absolute; bottom:'.($l*15).'px; left:'.($l*20-$leftp-$sz*0.3).'px;pointer-events:none;">
<center><b class="nazwainny">'.$innytu[nazwa].'</b></center>
</div> ';
if ($innytu[lokalizacja]==$user[lokalizacja] or $innytu[lokalizacja]==$user[lokalizacja]+1 or $innytu[lokalizacja]==$user[lokalizacja]-1 or $innytu[lokalizacja]==$user[lokalizacja]-47 or $innytu[lokalizacja]==$user[lokalizacja]+47 or $innytu[lokalizacja]==$user[lokalizacja]+46 or $innytu[lokalizacja]==$user[lokalizacja]-46)
{$inniwokol[$p][id]=$innytu[id];$p++;}

$l++;}//koniec whila

}// koniec ifa czy sa inni gracze na polu



// TWOJA POSTAC
if ($id_pola==$user[lokalizacja]){ echo '<div id="postac" style="z-index:3; "></div> ';}

// PRZYCISKI RUCHU/AKCJI :
elseif (($mapa[$id_pola][skrypt]!=='blokada') and (($id_pola==$user[lokalizacja]-47) or ($id_pola==$user[lokalizacja]+47) or ($id_pola==$user[lokalizacja]-46) or ($id_pola==$user[lokalizacja]+46) or ($id_pola==$user[lokalizacja]+1) or ($id_pola==$user[lokalizacja]-1)))
{

// WALKA:
if ($mapa[$id_pola][skrypt]=='walka'){echo '<input type="button" id="przyciskwalki"  value="'.$id_pola.'" on'.$dbl.'click="poka(';?>'walka<?php echo $id_pola;?>'<?php echo' );">';
include 'oknowalka.php';}

elseif ($mapa[$id_pola][skrypt]!==''){
echo '<input type="button" id="przyciskakcji"  value="'.$id_pola.'" on'.$dbl.'click=" ajax('.$_GET[cal].',';?>'<?php echo $mapa[$id_pola][skrypt];?>' <?php echo' ,this.value,0,0)">';
}// koniec elseifa że akcja

// RUCH:
else {echo '<input type="button" id="przyciskruchu"  value="'.$id_pola.'" onclick=" ajax('.$_GET[cal].',';?>'ruch' <?php echo' ,this.value,0,0)">';}// koniec elsa że normalny ruch
}// koniec elseifa że przyciski ruchu

if ($mapa[$id_pola][skrypt]=='walka'){echo '<img  src="postaci/'.$mapa[$id_pola][przeciwnik].'.png" style="position:absolute;bottom:0px; left:-15px; width:'.($sz+30).'px; z-index:3; pointer-events:none;"/> ';}



echo '</div>'; $i2++;} 

echo ' </div>';// koniec diva kolumny

$i++;}

echo'</form></div></div>';


// MISJE I INNI 

$user = user::getData('', ''); $l=$user[lokalizacja];
$misjespis = mysql_query("SELECT * FROM misjespis WHERE mapa='$user[mapa]' and minpoziom<=$user[poziom] and (lokalizacja=$l or (lokalizacja=$l-47) or (lokalizacja=$l+47) or (lokalizacja=$l-46) or (lokalizacja=$l+46) or (lokalizacja=$l+1) or (lokalizacja=$l-1)) ;");
$m=mysql_num_rows($misjespis);
 
if ($p>0 or $m>0){include 'inni.php'; $inniplik=1;}

?>




<?php  
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';

$user = user::getData('', ''); 
$statystyki= mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$user[id] LIMIT 1;")); 

$id=$user[id]; $atakowanyid=$z1;
date_default_timezone_set('Europe/Warsaw');
$now = date("Y-m-d G:i:s", time () ); 


// SPRAWDZ CZY ISTNIEJE WALKA
$walka = mysql_fetch_array(mysql_query("SELECT * FROM walka WHERE gracz1='$user[id]'  and stan NOT LIKE 'koniec' ;"));


// STWORZ WALKE JESLI NIE TRWA
if ($walka[id_walki]<1){
mysql_query("INSERT INTO walka (gracz1, gracz2, aktywnosc, stan) VALUES ('$id', '$atakowanyid', '$now', 'gracz1' );") or die ('[E]: Nie udało się utworzyć nowej walki ');  
$walka = mysql_fetch_array(mysql_query("SELECT * FROM walka WHERE gracz1='$user[id]'  and stan NOT LIKE 'koniec' ;"));

mysql_query("UPDATE users SET stan='walka' WHERE id='$user[id]'  ");

}

// NADAJ AKTYWNOSC PO PRZEŁADOWANIU
else {mysql_query("UPDATE walka SET aktywna='$now' WHERE id_walki=$walka[id_walki]  ");}



$ilezostalo=$now-$walka[aktywnosc]+10;


echo '<div>'.$user[stan].'-'.$walka[id_walki].'

<div id="zegar"></div>

<center>ekran walki </br> stan: '.$walka[stan].' </br> czas: '.$walka[aktywnosc].'</br> zostalo: '.$ilezostalo.'

</br>

<form>
<div  id="buttonatak" style="position:relative;">
<input type="button" style="pointer-events:auto; width:100%; height:100%; background-color:transparent; border:0px; color:transparent;"  onclick="ajax(1, ';?>1, 'skoncz'<?php echo',0,0)">
<div id="buttonatakgrafika"></div>
</div>
</form>

 </center> </div>

';





echo '<div style="position:fixed; border:1px solid red; right:10px; bottom:10px;">
'.$cal.'</br>'.$akcja.'</br>'.$z1.'</br>'.$z2.'</br>'.$z3.'</br>'.$obecne[x].':'.$obecne[y].':'.$obecne[typ].':'.$obecne[specjalne].'</br> '.$error.'</br> '.$now.'
</br><a href="index.php?akcja=wyloguj">wyloguj</a> '.$user[nazwa].' </div>

';

?>

<script type="text/javascript">
   function odliczaj(o,sek)
   {
      o.innerHTML=sek
      if(sek > 0)
      {
         set = setTimeout(function(){odliczaj(o,--sek)},1e3)
      }
      elseif (sek == 0)
      {
	ajax (1,1,1,1,1)
      }
   }
   
odliczaj(document.getElementById('zegar'), <?php echo $ilezostalo;?>)
</script>
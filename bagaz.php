    <script type="text/javascript">

    function pokazoknoakcjabagaz (akcja,nazwa,naglowek) {
       var e = document.getElementById('oknoakcjabagaz');

       if( e.style.display == 'block' && !akcja){e.style.display = 'none';  }
       else{
         	e.style.display = 'block'; 
  		var nag = document.getElementById('bagaznaglowek'); 
  		var naz = document.getElementById('buttonakcjanazwa');
		document.getElementById('kolkoakcjazmien').id="kolko"+akcja;
		nag.innerHTML = naglowek;
		naz.onclick = function(){pobierz(); ajax(<?php echo $_GET[cal];?>,akcja,nazwa,this.value,<?php echo $z3;?>);}; 

	}           
    }


</script>


<?php  
include 'blokada.php';
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';
require_once 'funkcje/zaloz.php'; 
require_once 'funkcje/zdejmij.php';

// FUNKCJE:

if ($_GET[akcja]=='zaloz'){$efekt= zaloz();} // 
elseif ($_GET[akcja]=='zdejmij'){ $efekt= zdejmij();} // 
elseif ($_GET[akcja]=='usun'){require_once 'funkcje/usun.php'; $efekt= usun();}
elseif ($_GET[akcja]=='usununik' or $_GET[akcja]=='usunzaznaczone'){require_once 'funkcje/usununik.php'; $efekt= usununik();}
elseif ($_GET[akcja]=='zjedz'){require_once 'funkcje/zjedz.php'; $efekt= zjedz();}
elseif (($_GET[akcja]=='przekazunik' or $_GET[akcja]=='przekazzaznaczone') and $z3>0){require_once 'funkcje/przekazunik.php'; $efekt=przekazunik($z3,$user[id],$z1);}
elseif ($_GET[akcja]=='przekaz' and $z3>0){require_once 'funkcje/przekaz.php'; $efekt= przekaz ($user[id],$z1,$z2,$z3);}



if ($z3>0 and ($akcja=='przekazunik' or $akcja=='przekaz' or $akcja=='przekazzaznaczone' or $akcja=='prz' or $akcja=='0')){$przekaz='przekaz';}

$user = user::getData('', '');
$umieszczone= mysql_fetch_array(mysql_query("SELECT * FROM umieszczone WHERE id_gracza=$user[id] LIMIT 1;")); 
$posiadane= mysql_fetch_array(mysql_query("SELECT * FROM posiadane WHERE id_gracza=$user[id] LIMIT 1;")); 



$cal=$_GET[cal];
switch ($cal){

case 31: $przedmioty = (mysql_query("SELECT * FROM unikalne WHERE klasa='bron' and handelcena<1 and id_gracza=$user[id] ORDER BY atak, awytrzymalosc  ;")); $klasa='bron'; $dodaje='dodaje:'; $zabiera='wymaga:'; break;
case 32: $przedmioty = (mysql_query("SELECT * FROM unikalne WHERE klasa='pancerz' and handelcena<1 and id_gracza=$user[id] ORDER BY gdzie, obrona, awytrzymalosc  ;")); $klasa='pancerz'; $dodaje='dodaje:'; $zabiera='wymaga:'; break;
case 33: $przedmioty = (mysql_query("SELECT * FROM przedmioty WHERE (klasa='pokarm' or klasa='lek')  ORDER BY dodajko, dodajzycie  ;")); $klasa='pokarm'; $dodaje='regeneruje:'; $zabiera='zabiera:'; $nieunik=1; break;
case 34: $przedmioty = (mysql_query("SELECT * FROM przedmioty WHERE (klasa='surowiec' or klasa='narzedzie')  ORDER BY klasa,gdzie,nazwa  ;")); $klasa='surowce'; $dodaje=''; $zabiera=''; $nieunik=1; break;
case 35: $przedmioty = (mysql_query("SELECT * FROM unikalne WHERE (klasa='cenne' or klasa='lokomocja') and handelcena<1  and id_gracza=$user[id] ORDER BY gdzie, obrona, atak, awytrzymalosc ;")); $klasa='cenne'; $dodaje='dodaje:'; $zabiera='wymaga:'; break;

}


$i=0; $items=1; $im=11; $szer=60; if ($inniplik==1){$im=9;}
$suma=mysql_num_rows($przedmioty); 

echo'<div style="pointer-events:none; width:900px; height:500px;z-index:12; position:absolute; top:55px; right:50px; ">
<form id="myform" name="myform" style="position:absolute; top:30px; right:-20px;">';

echo '<div id="opis"></div>';


while ($i<=$im or $items<=$suma){
$i2=1;
$i2m=$im;


echo '<div style="height:'.(($szer+10)*$i2m).'px; width:'.($szer+10).'px; float:right;  position:relative; margin:0px 10px;"> '; // div kolumna

while ($i2<=$i2m and $items<=$suma){
$item=mysql_fetch_array($przedmioty); $nazwa=$item[nazwa];

if ($nieunik!==1 or $posiadane[$nazwa]>0){

// wyswietlanie
$right= abs(6-$i2)*($szer+4)/2 - $i*$szer/2.3;
$top= $i2*$szer/-3;

// OPIS

$itemopis='';
if ($item[atak]>0){$itemopis.='+'.$item[atak].' ataku ';}
if ($item[obrona]>0){$itemopis.='+'.$item[obrona].' obrony ';}
if ($item[udzwig]>0){$itemopis.='+'.$item[udzwig].' udźwigu ';}

if ($item[minsila]>0 or $item[minzrecznosc]>0 or $item[minmadrosc]>0 or $item[minmoc]>0){
 $itemopis.='</br><b>wymaga:</b> ';
	if ($item[minsila]>0){$itemopis.=''.$item[minsila].' siły ';}
	if ($item[minzrecznosc]>0){$itemopis.=''.$item[minzrecznosc].' zręczności ';}
	if ($item[minmadrosc]>0){$itemopis.=''.$item[minmadrosc].' mądrości ';}
	if ($item[minmoc]>0){$itemopis.=''.$item[minmoc].' mocy ';}
}// koniec ifa czy wymagania

if ($item[dodajko]>0 or $item[dodajzycie]>0){
$itemopis.='<b>regeneruje:</b> ';
	if ($item[dodajko]>0){$itemopis.=''.$item[dodajko].' kondycji ';}
	if ($item[dodajzycie]>0){$itemopis.=''.$item[dodajzycie].' życia ';}
}

// PRZEDMIOTY UNIKALNE ZAŁOŻONE

if ($nieunik!==1){
$title=' '.$item[wyswietl].' ['.$item[awytrzymalosc].'/'.$item[wytrzymalosc].']'; 
$nazwa=$item[id_przedmiotu];
$prog=floor(59*$item[awytrzymalosc]/$item[wytrzymalosc]); if ($prog>59){$prog=59; $color='#a06800';} elseif ($prog<=5){$color='darkred';} else {$color='darkgreen';}
$progbar='<div id="progreszaw"><div id="progreszawzaw" style="width:'.$prog.'px; background-color:'.$color.';"></div> <div id="progrestresc">'.$item[awytrzymalosc].'/'.$item[wytrzymalosc].'</div></div>';

$bagakcja='zaloz';$um='';

$gdzie=$item[gdzie]; if ($item[gdzie]=='obie'){$gdzie='prawa';}
if ($umieszczone[$gdzie]==$item[id_przedmiotu]){$bagakcja='zdejmij'; $um='um';$checkbox='';$usun='';

$akcjabutton='<div id="kolkozdejm" title="zdejmij">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" value="'.$item[id_przedmiotu].'" onclick="ajax('.$_GET[cal].',';
$akcjabutton.="'zdejmij'";
$akcjabutton.=',this.value,0,0);"></div>';

}// koniec ifa ze zalozone

// PRZEDMIOTY UNIKALNE NIEZAŁOŻONE

else {$um=$przekaz;

$checkbox='<div id="checkbox"><p>  
<input type="checkbox" id="w'.$item[id_przedmiotu].'" name="wyrzuc[]" value="'.$item[id_przedmiotu].'">
<label for="w'.$item[id_przedmiotu].'" style="position:absolute; top:0px; left:0px;"></label></p></div>';

$usun='<div id="kolkousun" title="wyrzuć przedmiot">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" value="'.$item[id_przedmiotu].'" onclick=" ';
$usun.="  if (confirm ('Chcesz wyrzucić ten przedmiot?')) { ajax($_GET[cal],'usununik',this.value,0,0); }   ";
$usun.=' "> </div>';

// PRZEKAZANIE, a nie zdjęcie
if ($przekaz==przekaz){$bagakcja='przekazunik';
$akcjabutton='<div id="kolkoprzek" title="przekaż">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" value="'.$item[id_przedmiotu].'" onclick=" ';
$akcjabutton.="  if (confirm ('Chcesz przekazać ten przedmiot?')) { ajax ($_GET[cal],'przekazunik',this.value,0,$z3); }   ";
$akcjabutton.='"></div>';
}


// ZDJĘCIE, a nie przekazanie
else {
$akcjabutton='<div id="kolkozal" title="załóż">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" value="'.$item[id_przedmiotu].'" onclick="ajax('.$_GET[cal].',';
$akcjabutton.="'zaloz'";
$akcjabutton.=',this.value,0,0);"></div>';}

}// koniec elsa że nieumieszczone


}// koniec ifa że unikalne


// PRZEDMIOTY NIEUNIKALNE

else {$um=$przekaz;
$title=' '.$item[wyswietl].' x ['.$posiadane[$nazwa].'] ';
$progbar='<div id="progile">'.$posiadane[$nazwa].'</div>';

// PRZEKAZ zamiast jedzenia - małe okienko
if ($przekaz==przekaz){
$bagakcja='przekaz';
$przekaznaglowek='PRZEKAŻ</BR>'.$item[wyswietl].' ';

$akcjabutton='<div id="kolkoprzek" title="przekaż">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick=" ';
$akcjabutton.="  pokazoknoakcjabagaz ('przekaz','$item[nazwa]','$przekaznaglowek',0,$z3);    ";
$akcjabutton.=' "> </div>';
}

// JEDZENIE - male okienko
elseif ($klasa=='pokarm'){
$bagakcja='zjedz';

$zjedznaglowek='UŻYJ</BR>'.$item[wyswietl].' ';

$akcjabutton='<div id="kolkozjedz" title="użyj">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick=" ';
$akcjabutton.="  pokazoknoakcjabagaz ('zjedz','$item[nazwa]','$zjedznaglowek');    ";
$akcjabutton.=' "> </div>';


}

else{$bagakcja='brak';}

// USUWANIE 

$usunnaglowek='USUŃ</BR>'.$item[wyswietl].' ';

$usun='<div id="kolkousun" title="wyrzuć przedmiot">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick=" ';
$usun.="  pokazoknoakcjabagaz ('usun','$item[nazwa]','$usunnaglowek');    ";
$usun.=' "> </div>';

include 'oknobagaz.php';

}

echo '

<div id="bagazprzedmiot" title="'.$title.'" style="right:'.$right.'px; top:'.$top.'px; pointer-events:none;"> 

'.$checkbox.' '.$usun.' '.$akcjabutton.'

<input id="bagbutton" type="button" style=" pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" 
onclick="opis '; echo " ('$item[wyswietl]','$itemopis') "; echo' ;" ';

// PODWOJNY KLIK
if ($bagakcja!=='brak'){echo' ondblclick="ajax ('.$_GET[cal].' '; echo "  ,'$bagakcja','$nazwa',0,$z3"; echo' );" ';} echo'>


<div id="bagazprzedmiottlo'.$um.'">
<div  id="bagazprzedmiotgrafika"  style="background: url(przedmioty/'.$item[nazwa].'.png) 0px 0px; background-size:'.($szer*0.7).'px;" ></div>
'.$progbar.'
</div>

</div>
'; 




 $i2++;}//koniec ifa czy posiadasz dany przedmiot
 $items++;} // koniec whila rzedu

echo ' </div>';// koniec diva kolumny

$i++; }

// __ WYRZUC ZAZNACZONE
if ($nieunik!==1){

if ($przekaz=='przekaz'){$akcjazaznaczone=przekazzaznaczone; $kolko=przek; $title="przekaż zaznaczone";} else {$akcjazaznaczone=usunzaznaczone; $kolko=usun; $title='wyrzuć zaznaczone';}

echo '

<div id="kolko'.$kolko.'" title="'.$title.'" style="display:block; position:absolute; top:108px; right:-32px;">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick=" '; ?> if (confirm ('Wyrzucić zaznaczone?')) {submitForm();}"> <?php echo' 
</div>';


}



echo'</form></div>';


















?>


<script>
function submitForm() {
var form = document.myform;


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });

ajax (<?php echo $cal;?>, '<?php echo $akcjazaznaczone;?>', myCheckboxes,0,<?php echo $z3;?> );
}


function toggle(source) {
  checkboxes = document.getElementsByName('wyrzuc[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

 $("input").keyup(false);  

</script>        



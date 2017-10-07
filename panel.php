<link rel="stylesheet" href="style.css" type="text/css">
<html style="position:relative;overflow: auto;">
<?php
session_start();
error_reporting(0);

require 'config.php';
require_once 'user.class.php';
mysql_query("SET NAMES 'utf8'");

$user = user::getData('', '');


if ($user[id]!=='1'){die;}


echo'<div style="position:relative; width:80%; left:10%; height:auto; ">';

if ($_POST["nazwa"])
{mysql_query("INSERT INTO przedmioty (nazwa, wyswietl, klasa, typ, gdzie, atak, obrona, moc, udzwig, wytrzymalosc, utrata, minsila, minzrecznosc, minmadrosc, dodajzycie, dodajko, dodajmana, sklep, opis ) VALUES('$_POST[nazwa]', '$_POST[wyswietl]', '$_POST[klasa]', '$_POST[typ]', '$_POST[gdzie]', '$_POST[atak]', '$_POST[obrona]', '$_POST[moc]', '$_POST[udzwig]', '$_POST[wytrzymalosc]', '$_POST[utrata]', '$_POST[minsila]', '$_POST[minzrecznosc]', '$_POST[minmadrosc]', '$_POST[dodajzycie]', '$_POST[dodajko]', '$_POST[dodajmana]', '$_POST[sklep_kup]', '$_POST[opis]' );") or die ('<div class="efekt">nie udało się wstawic!</div>');
echo '<div class="efekt">wstawiono pomyślnie przedmiot <b>'.$_POST[wyswietl].'</b></div>';
if ($_POST[klasa]==surowiec or $_POST[klasa]==pokarm or $_POST[klasa]==narzedzie or $_POST[klasa]==mikstura) {mysql_query("ALTER TABLE posiadane ADD $_POST[nazwa] INT(5) NOT NULL ");} 
}//koniec wstawiania przedmiotu

elseif ($_POST["prodnazwa"])
{mysql_query("INSERT INTO produkcja (nazwa, wyswietl, zawod, lokalizacja, minpoziom, utrataeny, koszt, dodajexp, dodajzawod, narzedzie, sur1, ile1, sur2, ile2, sur3, ile3, sur4, ile4) VALUES('$_POST[prodnazwa]', '$_POST[prodwyswietl]', '$_POST[zawod]', '$_POST[lokalizacja]', '$_POST[poziom]', '$_POST[utrataeny]', '$_POST[koszt]', '$_POST[dodajexp]', '$_POST[dodajzawod]', '$_POST[narzedzie]', '$_POST[sur1]', '$_POST[ile1]', '$_POST[sur2]', '$_POST[ile2]', '$_POST[sur3]', '$_POST[ile3]', '$_POST[sur4]', '$_POST[ile4]' );") or die ('<div class="efekt">nie udało się wstawic!</div>');
echo '<div class="efekt">wstawiono pomyślnie przedmiot <b>'.$_POST[prodwyswietl].'</b></div>';}

elseif ($_POST["nazwabestia"])
{mysql_query("INSERT INTO users (nazwa, email, id, profesja, poziom, exp, aurar) VALUES('$_POST[nazwabestia]', '$_POST[prostanazwabestia]', '$_POST[idbestia]', '$_POST[profesja]', '$_POST[poziombestia]', '$_POST[expbestia]', '$_POST[aurarbestia]') ;") or die ('<div class="efekt">nie udało się wstawic [postac]!</div>');
mysql_query("INSERT INTO statystyki (id_gracza, atak, obrona, sila, zrecznosc, azycie, zycie, akondycja, kondycja, utrata, rozwoj) VALUES('$_POST[idbestia]', '$_POST[atakbestia]', '$_POST[obronabestia]', '$_POST[silabestia]', '$_POST[zrecznoscbestia]', '$_POST[zyciebestia]', '$_POST[zyciebestia]', '$_POST[kondycjabestia]', '$_POST[kondycjabestia]', '$_POST[utratabestia]', '100') ;") or die ('<div class="efekt">nie udało się wstawic [staty]!</div>');
mysql_query("INSERT INTO umieszczone (id_gracza) VALUES('$_POST[idbestia]') ;") or die ('<div class="efekt">nie udało się wstawic [umieszczone]!</div>');
mysql_query("INSERT INTO trofea (id_przeciwnika,trof1,szansa1,trof2,szansa2,trof3,szansa3,trof4,szansa4,trof5,szansa5,trof6,szansa6) VALUES('$_POST[idbestia]','$_POST[trof1]','$_POST[szansa1]','$_POST[trof2]','$_POST[szansa2]','$_POST[trof3]','$_POST[szansa3]','$_POST[trof4]','$_POST[szansa4]','$_POST[trof5]','$_POST[szansa5]','$_POST[trof6]','$_POST[szansa6]') ;") or die ('<div class="efekt">nie udało się wstawic [trofea]!</div>');

//mysql_query("ALTER TABLE zabite ADD $_POST[prostanazwabestia] INT(12) NOT NULL ");
echo '<div class="efekt">wstawiono pomyślnie postac <b>'.$_POST[nazwabestia].'</b></div>';}

//elseif ($_POST["nazwamisja"])
//{
//mysql_query("INSERT INTO misjespis (nazwa,wyswietl,etap,lokalizacja,kto, czas, minpoziom,typ,tresc,pyt,odp,pyt2,odp2,odrzuc,potwierdz,wykonaj,nagtresc, co1,ile1,co2,ile2,co3,ile3,co4,ile4,nagco1,nagile1,nagco2,nagile2,nagco3,nagile3,nagco4,nagile4) VALUES('$_POST[nazwamisja]', '$_POST[wyswietl]', '$_POST[etap]', '$_POST[lokalizacja]', '$_POST[kto]', '$_POST[czas]', '$_POST[minpoziom]', '$_POST[typ]', '$_POST[tresc]', '$_POST[pyt]', '$_POST[odp]', '$_POST[pyt2]', '$_POST[odp2]', '$_POST[odrzuc]', '$_POST[potwierdz]', '$_POST[wykonaj]', '$_POST[nagtresc]', '$_POST[co1]', '$_POST[ile1]', '$_POST[co2]', '$_POST[ile2]','$_POST[co3]', '$_POST[ile3]', '$_POST[co4]', '$_POST[ile4]', '$_POST[nagco1]', '$_POST[nagile1]', '$_POST[nagco2]', '$_POST[nagile2]', '$_POST[nagco3]', '$_POST[nagile3]', '$_POST[nagco4]', '$_POST[nagile4]' ) ;") or die ('<div class="efekt">nie udało się wstawic [misjespis]!</div>');
//if ($_POST[etap]=='0'){mysql_query("ALTER TABLE misje ADD $_POST[nazwamisja] SMALLINT(3) NOT NULL ");}
//echo '<div class="efekt">wstawiono pomyślnie misję <b>'.$_POST[wyswietl].'</b> etap '.$_POST[etap].'</div>';
//}//koniec wstawiania misji




$sumakasy =  mysql_fetch_array(mysql_query("SELECT SUM(aurar) FROM users "));



echo 'surowce na mapie + [u graczy]:
</br>aurar: <b>'.($sumakasy[0]+$skarbce[0]).'</b> 

';



echo'

<table style="width:100%; font-size:100%; height:auto;">
<tr><td>
<center><b> DODAWANIE NOWEGO PRZEDMIOTU: </b></center>

<form  method="post" action="panel.php">
<table style="font-size:100%; vertical-align:top;"><tr><td>
<b> NAZWA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nazwa">
</br><b> WYŚWIETL: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="wyswietl">

</br><b> KLASA: </b>
<select style="background: black; color: gold; border: 0px; border-radius: 7px; margin: 10px 0px 10px;" name="klasa">
<option value="bron">broń</option>
<option value="pancerz">pancerz</option>
<option value="cenne">cenne </option>
<option value="lokomocja">lokomocja</option>
<option value="surowiec">surowiec</option>
<option value="pokarm">pokarm</option>
<option value="mikstura">mikstura</option>
<option value="narzedzie">narzedzie</option>
</select>

</br><b> TYP: </b>
<select style="background: black; color: gold; border: 0px; border-radius: 7px; margin: 10px 0px 10px;" name="typ">
<option value=""></option>
<option value="masowy">masowy</option>
<option value="wyprodukowany">wyprodukowany</option>
<option value="rzadki">rzadki</option>

<option value="cieta">cięta</option>
<option value="obuchowa">obuchowa</option>
<option value="drzewcowa">drzewcowa</option>
<option value="strzelecka">strzelecka</option>
<option value="topor">topór</option>

<option value="lekki">lekki</option>
<option value="ciezki">ciężki</option>
<option value="smoczy">smoczy</option>
<option value="ubranie">ubranie</option>
<option value="run">run</option>
<option value="czar">czar</option>
<option value="unikatowy">unikatowy [brak usuwania]</option>

<option value="zwierze">zwierze</option>
</select>

</br><b> GDZIE: </b>
<select style="background: black; color: gold; border: 0px; border-radius: 7px; margin: 10px 0px 10px;" name="gdzie">
<option value=""></option>

<option value="lewa">lewa</option>
<option value="prawa">prawa</option>
<option value="obie">obie</option>
<option value="korpus">korpus</option>
<option value="glowa">glowa</option>
<option value="nogi">nogi</option>
<option value="plecy">plecy</option>
<option value="lokomocja">lokomocja</option>
<option value="szyja">szyja</option>
<option value="stopy">stopy</option>
<option value="pas">pas</option>
<option value="czar">czar</option>
<option value="kilof">kilof</option>
<option value="lopata">lopata</option>
<option value="siekiera">siekiera</option>
</select>

</br><b> ATAK: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="atak">
</br><b> OBRONA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="obrona">
</br><b> MOC: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="moc">
</br><b> UDŹWIG: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="udzwig">
</td><td>
</br></br><b> WYTRZYMAŁOŚĆ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="wytrzymalosc">
</br><b> UTRATA KO: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="utrata">

<br></br><b> min. SIŁA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="minsila">
</br><b> min. ZRĘCZNOŚĆ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="minzrecznosc">
</br><b> min. MĄDROŚĆ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="minmadrosc">
</br>
</br><b> +ŻYCIE: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="dodajzycie">
</br><b> +KONDYCJA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="dodajko">
</br><b> +MANA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="dodajmana">


</br></br>
</br><b> SKLEP: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="sklep_kup">
</br><b> OPIS: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="opis">

</td></tr><tr><td colspan=2">
<center><button type="submit" style="color: black; background-color: gold; border:1px solid grey; border-radius:4px;">WSTAW</button>
</td></tr></table>



</form>
</td><td>

<center><b> DODAWANIE PRODUKCJI: </b></center>


<form  method="post" action="panel.php">
<b> NAZWA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="prodnazwa">
</br><b> WYŚWIETL: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="prodwyswietl">
</br><b> ZAWÓD: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="zawod">
</br><b> LOKALIZACJA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="lokalizacja">

</br><b> min. POZIOM: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="poziom">
</br><b> utrata ENY: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="utrataeny">
</br><b> KOSZT: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="koszt">
</br><b> +EXP: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="dodajexp">
</br><b> +ZAWÓD: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="dodajzawod">
</br><b> NARZEDZIE: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="narzedzie">
</br>
</br><b> SUROWIEC 1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="sur1">
<input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px; width:20px;" name="ile1">
</br><b> SUROWIEC 2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="sur2">
<input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px; width:20px;" name="ile2">
</br><b> SUROWIEC 3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="sur3">
<input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px; width:20px;" name="ile3">
</br><b> SUROWIEC 4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="sur4">
<input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px; width:20px;" name="ile4">
<center><button type="submit" style="color: black; background-color: gold; border:1px solid grey; border-radius:4px;">WSTAW</button>

<form>


</td></tr>
<tr><td>

<center><b> SPIS PRZECIWNIKÓW I BESTII: </b></center>
</br>

<table style="font-size:100%; width:100%;"><tr><td>ID</td><td>NAZWA</td><td>EXP</td><td>AURAR</td><td>RESP</td><td style="background-color:yellow; color:black;">A</td><td>O</td><td style="background-color:yellow; color:black;">S</td><td>Zr</td><td style="background-color:yellow; color:black;">Ż</td><td>Ko</td><td>U</td><td>TROF1</td><td>TROF2</td><td>TROF3</td></tr>';


$bestie = mysql_query("SELECT * FROM users WHERE profesja='przeciwnik' or profesja='zwierze' or profesja='bestia' or profesja='minibestia'  ORDER BY profesja, id ");

while ($bestia = mysql_fetch_array($bestie)){
$staty = mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza='$bestia[id]' "));

echo'
<tr><td><b>'.$bestia[id].'</b></td><td>'.$bestia[nazwa].'</td><td>'.$bestia[exp].'</td><td>'.$bestia[aurar].'</td><td>'.$bestia[poziom].'</td><td style="background-color:yellow; color:black;">'.$staty[atak].'</td><td>'.$staty[obrona].'</td><td style="background-color:yellow; color:black;">'.$staty[sila].'</td><td>'.$staty[zrecznosc].'</td><td style="background-color:yellow; color:black;">'.$staty[zycie].'</td><td>'.$staty[kondycja].'</td><td>'.$staty[utrata].'</td><td>'.$bestia[trof1].'</td><td>'.$bestia[trof2].'</td><td>'.$bestia[trof3].'</td></tr>';
}
echo'</table>



</td><td>
<center><b> DODAWANIE NOWEGO PRZECIWNIKA: </b></center>

<form  method="post" action="panel.php">
<table style="font-size:100%; vertical-align:top;"><tr><td>
<b> NAZWA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nazwabestia">
<b> ID: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; width:33px; border-radius:7px; margin: 10px 0px 10px;" name="idbestia">
</br><b>PROSTA NAZWA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="prostanazwabestia">


</br><b> TYP: </b>
<select style="background: black; color: gold; border: 0px; border-radius: 7px; margin: 10px 0px 10px;" name="profesja">
<option value="przeciwnik">przeciwnik</option>
<option value="zwierze">zwierze</option>
<option value="minibestia">minibestia</option>
<option value="bestia">bestia</option>
</select>

</br><b> CO ILE RESP: </b> <input type="text" style="background: black; width: 23px; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="poziombestia">
</br><b> + EXP: </b> <input type="text" style="background: black; color: gold; width: 53px; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="expbestia">
</br><b> + AURAR <i font="size:60%;">[1:1 dla przeciwnika, 1% dla bestii]</i>: </b> <input type="text" style="background: black;width: 53px; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="aurarbestia">
<br> [wzrost statystyk [a,o,zr,s]: +1/3*poziom gracza dla przeciwników +1/2*poziom dla bestii]: 
</br><b> ATAK: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="atakbestia">
<b> OBRONA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px;width: 43px; margin: 10px 0px 10px;" name="obronabestia">
</br><b> SIŁA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px;width: 43px; margin: 10px 0px 10px;" name="silabestia">
<b> ZRĘCZNOŚĆ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px;width: 43px; margin: 10px 0px 10px;" name="zrecznoscbestia">
</br><b> ŻYCIE: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px;width: 43px; margin: 10px 0px 10px;" name="zyciebestia">
<b> KONDYCJA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px;width: 43px; margin: 10px 0px 10px;" name="kondycjabestia">
<b> UTRATA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px;width: 43px; margin: 10px 0px 10px;" name="utratabestia">

</br>
</br><b> TROF 1:  </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="trof1">
<b> SZ1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="szansa1">
</br><b> TROF 2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="trof2">
<b> SZ2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="szansa2">
</br><b> TROF 3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="trof3">
<b> SZ3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="szansa3">
</br><b> TROF 4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="trof4">
<b> SZ4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="szansa4">
</br><b> TROF 5: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="trof5">
<b> SZ5: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="szansa5">
</br><b> TROF 6: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="trof6">
<b> SZ6: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; width: 43px;margin: 10px 0px 10px;" name="szansa6">
</br> szansa: 100=1%, 10000=100%


</br></br><center><button type="submit" style="color: black; background-color: gold; border:1px solid grey; border-radius:4px;">WSTAW</button>
</form>
</table>


</td></tr>
<tr>


<td colspan="2" style="border-top:solid grey; border-bottom:solid grey;">

</br></br><center><b> DODAWANIE NOWEJ MISJI: </b></center>

<form  method="post" action="panel.php">
<table style="font-size:100%;"><tr><td width="40%">
<b> NAZWA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nazwamisja">
</br><b> WYŚWIETL/ NAGŁÓWEK: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="wyswietl">
</br><b> LOKALIZACJA: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="lokalizacja">
</br><b> KTO: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="kto">
</br><b> ETAP: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="etap">
</br><b> CZAS: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="czas">

</br><b> MINPOZIOM: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="minpoziom">

</br><b> TYP: </b>
<select style="background: black; color: gold; border: 0px; border-radius: 7px; margin: 10px 0px 10px;" name="typ">
<option value="przynies">przynieś</option>
<option value="zabij">zabij</option>
<option value="dalej">dalej [darmo]</option>
</select>
</td><td>

</br>

</br><b style="vertical-align:top;"> TREŚĆ: </b> <textarea  style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 650px; height: 42px" name="tresc"></textarea>
</br><b> PYT1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 250px;" name="pyt" value="brak">
<b> ODP1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 250px;" name="odp" value="brak">
</br><b> PYT2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 250px;" name="pyt2" value="brak">
<b> ODP1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 250px;" name="odp2" value="brak">
</br><b> ODRZUĆ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 550px;" name="odrzuc" >
</br><b> POTWIERDŹ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 550px;" name="potwierdz" >
</br><b> WYKONAJ: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 550px;" name="wykonaj" >
</br><b style="vertical-align:top;"> NAGRODA TREŚĆ: </b> <textarea  style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;width: 650px; height: 42px" name="nagtresc"></textarea>







</td></tr><tr><td>

</br><b><center> WYMAGANIA:</center></b></br>
[dla <b>przynieś</b> co1,co2 itp to surowce; jeśli ma być aurar musi być jako pierwsze; dla <b>zabij</b> to przeciwnicy do zabicia, dla <b>dalej</b> to nieistotne]
</br><b> CO1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="co1">
<b> ILE1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="ile1">
</br><b> CO2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="co2">
<b> ILE2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="ile2">
</br><b> CO3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="co3">
<b> ILE3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="ile3">
</br><b> CO4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="co4">
<b> ILE4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="ile4">
</td><td>

</br></br><b><center> NAGRODY:</center></b>
</br><b> NAGCO1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagco1">
<b> NAGILE1: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagile1">
</br><b> NAGCO2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagco2">
<b> NAGILE2: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagile2">
</br><b> NAGCO3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagco3">
<b> NAGILE3: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagile3">
</br><b> NAGCO4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagco4">
<b> NAGILE4: </b> <input type="text" style="background: black; color: gold; border:1px solid grey; border-radius:7px; margin: 10px 0px 10px;" name="nagile4">
</td></tr></table>


<center><button type="submit" style="color: black; background-color: gold; border:1px solid grey; border-radius:4px;">WSTAW</button>




</form>






</td></tr>





<tr><td id="logi"><b><center>LOGI</center></b>

</br></br>';

if ($_GET[desc]=='' or $_GET[desc]=='tak'){$_GET[desc]='nie'; $czydesc='DESC'; }
elseif ( $_GET[desc]=='nie'){$_GET[desc]='tak'; $czydesc='';}

echo'
<table style="border: 1px solid white;"><tr style="border: 1px solid white;">
<td> <a href="panel.php?order=id_gracza&desc='.$_GET[desc].'#logi">id</a>  </td>
<td><a href="panel.php?order=ostatnio_zalogowany&desc='.$_GET[desc].'#logi">o_id</a></td> 
<td><a href="panel.php?order=data&desc='.$_GET[desc].'#logi">data</a></td> 
<td><a href="panel.php?order=ip&desc='.$_GET[desc].'#logi">ip</a></td> 
<td><a href="panel.php?order=host&desc='.$_GET[desc].'#logi">host</a></td> 

</tr> ';

if ($_GET[order]=='' or !$_GET[order]){$_GET[order]='data'; $czydesc='DESC';}

$logi= mysql_query("SELECT * FROM logi ORDER BY $_GET[order] $czydesc ");


while ($item = mysql_fetch_array($logi)){echo '<tr ><td style="border: 1px solid white;">'.$item[id_gracza].'</td><td style="border: 1px solid white;">'.$item[ostatnio_zalogowany].'</td><td style="border: 1px solid white;">'.$item[data].'</td><td style="border: 1px solid white;">'.$item[ip].'</td><td style="border: 1px solid white;">'.$item[host].'</td></tr>';}
echo'</table>


<td>
<B>BEZ GRAFIKI:</b>';

$przedmioty = mysql_query("SELECT * FROM przedmioty ORDER BY klasa, typ, nazwa ");

while ($item = mysql_fetch_array($przedmioty)){if (!file_exists("przedmioty/$item[nazwa].png")) {echo ' </br> '.$item[nazwa].' ';}}
echo'</td>



</td></tr></table> ';//koniec calej tabeli

?>
<?php
require_once 'funkcje/utworz.php';
require_once 'funkcje/error.php';

$user = user::getData('', '');
$misjegracz = mysql_fetch_array(mysql_query("SELECT * FROM misje WHERE id_gracza=$user[id];"));
$obecna = mysql_fetch_array(mysql_query("SELECT * FROM misjespis WHERE id_misji=$z1  ;")); $nazwa=$obecna[nazwa];
$posiadane= mysql_fetch_array(mysql_query("SELECT * FROM posiadane WHERE id_gracza=$user[id] ;")); 
$swiat= mysql_fetch_array(mysql_query("SELECT * FROM swiat WHERE swiat=1 ;")); 


$_GET[misja]=$z2;

if ($misjegracz[$nazwa]!==$obecna[etap]){$efekt='zły etap misji ';}
elseif ($obecna[id_misji]<1){$efekt='nie ma takiej misji';}
else {

	// --------------PORAŻKA:	
if ($obecna[czas]>0){
	if ($obecna[typ]=='zabij'){$akcja1 = mysql_fetch_array(mysql_query("SELECT * FROM misjeakcje WHERE misja='$obecna[nazwa]' and co1='$obecna[co1]' and id_gracza='$user[id]' ORDER BY tura DESC LIMIT 1;"));  }
	else {$akcja1 = mysql_fetch_array(mysql_query("SELECT * FROM misjeakcje WHERE  co1='$obecna[nazwa]' and ile1='$obecna[etap]' and id_gracza='$user[id]' LIMIT 1;"));  }

	if ($akcja1[koniec]<$swiat[tura] and $akcja1[koniec]>0 and $obecna[porazka]>=0){
		mysql_query("UPDATE misje SET $obecna[nazwa]=$obecna[porazka] WHERE Id_gracza='$user[id]'  "); 
		mysql_query("DELETE FROM misjeakcje WHERE id_gracza='$user[id]' and (co1='$obecna[nazwa]' or misja='$obecna[nazwa]')  ;"); 
		$efekt='misja uległa przedawnieniu';}
}




	//--------PRZYNIEŚ-WARUNKI WYKONANIA:

if ($obecna[typ]=='przynies'){
		//__ WCZYTANIE WYMAGANYCH PRZEDMIOTÓW

		if ($obecna[co1]=='aurar'){$posiadane[$obecna[co1]]=$user[aurar];}
		elseif ($obecna[ile1]>0){$co1 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[co1]'  ;")); if ($co1[klasa]!=='surowiec' or $co1[klasa]!=='narzedzie' or $co1[klasa]!=='mikstura' or $co1[klasa]!=='pokarm'){$item1 = mysql_fetch_array(mysql_query("SELECT * FROM unikalne WHERE id_gracza='$user[id]' and nazwa='$obecna[co1]' and handelcena<1  ORDER BY awytrzymalosc LIMIT 1 ")); if($item1[awytrzymalosc]>0){$posiadane[$obecna[co1]]=1;}   }   }//koniec nag1
		if ($obecna[ile2]>0){$co2 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[co2]'  ;")); if ($co2[klasa]!=='surowiec' or $co2[klasa]!=='narzedzie' or $co2[klasa]!=='mikstura' or $co2[klasa]!=='pokarm'){$item2 = mysql_fetch_array(mysql_query("SELECT * FROM unikalne WHERE id_gracza='$user[id]' and nazwa='$obecna[co2]' and handelcena<1  ORDER BY awytrzymalosc LIMIT 1 "));if($item2[awytrzymalosc]>0){$posiadane[$obecna[co2]]=1;}}  }
		if ($obecna[ile3]>0){$co3 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[co3]'  ;")); if ($co3[klasa]!=='surowiec' or $co3[klasa]!=='narzedzie' or $co3[klasa]!=='mikstura' or $co3[klasa]!=='pokarm'){$item3 = mysql_fetch_array(mysql_query("SELECT * FROM unikalne WHERE id_gracza='$user[id]' and nazwa='$obecna[co3]' and handelcena<1  ORDER BY awytrzymalosc LIMIT 1 "));if($item3[awytrzymalosc]>0){$posiadane[$obecna[co3]]=1;}}  }
		if ($obecna[ile4]>0){$co4 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[co4]'  ;")); if ($co4[klasa]!=='surowiec' or $co4[klasa]!=='narzedzie' or $co4[klasa]!=='mikstura' or $co4[klasa]!=='pokarm'){$item4 = mysql_fetch_array(mysql_query("SELECT * FROM unikalne WHERE id_gracza='$user[id]' and nazwa='$obecna[co4]' and handelcena<1  ORDER BY awytrzymalosc LIMIT 1 "));if($item4[awytrzymalosc]>0){$posiadane[$obecna[co4]]=1;}}  }

		if (($posiadane[$obecna[co1]]>=$obecna[ile1] or $obecna[ile1]<1) and ($posiadane[$obecna[co2]]>=$obecna[ile2] or $obecna[ile2]<1) and ($posiadane[$obecna[co3]]>=$obecna[ile3] or $obecna[ile3]<1) and ($posiadane[$obecna[co4]]>=$obecna[ile4] or $obecna[ile4]<1) ){$war=1;} else {$war=0;} 
}// koniec ifa czy PRZYNIEŚ

	//--------ZABIJ-WARUNKI WYKONANIA:
elseif ($obecna[typ]=='zabij'){
	$zabite = mysql_fetch_array(mysql_query("SELECT * FROM zabite WHERE id_gracza='$user[id]';")); 
		if ($obecna[ile1]>0){$akcja1 = mysql_fetch_array(mysql_query("SELECT * FROM misjeakcje WHERE misja='$obecna[nazwa]' and co1='$obecna[co1]' and koniec>=$swiat[tura] and id_gracza='$user[id]' LIMIT 1;"));  }
		if ($obecna[ile2]>0){$akcja1 = mysql_fetch_array(mysql_query("SELECT * FROM misjeakcje WHERE misja='$obecna[nazwa]' and co1='$obecna[co2]' and koniec>=$swiat[tura] and id_gracza='$user[id]' LIMIT 1 ;")); }
		if ($obecna[ile3]>0){$akcja1 = mysql_fetch_array(mysql_query("SELECT * FROM misjeakcje WHERE misja='$obecna[nazwa]' and co1='$obecna[co3]' and koniec>=$swiat[tura] and id_gracza='$user[id]' LIMIT 1 ;")); }
		if ($obecna[ile4]>0){$akcja1 = mysql_fetch_array(mysql_query("SELECT * FROM misjeakcje WHERE misja='$obecna[nazwa]' and co1='$obecna[co4]' and koniec>=$swiat[tura] and id_gracza='$user[id]' LIMIT 1 ;")); }

		if ($obecna[ile1]>0 and $akcja1[id_akcji]<1){$war=0;} // zabezpieczenie jeśli nie wczytałoby akcji
		elseif (($zabite[$obecna[co1]]-$akcja1[ile1]>=$obecna[ile1] or $obecna[ile1]<1) and ($zabite[$obecna[co2]]-$akcja2[ile1]>=$obecna[ile2] or $obecna[ile2]<1) and ($zabite[$obecna[co3]]-$akcja3[ile1]>=$obecna[ile3] or $obecna[ile3]<1) and ($zabite[$obecna[co4]]-$akcja4[ile1]>=$obecna[ile4] or $obecna[ile4]<1)) {$war=1;} else {$war=0;} 
}// koniec elseifa ze misja zabij

//--------DALEJ-WARUNKI WYKONANIA:
elseif ($obecna[typ]=='dalej'){$war=1; }


//--------WYKONANIE MISJI:
if ($_GET[misja]=='wykonaj' and $war==1){

	//___DAWANIE NAGRODY:
	if ($obecna[nagco1]=='aurar'){mysql_query("UPDATE users SET aurar=aurar+$obecna[nagile1] WHERE Id='$user[id]'  "); }
	elseif ($obecna[nagco1]=='rozwoj'){mysql_query("UPDATE statystyki SET rozwoj=rozwoj+$obecna[nagile1] WHERE Id_gracza='$user[id]'  "); }
	elseif ($obecna[nagco1]=='exp'){mysql_query("UPDATE users SET exp=exp+$obecna[nagile1] WHERE Id='$user[id]'  "); }
	elseif ($obecna[nagile1]>0){$nag1 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[nagco1]'  ;")); if ($nag1[klasa]=='surowiec' or $nag1[klasa]=='narzedzie' or $nag1[klasa]=='mikstura' or $nag1[klasa]=='pokarm'){$ile=$posiadane[$obecna[nagco1]]; mysql_query("UPDATE posiadane SET $obecna[nagco1]=$ile+$obecna[nagile1] WHERE Id_gracza='$user[id]'  "); } else {utworz($nag1[nazwa]);}     }//koniec nag1
	
	if ($obecna[nagco2]=='aurar'){mysql_query("UPDATE users SET aurar=aurar+$obecna[nagile2] WHERE Id='$user[id]'  "); }
	elseif ($obecna[nagco2]=='rozwoj'){mysql_query("UPDATE statystyki SET rozwoj=rozwoj+$obecna[nagile2] WHERE Id_gracza='$user[id]'  "); }
	elseif ($obecna[nagco2]=='exp'){mysql_query("UPDATE users SET exp=exp+$obecna[nagile2] WHERE Id='$user[id]'  "); }
	elseif ($obecna[nagile2]>0){$nag2 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[nagco2]'  ;")); if ($nag2[klasa]=='surowiec' or $nag2[klasa]=='narzedzie' or $nag2[klasa]=='mikstura' or $nag2[klasa]=='pokarm'){$ile=$posiadane[$obecna[nagco2]]; mysql_query("UPDATE posiadane SET $obecna[nagco2]=$ile+$obecna[nagile2] WHERE Id_gracza='$user[id]'  "); } else {utworz($nag2[nazwa]);}     }//koniec nag2

	if ($obecna[nagile3]>0){$nag3 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[nagco3]'  ;")); if ($nag3[klasa]=='surowiec' or $nag3[klasa]=='narzedzie' or $nag3[klasa]=='mikstura' or $nag3[klasa]=='pokarm'){$ile=$posiadane[$obecna[nagco3]]; mysql_query("UPDATE posiadane SET $obecna[nagco3]=$ile+$obecna[nagile3] WHERE Id_gracza='$user[id]'  "); } else {utworz($nag3[nazwa]);}     }//koniec nag3
	if ($obecna[nagile4]>0){$nag4 = mysql_fetch_array(mysql_query("SELECT * FROM przedmioty WHERE nazwa='$obecna[nagco4]'  ;")); if ($nag4[klasa]=='surowiec' or $nag4[klasa]=='narzedzie' or $nag4[klasa]=='mikstura' or $nag4[klasa]=='pokarm'){$ile=$posiadane[$obecna[nagco4]]; mysql_query("UPDATE posiadane SET $obecna[nagco4]=$ile+$obecna[nagile4] WHERE Id_gracza='$user[id]'  "); } else {utworz($nag4[nazwa]);}     }//koniec nag4

	//___ZABIERANIE PRZEDMIOTÓW:
if ($obecna[typ]=='przynies'){
	if ($obecna[co1]=='aurar'){mysql_query("UPDATE postaci SET aurar=aurar-$obecna[ile1] WHERE Id='$user[id]'  "); }
	elseif ($obecna[ile1]>0){if ($co1[klasa]=='surowiec' or $co1[klasa]=='narzedzie' or $co1[klasa]=='mikstura' or $co1[klasa]=='pokarm'){$ile=$posiadane[$obecna[co1]]; mysql_query("UPDATE posiadane SET $obecna[co1]=$ile-$obecna[ile1] WHERE Id_gracza='$user[id]'  "); }  else {zniszcz ($item1[id_przedmiotu]);}     }//koniec nag1
	if ($obecna[ile2]>0){if ($co2[klasa]=='surowiec' or $co2[klasa]=='narzedzie' or $co2[klasa]=='mikstura' or $co2[klasa]=='pokarm'){$ile=$posiadane[$obecna[co2]]; mysql_query("UPDATE posiadane SET $obecna[co2]=$ile-$obecna[ile2] WHERE Id_gracza='$user[id]'  "); }  else {zniszcz ($item2[id_przedmiotu]);}      }//koniec nag2
	if ($obecna[ile3]>0){if ($co3[klasa]=='surowiec' or $co3[klasa]=='narzedzie' or $co3[klasa]=='mikstura' or $co3[klasa]=='pokarm'){$ile=$posiadane[$obecna[co3]]; mysql_query("UPDATE posiadane SET $obecna[co3]=$ile-$obecna[ile3] WHERE Id_gracza='$user[id]'  "); }  else {zniszcz ($item3[id_przedmiotu]);}       }//koniec nag3
	if ($obecna[ile4]>0){if ($co4[klasa]=='surowiec' or $co4[klasa]=='narzedzie' or $co4[klasa]=='mikstura' or $co4[klasa]=='pokarm'){$ile=$posiadane[$obecna[co4]]; mysql_query("UPDATE posiadane SET $obecna[co4]=$ile-$obecna[ile4] WHERE Id_gracza='$user[id]'  "); }  else {zniszcz ($item4[id_przedmiotu]);}       }//koniec nag4
}// koniec ifa czy przynieś

	mysql_query("UPDATE misje SET $obecna[nazwa]=$obecna[etap]+1 WHERE Id_gracza='$user[id]'  "); 
	$obecna[tresc]=$obecna[nagtresc]; 

}// koniec geta od wykonania

elseif ($_GET[misja]=='pytanie' and $obecna[pyt]!=='brak'){$odppost=$obecna[odp]; $odpgracz=$obecna[pyt];} 
elseif ($_GET[misja]=='pytanie2' and $obecna[pyt2]!=='brak'){$odppost=$obecna[odp2];$odpgracz=$obecna[pyt2];} 
elseif ($_GET[misja]=='potwierdz' and $obecna[typ]=='zabij'){$koniec=$swiat[tura]+$obecna[czas];
	if ($obecna[ile1]>0) {$za1=$zabite[$obecna[co1]]; mysql_query("INSERT INTO misjeakcje (id_gracza, co1, misja, tura, ile1, koniec) VALUES ('$user[id]', '$obecna[co1]', '$obecna[nazwa]', '$swiat[tura]','$za1', '$koniec');") or die ('<div class="efekt"> [E]: Nie udało się zapisać akcji.1 Zgłoś koniecznie ten błąd!</div>');}
	if ($obecna[ile2]>0) {$za2=$zabite[$obecna[co2]]; mysql_query("INSERT INTO misjeakcje (id_gracza, co1, misja, tura, ile1, koniec) VALUES ('$user[id]', '$obecna[co2]', '$obecna[nazwa]', '$swiat[tura]','$za2', '$koniec');") or die ('<div class="efekt"> [E]: Nie udało się zapisać akcji.2 Zgłoś koniecznie ten błąd!</div>');}
	if ($obecna[ile3]>0) {$za3=$zabite[$obecna[co3]]; mysql_query("INSERT INTO misjeakcje (id_gracza, co1, misja, tura, ile1, koniec) VALUES ('$user[id]', '$obecna[co3]', '$obecna[nazwa]', '$swiat[tura]','$za3', '$koniec');") or die ('<div class="efekt"> [E]: Nie udało się zapisać akcji.3 Zgłoś koniecznie ten błąd!</div>');}
	if ($obecna[ile4]>0) {$za4=$zabite[$obecna[co4]]; mysql_query("INSERT INTO misjeakcje (id_gracza, co1, misja, tura, ile1, koniec) VALUES ('$user[id]', '$obecna[co4]', '$obecna[nazwa]', '$swiat[tura]','$za4', '$koniec');") or die ('<div class="efekt"> [E]: Nie udało się zapisać akcji.4 Zgłoś koniecznie ten błąd!</div>');}	
}//koniec elseifa od tego ze wziales misje na zabicie

elseif ($_GET[misja]=='potwierdz'){
	if ($obecna[czas]>0){$koniec=$swiat[tura]+$obecna[czas]; mysql_query("INSERT INTO misjeakcje (id_gracza, co1, tura, ile1, koniec) VALUES ('$user[id]', '$obecna[nazwa]', '$swiat[tura]','$obecna[etap]', '$koniec');") or die ('<div class="efekt"> [E]: Nie udało się zapisać akcji. Zgłoś koniecznie ten błąd!</div>');}
} 

elseif ($_GET[misja]=='pytanieprogres'){
	$odppost='progres:</br>';
			if ($akcja1[id_gracza]>0){$odppost.='   <b>'.$obecna[co1].'</b> : '.($zabite[$obecna[co1]]-$akcja1[ile1]).'/'.$obecna[ile1].' ';} 
			if ($akcja2[ile1]>0){$odppost.='   <b>'.$obecna[co2].'</b> : '.($zabite[$obecna[co2]]-$akcja2[ile1]).'/'.$obecna[ile2].' ';} 
			if ($akcja3[ile1]>0){$odppost.='   <b>'.$obecna[co3].'</b> : '.($zabite[$obecna[co3]]-$akcja3[ile1]).'/'.$obecna[ile3].' ';} 
			if ($akcja4[ile1]>0){$odppost.='   <b>'.$obecna[co4].'</b> : '.($zabite[$obecna[co4]]-$akcja4[ile1]).'/'.$obecna[ile4].' ';} 
			if ($obecna[porazka]>=0){$odppost.='</br>[pozostało '.($akcja1[koniec]-$swiat[tura]).' tur]';}
	}//koniec elseifa pytanieprogres


//_______ WYŚWIETLANIE:


	// CZARNETLO

	echo '<div class="czarnetlocale" style="z-index:20;  background-color:rgba(0,0,0,0.8);">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  onclick="ajax ('.$cal.',0,0,0,0)">
	</div>';

	// NAGŁÓWEK - NAZWA MISJI
echo '<div class="misjacalosc"><div class="misjanazwa">'.$obecna[wyswietl].'</div>';	


	// NPC:

	echo'<div class="misjawypowiedz"> 
		<div  class="innitwarzbutton" style="transform:scale(1.4);position:absolute; top:16px; left:10px;z-index:5;pointer-events:none;">
		<div class="innitlo" style="background: url(grafika/podswietlone.png) 0px 0px;  background-size:90px; z-index:10;">	
		<div class="innitwarzobrazek" style="background: url(twarze/'.$obecna[kto].'.png) 0px 0px; background-size:90px;">	
		</div></div></div>
		<div class="misjawypramka"><div class="misjawyptresc" style="left:80px;"> '.$obecna[tresc].' </div></div>
	</div>';


	// GRACZ:
	echo'
		<div class="misjawypowiedz" style="top:-20px;"> 
			<div  class="innitwarzbutton" style="transform:scale(1.4);position:absolute; top:16px; right:70px;z-index:5;">
			<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  onclick="ajax ('.$cal.',0,0,0,0)">
			<div class="innitlo" style="background: url(grafika/tlo.png) 0px 0px;  background-size:90px; z-index:10;">
			<div class="innitwarzobrazek" style="background: url(twarze/'.$user[id].'.png) 0px 0px; background-size:90px;">
			</div></div></div>';



if ($_GET[misja]!=='wykonaj'){

	// --- PYTANIE 1 ---
	if ($obecna[pyt]!=='brak'){	if (strlen($obecna[pyt])>50){$font='font-size:7px;';} else {$font='font-size:8px;';} 
					if ($z2=='pytanie'){$font.='color:white;';}
	echo '	<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:16px; right:210px;z-index:5;">
	<div class="innitlo" style="background: url(grafika/tlo.png) 0px 0px;  background-size:90px; z-index:10; display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$obecna[id_misji].',';?>'pytanie'<?php echo',0)"><div class="misjaspanpyt" style="'.$font.'">'.$obecna[pyt].'</div></div></div>';}

	// --- PYTANIE 2 ---
	if ($obecna[pyt2]!=='brak'){	if (strlen($obecna[pyt2])>50){$font='font-size:7px;';} else {$font='font-size:8px;';}
					if ($z2=='pytanie2'){$font.='color:white;';}
	echo '	<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:120px; right:140px;z-index:5;">
	<div class="innitlo" style="background: url(grafika/tlo.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$obecna[id_misji].',';?>'pytanie2'<?php echo',0)"><div class="misjaspanpyt" style="'.$font.'">'.$obecna[pyt2].'</div></div></div>';}

	// --- ODRZUĆ ---
	if (strlen($obecna[odrzuc])>60){$font=6;}else {$font=8;}
	echo '
	<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:120px; right:0px;z-index:5;">
	<div class="innitlo" style="background: url(grafika/tloczerwone.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',0,0,0,0)"><div class="misjaspanpyt" style="font-size:'.$font.'px;">'.$obecna[odrzuc].'</div></div></div>';

	// --- ZAKOŃCZ MISJE - SPEŁNIONE WARUNKI ---	
	if ($war>0){	if (strlen($obecna[odrzuc])>50){$font=7;}else {$font=8;}
	echo '<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:16px; right:-70px;z-index:5;">
	<div class="innitlo" style="background: url(grafika/tlozielone.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$obecna[id_misji].',';?>'wykonaj'<?php echo',0)"><div class="misjaspanpyt" style="'.$font.'; color:silver;">'.$obecna[wykonaj].'</div></div></div>';}

	// --- PRZYJMIJ MISJE ---
	elseif ($obecna[typ]=='przynies' and $obecna[czas]==0 ) {
	if (strlen($obecna[potwierdz])>50){$font='font-size:7px;';} else {$font='font-size:8px;';}
	echo '<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:-90px; right:0px;z-index:5;">
	<div class="innitlo" style="background: url(grafika/tlo.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',0,0,0,0)"><div class="misjaspanpyt" style="'.$font.'">'.$obecna[potwierdz].'</div></div></div>';}



	// --- PROGRES MISJI ZABIJ ---
	elseif ($obecna[typ]=='zabij' or ($obecna[typ]=='przynies' and $obecna[czas]>0)){

			// --- PRZYJMIJ MISJE (stwórz akcje)---
		if (($obecna[typ]=='zabij' or $obecna[typ]=='przynies') and $akcja1[id_gracza]<1){
			if (strlen($obecna[potwierdz])>50){$font='font-size:7px;';} else {$font='font-size:8px;';}
			echo '<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:-90px; right:0px;z-index:5;">
			<div class="innitlo" style="background: url(grafika/tlo.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
			<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
			onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$obecna[id_misji].',';?>'potwierdz'<?php echo',0)"><div class="misjaspanpyt" style="'.$font.'">'.$obecna[potwierdz].'</div></div></div>';}

		elseif ($akcja1[id_gracza]>0) {

			echo '<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:-90px; right:0px;z-index:5;">
			<div class="innitlo" style="background: url(grafika/tlo.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
			<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
			onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$obecna[id_misji].',';?>'pytanieprogres'<?php echo',0)"><div class="misjaspanpyt">Jak wygląda stan mojej misji?</div></div></div>';}

	}//koniec elseifa zabij

	elseif ($obecna[czas]>0){
	echo '<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:16px; right:210px; z-index:5;">
	<div class="innitlo" style="background: url(grafika/tlozielone.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',0,0,0,0)"><div class="misjaspanpyt">zostało: '.($akcja1[koniec]-$swiat[tura]).' tur</br> wracam do roboty</div></div></div>';}

}// koniec ifa że nie kliknąłeś wykonaj


	// --- DALEJ ---

else {$obecna = mysql_fetch_array(mysql_query("SELECT * FROM misjespis WHERE nazwa='$obecna[nazwa]' and etap=$obecna[etap]+1 ;"));

	echo '<div  class="innitwarzbutton" style="transform:scale(1.4); position:absolute; top:16px; right:210px; z-index:5;">
	<div class="innitlo" style="background: url(grafika/tlozielone.png) 0px 0px;  background-size:90px; z-index:10;display:table; ">
	<input type="button" style="cursor:pointer; pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;"  
	onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$obecna[id_misji].',';?>'dalej'<?php echo',0)"><div class="misjaspanpyt">[dalej]</div></div></div>';}




		echo'</div>'; //koniec misjawypowiedz gracza



//TRZECIA WYPOWIEDZ DIALOGU



if ($odppost){
		echo'<div class="misjawypowiedz" style="top:60px;" > 
			<div  class="innitwarzbutton" style="transform:scale(1.4);position:absolute; top:16px; left:10px;z-index:5;pointer-events:none;">
			<div class="innitlo" style="background: url(grafika/podswietlone.png) 0px 0px;  background-size:90px; z-index:10;">
			<div class="innitwarzobrazek" style="background: url(twarze/'.$obecna[kto].'.png) 0px 0px; background-size:90px;">
			</div></div></div>
			<div class="misjawypramka" style="width:488px;"><div class="misjawyptresc" style="left:80px;width:400px;"> '.$odppost.' </div></div>
		</div>';}


echo '</div>';}//koniec elsa od walidacji

?>


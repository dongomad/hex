<html>
<head>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<title>DONGO</title>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="Shortcut icon" href="grafika/logo.png"/>

<script src="jquery-2.2.3.js"></script>


</head>
<body>
    <script type="text/javascript">

        document.body.style.visibility= 'hidden';
        window.onload= function() { document.body.style.visibility= 'visible'; };

    function poka (id) {
       var e = document.getElementById(id);
       if( e.style.display == 'block'){ e.style.display = 'none';  }
       else{e.style.display = 'block'; }         
	}

    function opis (nazwa,opis) {
  	var e = document.getElementById('opis'); 
	e.innerHTML = '<center><b style="color:white;">'+ nazwa +'</b></br>'+opis+'</center>' ;
 	e.style.display = 'block'; 
    }


	function pokaopis (id){
		var $ = jQuery;
       		var e = document.getElementById(id);
       		if( e.style.display == 'block'){  $("div.bialypasek").hide();}	
		else { $("div.bialypasek").hide(); $("#"+id).show();}
	}



</script>






<?php
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';
mysql_query("SET NAMES 'utf8'");


if (user::isLogged ()){$user = user::getData('', '');}
else {include 'logowanie.php'; die; }

require_once 'funkcje/wgrajmape.php';
wgrajmape ();


$sz=90;  $szer=60; $im=7;

echo'
<style>

#przyciskruchu {cursor:pointer; position:absolute; width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/biale.png) 0px 0px; background-size:'.($sz*3).'px; border:0px;  color:transparent; z-index:2; overflow:hidden;}
#przyciskruchu:hover {background: url(mapa/biale.png) -'.$sz.'px 0px; background-size:'.($sz*3).'px;}
#przyciskruchu:active {background: url(mapa/biale.png) -'.(2*$sz).'px 0px; background-size:'.($sz*3).'px;}

#przyciskakcji { position:absolute; cursor:pointer; width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/zielone.png) 0px 0px; background-size:'.($sz*3).'px; border:0px;  color:transparent; z-index:2; overflow:hidden;}
#przyciskakcji:hover {background: url(mapa/zielone.png) -'.$sz.'px 0px; background-size:'.($sz*3).'px;}
#przyciskakcji:active {background: url(mapa/zielone.png) -'.(2*$sz).'px 0px; background-size:'.($sz*3).'px;}

#przyciskwalki { position:absolute; cursor:pointer; width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/czerwone.png) 0px 0px; background-size:'.($sz*3).'px; border:0px;  color:transparent; z-index:2; overflow:hidden;}
#przyciskwalki:hover {background: url(mapa/czerwone.png) -'.$sz.'px 0px; background-size:'.($sz*3).'px;}
#przyciskwalki:active {background: url(mapa/czerwone.png) -'.(2*$sz).'px 0px; background-size:'.($sz*3).'px;}

#przyciskbudynek{ position:absolute; cursor:pointer; width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/niebieskie.png) 0px 0px; background-size:'.($sz*3).'px; border:0px;  color:transparent; z-index:2; overflow:hidden;}
#przyciskbudynek:hover {background: url(mapa/niebieskie.png) -'.$sz.'px 0px; background-size:'.($sz*3).'px;}
#przyciskbudynek:active {background: url(mapa/niebieskie.png) -'.(2*$sz).'px 0px; background-size:'.($sz*3).'px;}



#postac{width:'.($sz*1.6).'px; height:'.($sz*1.6).'px; background: url(postaci/'.$user[id].'.png) 0px 0px; pointer-events:none; background-size:'.($sz*1.6).'px; bottom:'.($sz*0.1).'px; left:-'.($sz*0.3).'px; position:absolute;}
#mapazaw {width:'.($sz*$im).'px; height:'.($sz*$im).'px; position:relative; margin:auto;}



#ppole {width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/pole.png) 0px 0px; background-size:'.$sz.'px;}
#ppiach {width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/piach.png) 0px 0px; background-size:'.$sz.'px;}

#pwoda {width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/woda.png) 0px 0px; background-size:'.$sz.'px;}
#plowisko {width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/lowisko.png) 0px 0px; background-size:'.$sz.'px;}

#p {width:'.$sz.'px; height:'.$sz.'px; background: url(mapa/czarne.png) 0px 0px; background-size:'.$sz.'px;}



#sbudynek {width:'.($sz*2).'px; height:'.($sz*2).'px; background: url(mapa/budynek.png) 0px 0px; background-size:'.($sz*2).'px; left:-'.($sz/2).'px; }

#szatopionakolumna {width:'.($sz).'px; height:'.($sz).'px; background: url(mapa/zatopionakolumna.png) 0px 0px; background-size:'.($sz).'px; }
#skolumna {width:'.($sz).'px; height:'.($sz+15).'px; background: url(mapa/kolumna.png) 0px 0px; background-size:'.($sz).'px; bottom:15px; }

#sdrzewo {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/drzewo.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz*0.2).'px; bottom:8px; }
#sskala {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/skala.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz*0.2).'px; bottom:-8px; }
#sskala2 {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/skala2.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz*0.2).'px; bottom:-8px; }
#soltarz {width:'.(1.2*$sz).'px; height:'.(1.2*$sz).'px; background: url(mapa/oltarz.png) 0px 0px; background-size:'.($sz*1.2).'px; left:-'.($sz*0.1).'px; bottom:-5px;}



#skamien {width:'.($sz).'px; height:'.($sz).'px; background: url(mapa/kamien.png) 0px 0px; background-size:'.($sz).'px;  }
#skamulce {width:'.($sz).'px; height:'.($sz).'px; background: url(mapa/kamulce.png) 0px 0px; background-size:'.($sz).'px;  }
#sognisko {width:'.($sz).'px; height:'.($sz).'px; background: url(mapa/ognisko.png) 0px 0px; background-size:'.($sz).'px;  }


#smur {width:'.($sz).'px; height:'.($sz*1.5).'px; background: url(mapa/mur.png) 0px 0px; background-size:'.($sz).'px; bottom:0px; }

#smurp {width:'.($sz).'px; height:'.($sz*1.5).'px; background: url(mapa/murp.png) 0px 0px; background-size:'.($sz).'px; bottom:0px; }
#smurl {width:'.($sz).'px; height:'.($sz*1.5).'px; background: url(mapa/murl.png) 0px 0px; background-size:'.($sz).'px; bottom:0px; }
#smurpl {width:'.($sz).'px; height:'.($sz*1.5).'px; background: url(mapa/murpl.png) 0px 0px; background-size:'.($sz).'px; bottom:0px; }
#smurpp {width:'.($sz).'px; height:'.($sz*1.5).'px; background: url(mapa/murpp.png) 0px 0px; background-size:'.($sz).'px; bottom:0px; }


#sgory {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/gory.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz*0.2).'px; bottom:0px; }
#szelazo {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/zelazo.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz*0.2).'px; bottom:0px; }
#swegiel {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/wegiel.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz*0.2).'px; bottom:0px; }

#spal {width:'.(1.5*$sz).'px; height:'.(1.5*$sz).'px; background: url(mapa/pal.png) 0px 0px; background-size:'.(1.5*$sz).'px; left:0px; bottom:0px; }
#swieza {width:'.(1*$sz).'px; height:'.(2*$sz).'px; background: url(mapa/wieza.png) 0px 0px; background-size:'.(1*$sz).'px; left:0px; bottom:0px; }
#skowal {width:'.(1.4*$sz).'px; height:'.(1.4*$sz).'px; background: url(mapa/kowal.png) 0px 0px; background-size:'.(1.4*$sz).'px; left:-'.($sz/5).'px; bottom:0px; }


#slatarnia {width:'.($sz).'px; height:'.($sz).'px; background: url(mapa/latarnia.png) 0px 0px; background-size:'.($sz).'px; bottom:0px; }






/* BAGAZ */

#bagazprzedmiot {pointer-events:auto;border:0xp; background-none; margin:5px; width:'.$szer.'px; height:'.$szer.'px; background: url(grafika/ramka.png) 0px 0px; background-size:'.(2*$szer).'px; position:relative; overflow:visible; float:left;}
#bagazprzedmiot:hover {background: url(grafika/ramka.png) -'.$szer.'px 0px; background-size:'.(2*$szer).'px;}
#bagazprzedmiot:active {margin:2px;padding:3px;  background: url(grafika/ramka.png) -'.($szer+6).'px 0px; background-size:'.(2*($szer+6)).'px; }

#bagazprzedmiottlo {pointer-events:none; width:'.($szer).'px; height:'.($szer).'px; background: url(grafika/tlo.png) 0px 0px; background-size: '.($szer).'px; position:absolute; }
#bagazprzedmiottloum {pointer-events:none; width:'.($szer).'px; height:'.($szer).'px; background: url(grafika/podswietlone.png) 0px 0px; background-size: '.($szer).'px; position:absolute; }

#bagazprzedmiotgrafika {pointer-events:none;width:'.($szer*0.7).'px; height:'.($szer*0.7).'px; position:absolute; left:'.($szer*0.15).'px; top:'.($szer*0.15).'px; background-size:'.($szer*0.7).'px; }


#progreszaw {pointer-events:none;position:absolute; left:'.(($szer-62)/2).'px; bottom:4.5px; width:62px; height:12px; background-color:black; border-radius:5px; }
#progreszawzaw {position:absolute;bottom:1px; left:1.5px; height:10px; max-width:59px; border-radius:4px;  z-index:1;}
#progrestresc {position:absolute; left:0px; top:0px; width:62px; text-align:center; color:white; font-size:10px; z-index:2;}

#progile {z-index:3;width:18px; height:18px; background:darkgreen;border:2px solid black; border-radius:12px; position:absolute; bottom:1px; right:-3px;color: white;text-align:center; font-size:10px; line-height:20px;}

#bagazusun {z-index:5; cursor:pointer;  position:absolute; top:20px; right: 5px; pointer-events:auto; border:0px; background:none; width:20px;height:20px; background: url(grafika/usun.png) 0px 0px; background-size:20px; }
#bagazusun:active {position:absolute;width:24px;height:24px; top:18px; right: 3px; background: url(grafika/usun.png) 0px 0px; background-size:24px; }

#opis {display:none;  font-size:12px; position:absolute; top:-51px; right:240px; width:220px; height:48px; border-radius:4px; background: url(grafika/ramkaopis.png) 0px 0px; background-size:260px; padding:6px 20px; }

</style>';


include 'calosc.php'; 

?>


</body>
</html>

<script>
function ajax (cal,akcja,z1,z2,z3,z4) {

var ajax1 = $.ajax({
	url: "calosc.php",
	data: {cal:cal, akcja:akcja, z1:z1, z2:z2, z3:z3, z4:z4},
	success: function(data1){$("#calosc").html(data1);}
});
}
</script>
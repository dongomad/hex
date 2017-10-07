



<?php 
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';
require_once 'funkcje/abagaz.php';
$user = user::getData('', '');
abagaz ();
$staty= mysql_fetch_array(mysql_query("SELECT * FROM statystyki WHERE id_gracza=$user[id] LIMIT 1;")); 

$x=$user[lokalizacja]%46-3;
$y=floor ($user[lokalizacja]/46)-2;

echo '<div style="position:absolute; top:0px; left:100px; width:600px; height:14px; color:gold; font-size:14px;text-align:center; font-weight:bold;">
['.$x.' : '.$y.'] | aurar: '.$user[aurar].' | exp: '.$user[exp].'/'.$awanspoz[exp].' ['.$user[poziom].'] ko:'.$staty[akondycja].' ży: '.$staty[azycie].' e: '.$user[energia].' b:'.$staty[audzwig].'/'.$staty[udzwig].'+'.$staty[dodajudzwig].'

</div>';


// PROGRES ŻYCIA

//$prog=50-($staty[azycie]/$staty[zycie])*50; if ($prog>50){$prog=50;} elseif ($prog<0){$prog=0;}
//echo '<div class="potcal" style="position:absolute; right:100px; top:35px;"> 
//<div id="potzycie"  title="życie '.$staty[azycie].' / '.$staty[zycie].' "></div>
//<div id="wypzycie" style="position:absolute; top:'.$prog.';" ></div>
//</div>';

// PROGRES KO

//$prog=50-($staty[akondycja]/$staty[kondycja])*50; if ($prog>50){$prog=50;} elseif ($prog<0){$prog=0;}
//echo '<div class="potcal" style="position:absolute; right:50px; top:110px;"> 
//<div id="potko"  title="kondycja: '.$staty[akondycja].' / '.$staty[kondycja].' "></div>
//<div id="wypko" style="position:absolute; top:'.$prog.';" ></div>
//</div>';

// PROGRES UDŹWIGU

//$prog=($staty[audzwig]/(floor ($staty[udzwig]*(1+$prof[bonusudzwig]/100))+$staty[dodajudzwig]))*68; if ($prog>68){$prog=68;} elseif ($prog<0){$prog=0;}
//echo '<div style="position:absolute; position:absolute; width:70px;height:70px; border-radius:38px; overflow:hidden; left:48px; top:-49px; pointer-events:auto; " > 
//<img src="grafika/kolkoudzwig.png" style="width:70px; height:70px; z-index:4; position: relative;"  title="udżwig: '.$staty[audzwig].' / '.(floor ($staty[udzwig]*(1+$prof[bonusudzwig]/100))).' + ('.$staty[dodajudzwig].') " />
//<div class="kolkoprogresuudzwig" style="height:'.$prog.'px;" ></div>
//</div>';

?>



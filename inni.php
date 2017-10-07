<style>
#myDivi {overflow: hidden; width: auto;transition: transform 1s ease-in-out;}
</style>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
$('#lefti').on('click' , function(){ console.log('lefti');
    $('#myDivi').css("margin-left","+=45px");


})
$('#righti').on('click' , function(){ console.log('righti');
    $('#myDivi').css("margin-left","-=45px");

})

}); //]]> 
</script>


<?php 
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';

$user = user::getData('', '');
$misjegracz = mysql_fetch_array(mysql_query("SELECT * FROM misje WHERE id_gracza='$user[id]';"));

if ($akcja=='misja' and $z1>0){include 'misja.php';}

$width=($m+$p)*105; //szerokosc przewijki w srodku

echo '<div class="inni">
<div style="pointer-events:auto; position:relative; top:2px; height:92px; width: 630px; margin:auto; overflow:hidden;">
<div id="myDivi" style="height: 90px; width: auto; position:relative; top:1px;"><center>';

// PĘTLA MISJE

while ($misja=mysql_fetch_array($misjespis)){
if ($misjegracz[$misja[nazwa]]==$misja[etap]){
$obecna=$misja; 
$twarz=' background: url(twarze/'.$misja[kto].'.png) 0px 0px;';

echo '
<div  class="innitwarzbutton"   title="'.$misja[nazwa].'"  >
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;" onclick="ajax ('.$cal.',';?>'misja'<?php echo','.$misja[id_misji].',0,0);">

	<div class="innynazwacal" style="background:#003399;" ><div class="innynazwa"  >'.$misja[kto].'</div></div>
	<div class="innitlo" style="background: url(grafika/podswietlone.png) 0px 0px;  background-size:90px; z-index:10;">
	<div class="innitwarzobrazek" style="'.$twarz.' background-size:90px;"></div></div> 

</div>';

}}// koniec pętli misji


// PĘTLA INNI GRACZE

while ($p>0){$p--; $id=$inniwokol[$p][id]; 
$inny= mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1;")); 

	if (file_exists("twarze/$inny[id].png")){$twarz=' background: url(twarze/'.$inny[id].'.png) 0px 0px;';}
	else{$twarz=' background: url(twarze/brak'.$inny[plec].'.png) 0px 0px;';} 

	if ($z3==$inny[id]){$tlo='background: url(grafika/tloprzekaz.png) 0px 0px; ';}
	else{$tlo=' background: url(grafika/tlo.png) 0px 0px; '; }

echo '
<div  class="innitwarzbutton"   title="'.$inny[nazwa].'"  >
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;" value="'.$inny[id].'"  > 

	<div class="innynazwacal"><div class="innynazwa" >'.$inny[nazwa].'</div></div>
	<div class="innitlo" style="'.$tlo.'background-size:90px; z-index:10;">
	<div class="innitwarzobrazek" style="'.$twarz.' background-size:90px;"></div></div> 


<div id="kolkoprzekaz" title="przekaż przedmiot">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick="ajax (31,';?>'prz'<?php echo',0,0,'.$inny[id].');">
</div>

<div id="kolkowiad" title="zaatakuj">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick="ajax ('.$cal.',';?>'wiadomosc'<?php echo','.$inny[id].',0);">
</div>

<div id="kolkowalka" title="napisz wiadomość">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick="ajax ('.$cal.',';?>'walkagracz'<?php echo','.$inny[id].',0);">
</div>

<div id="kolkokradziez" title="okradnij">
<input type="button" style="pointer-events:auto; position:absolute; top:0xp; left:0px; border:0px; background:none; color:transparent; width:100%; height:100%;" onclick="ajax ('.$cal.',';?>'okradnij'<?php echo','.$inny[id].',0);">
</div>

</div>';
}



// STRZAŁKI DO PRZEWIJKI
echo'
</center></div></div>

<div style="position:absolute;left:0px; top:0px; width:45px; height:90px; z-index:12;">
<input type="button" class="buttonstrzalkainni"  id="lefti"></div>

<div style="position:absolute;right:0px; top:0px; width:45px; height:90px; z-index:12;">
<input type="button" class="buttonstrzalkarinni"  id="righti"></div>

</div>';
?>



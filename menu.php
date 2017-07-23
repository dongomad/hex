


<form style="z-index:5;">

<?php 
if($_GET[cal]>40){echo'
<div  class="button" style="left:80px; top:30px;" title="mapa">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="1" onclick="ajax(this.value,0,0,0)">
<img src="grafika/mapa.png" class="buttongrafika">
</div>
';}
?>


<?php 
$bag=33; $post=21;

if (floor($_GET[cal]/10)==2){echo '

<div  class="buttonm" style="left:110px; top:119px;"  title="statystyki">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="21" onclick="ajax(this.value,0,0,0)">
<img src="grafika/statystyki.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="left:5px; top:68px;"  title="umiejętności">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="22" onclick="ajax(this.value,0,0,0)">
<img src="grafika/umiejetnosci.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="left:-30px; top:119px;"  title="zawody">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="23" onclick="ajax(this.value,0,0,0)">
<img src="grafika/zawody.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="left:75px; top:170px;"  titlee="magia">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="24" onclick="ajax(this.value,0,0,0)">
<img src="grafika/magia.png" class="buttonmgrafika">
</div>



'; $post=1;}

elseif (floor($_GET[cal]/10)==3){echo '

<div  class="buttonm" style="right:5px; top:68px;"  title="broń">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="31" onclick="ajax(this.value,0,0,0)">
<img src="grafika/bron.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="right:75px; top:68px;"  title="pancerze">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="32" onclick="ajax(this.value,0,0,0)">
<img src="grafika/pancerz.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="right:75px; top:170px;"  title="surowce i narzędzia">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="34" onclick="ajax(this.value,0,0,0)">
<img src="grafika/surowce.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="right:110px; top:119px;"  title="mikstury i pokarm">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="33" onclick="ajax(this.value,0,0,0)">
<img src="grafika/mikstury.png" class="buttonmgrafika">
</div>

<div  class="buttonm" style="right:-30px; top:119px;"  title="wierzchowce, amulety, inne">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="35" onclick="ajax(this.value,0,0,0)">
<img src="grafika/cenne.png" class="buttonmgrafika">
</div>

'; $bag=1;}

echo'
<div  class="button" style="right:30px; top:110px;"  title="bagaż">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="'.$bag.'" onclick="ajax(this.value,0,0,0)">
<img src="grafika/bagaz.png" class="buttongrafika">
</div>

<div  class="button" style="left:30px; top:110px;" title="postać">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="'.$post.'" onclick="ajax(this.value,0,0,0)">
<img src="grafika/postac.png" class="buttongrafika">
</div>

<div  class="button" style="left:-20px; top:190px;" title="dziennik zdarzeń">
<input type="button" style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;"  value="41" onclick="ajax(this.value,0,0,0)">
<img src="grafika/dziennik.png" class="buttongrafika">
</div>



';

?>

</form>
     




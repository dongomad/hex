<?php
session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';





$m=mysql_fetch_array($misjespis);
echo 'cel;'.$m[0].' ';


$x=0;
if ( $m[0]>0){
echo '<div class="duzomisji">';

while ($misja=mysql_fetch_array($misjespis)){if ($misjegracz[$misja[nazwa]]==$misja[etap]){
$obecna=$misja; $x++;

echo'
<div class="misjaczlowiek" >
<form action="calosc.php" method="get">
<input type="hidden" value="misja" name="calosc">
<input type="hidden" name="nazwamisji" value="'.$obecna[nazwa].'">
<button type="submit"  title='.$obecna[wyswietl].'" style="border:0px; width:50px; height:50px; position:relative; background:none;">
 <img src="twarze/'.$obecna[kto].'.png" style=" position: absolute; top:0px; left:0px; width:50px;"/>
</button></form>
</div>

';}}

if ($x>1){echo '<b style="color:gold; position:absolute; top:0px; right:0px; z-index:11;">'.$x.'</b>';}

echo '</div>';}



?>

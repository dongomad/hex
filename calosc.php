<?php 

session_start();
error_reporting(0);
require 'config.php';
require_once 'user.class.php';
mysql_query("SET NAMES 'utf8'");

// ___ WYLOGOWANIE
if ($_GET[akcja]=='wyloguj'){
$user = user::getData('', '');
session_destroy();
$_SESSION = array ();
$user = user::getData('', '');}


if (user::isLogged ()){$user = user::getData('', '');}
else {include 'logowanie.php'; die; }

if ($user[blokada]>0){include 'blokadakonta.php'; die;}


date_default_timezone_set('Europe/Warsaw');
$now = date("Y-m-d G:i:s", time () );   
mysql_query("UPDATE users SET online='$now' WHERE id=$user[id]  ");

if(!$_GET[cal]){$_GET[cal]=1;}
$cal=$_GET[cal];
$akcja=$_GET[akcja];
$z1=$_GET[z1];
$z2=$_GET[z2];
$z3=$_GET[z3];

$q = $_GET['z1']; 
$c = floor ($_GET[cal]/10); 



echo'<div style="width:800px; position:relative; top:0px; margin:0px auto;">


<div class="calosc" id="calosc" >';

$user = user::getData('', '');

if ($c<=1){include 'mapa.php'; }
elseif ($c==2){include 'mapa.php'; include 'postac.php';}
elseif ($c==3){include 'mapa.php';  include 'bagaz.php';}

if ($efekt){include 'oknoefekt.php'; echo"<script>  document.onload = poka ('oknoefekt');</script>";}


include 'menu.php';
include 'pasek.php';


echo'<img src="postaciduze/staryczlowiek.png" style="width:160px; position:fixed; left:10px; bottom:20px;">';

echo '<div style="position:fixed; border:1px solid red; right:10px; bottom:10px;">
'.$efekt.'</br>

'.$cal.'</br>'.$akcja.'</br>'.$z1.'</br>'.$z2.'</br>'.$z3.'</br>'.$obecne[x].':'.$obecne[y].':'.$obecne[typ].':'.$obecne[specjalne].'</br> '.$error.'</br> '.$now.'
</br><a href="index.php?akcja=wyloguj">wyloguj</a> '.$user[nazwa].' </div>

';



echo'</div></div>';



?>



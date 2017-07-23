<?php
ob_start();
error_reporting(0);

// __ LOGOWANIE:

if ($_POST['send'] == 1) {

$nazwa = htmlspecialchars(mysql_real_escape_string($_POST['nazwa']));
$pass = mysql_real_escape_string($_POST['pass']);

$pass = user::passSalter($pass); // Posól i zahashuj hasło
$userExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE nazwa = '$nazwa' AND pass = '$pass'"));

    if ($userExists[0] == 0 or !$nazwa or empty($nazwa) or !$pass or empty($pass) ) {
        $error = '<font style="color: red;">Zła nazwa lub hasło.</font>'; 
    }

    else {
        // Użytkownik istnieje
        $user = user::getData($nazwa, $pass); 

        // Przypisz pobrane dane do sesji
        $_SESSION['nazwa'] = $nazwa;
        $_SESSION['pass'] = $pass;


$daneid=$user['id']; 



// WPISANIE LOGU DO BAZY:
date_default_timezone_set('Europe/Warsaw');
$now= date("Y-m-d G:i:s", time () );

if ($_SERVER['HTTP_CLIENT_IP']){$ip = $_SERVER['HTTP_CLIENT_IP'];}
elseif ($_SERVER['HTTP_X_FORWARDED_FOR']){$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}
else {$ip = $_SERVER['REMOTE_ADDR'];}

$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$cookie=$_COOKIE[ostatnio_zalogowany]; if ($cookie<1){$cookie=0;}
mysql_query("INSERT INTO logi (id_gracza, ostatnio_zalogowany, data, ip, host) VALUES('$user[id]', $cookie, '$now', '$ip', '$host');");
setcookie("ostatnio_zalogowany", $user[id], time()+36000000);  
$ipExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM logi WHERE ip='$ip' "));

header("Location: index.php");

echo '<script> ajax (1,0,0,0,0); </script>';
}}

echo'


<div class="logowanie">

<img src="grafika/m.png" style="position:absolute; width:160px; top:100px; left:10px;">
<img src="grafika/k.png" style="position:absolute; width:160px; top:100px; right:10px;">


<form style="position: relative; top:140px; margin: 0 auto;" method="post" action="index.php">

<b><center><p style="color:gold; ">LOGOWANIE:</p></b>
<input maxlength="30" minlenght="5" name="nazwa" id="nazwa" placeholder="nazwa postaci" type="text" style=" height: 18px; width:140px; font-size:12px; border-radius: 4px; " required/><br>
<input maxlength="30" minlenght="5" name="pass" id="pass" placeholder="hasło" type="password" style=" height: 18px; width:140px; font-size:12px; border-radius: 4px; " required/>
</br></br>';

if ($error){echo '<center>'.$error.'</center></br>';}

echo'
<input type="hidden" name="send" value="1" />
<div  class="button" style="position:relative;" title="postać">
<button style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;" type="submit" title="zaloguj">
<img src="grafika/umiejetnosci.png" class="buttongrafika">
</button>
</div>

</center>
</form>
</div>
';

?>












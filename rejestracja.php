<?php
session_start();
error_reporting(0);

require 'config.php';
require_once 'user.class.php';
mysql_query("SET NAMES 'utf8'");


// ___ REJESTRACJA

if ($_POST['sendr'] == 1) {
    $nazwar = mysql_real_escape_string(htmlspecialchars($_POST['nazwar'])); $nazwaznaki=strlen($nazwar); $nazwar=ucfirst($nazwar);
    $pass = mysql_real_escape_string(htmlspecialchars($_POST['pass'])); $hasloznaki=strlen($pass);
    $pass_v = mysql_real_escape_string(htmlspecialchars($_POST['pass_v'])); 
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email'])); $emailznaki = strlen ($email);
    $plec = mysql_real_escape_string(htmlspecialchars($_POST['plec']));;



    $existsnazwa = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM postaci WHERE nazwa='$nazwar' LIMIT 1"));
    $existsEmail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM postaci WHERE email='$email' LIMIT 1"));

    $errors = ''; 

    if ($ipExists[0]>0){$errors.='- Na tym komputerze istnieje już inne konto!</br>';}
    if (!$nazwar || !$email || !$pass || !$pass_v || !$plec) $errors .= '- Musisz wypełnić wszystkie pola<br />';
    if ($existsnazwa[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
    if ($nazwaznaki<6) $errors .='- Login musi mieć conajmniej 6 znaków!<br />';
    if ($existsEmail[0] >= 1) $errors .= '- Ten e-mail jest już używany<br />';
    if ($emailznaki<6) $errors .='- Podaj poprawny adres e-mail!<br />';
    if ($pass != $pass_v)  $errors .= '- Hasła się nie zgadzają<br />';
    if ($hasloznaki<6) $errors .='- Hasło musi mieć co najmniej 6 znaków!<br />';
    if ($plec=='')  $errors .= '- Podaj płeć <br />';


    if ($errors != '') {
        $efekt = 'Rejestracja nie powiodła się, popraw następujące błędy:<br/>'.$errors.' ';
    }


    else {

        $pass = user::passSalter($pass);

        mysql_query("INSERT INTO  users (nazwa, email, pass, plec, lokalizacja, mapa) VALUES('$nazwar','$email','$pass','$plec', 671 ,mapa);") or die ('<p>Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika. [post]</p>');
    	$id = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE nazwa='$nazwar'"));
       	mysql_query("INSERT INTO misje (id_gracza) VALUES('$id[0]');") or die ('<p>Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.[mis]</p>');
        mysql_query("INSERT INTO umieszczone (id_gracza) VALUES('$id[0]');") or die ('<p>Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.[umies]</p>');
        mysql_query("INSERT INTO statystyki (id_gracza) VALUES('$id[0]');") or die ('<p>Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.[sta]</p>');
        mysql_query("INSERT INTO posiadane (id_gracza) VALUES('$id[0]');") or die ('<p>Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.[pos]</p>');
	// mysql_query("INSERT INTO zabite (id_gracza) VALUES('$id[0]');") or die ('<p>Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.[zabite]</p>');
                 
   
   
   
   
     $efekt = '<b>'.$nazwar.'</b> zarejestrowany .';
    }
}// koniec ifa czy wyslany formularz rejestracji


//___ REJESTRACJA

echo '<div style="width:200px; height:600px; position:absolute; right:10px; top:80px; ">
<font style="color:gold"><center><b>REJESTRACJA</b></center></font>
</br>
<form method="post" ><center>
<input maxlength="24" minlenght="6" name="nazwar" id="login" placeholder="nazwa postaci" type="text" style=" height: 16px; width:140px; font-size:12px; border-radius: 4px; " required/>
<input maxlength="24" minlenght="6" name="pass" id="pass" placeholder="hasło" type="password" style=" height: 16px; width:140px; font-size:12px; border-radius: 4px; " required/>
<input maxlength="24" minlenght="6" name="pass_v" id="pass_again" placeholder="powtórz hasło" type="password" style=" height: 16px; width:140px; font-size:12px; border-radius: 4px; " required/>
<input maxlength="36" minlenght="6" name="email" id="email" placeholder="adres e-mailowy" type="email" style=" height: 16px; width:140px; font-size:12px; border-radius: 4px; " required/>
</br></br></br>
<div style="display:inline; float:left; position:relative; width:49%; height:130px;"><label for="m"><img src="grafika/m.png"  title="mężczyzna" width="70"></label></br></br><input type="radio" id="m" value="m" name="plec" required></div>
<div style="display:inline; float:right; position:relative; width:49%; height:130px;"><label for="k"><img src="grafika/k.png"  title="kobieta" width="70"></label></br></br><input type="radio" id="k" value="k" name="plec" required></div>
<input type="hidden" name="sendr" value="1" />


</br>

<div  class="button" style="position:relative; transform:scale(0.5); -webkit-transform:scale(0.5); -moz-transform:scale(0.5); -o-transform:scale(0.5);" title="zarejestruj">
<button style="pointer-events:auto; width:100%; height:100%; z-index:10; background-color:transparent; border:0px; color:transparent;" type="submit" >
<img src="grafika/umiejetnosci.png" class="buttongrafika">
</button>
</div>


</br>';

if ($efekt){echo'<div class="efekt"><center> '.$efekt.' </center></div>';}

echo'

</center>
</form></div>';


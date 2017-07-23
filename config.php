<?php


$cfg['db_server'] = 'localhost'; // Serwer bazy danych
$cfg['db_user'] = 'root'; // Nazwa użytkownika
$cfg['db_pass'] = 'kucharek6'; // Hasło
$cfg['db_name'] = 'hex'; // Nazwa bazy danych


// POŁĄCZ Z BAZĄ DANYCH
$conn = @mysql_connect ($cfg['db_server'], $cfg['db_user'], $cfg['db_pass']);
$select = @mysql_select_db ($cfg['db_name'], $conn);

if (!$conn) {include 'awaria.php'; die;}

if (!$select) {include 'awaria.php'; die;}
//{    die ('<p>Nie udało się wybrać bazy danych.</p>');}
       
?>

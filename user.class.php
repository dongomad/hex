<?php


class user {

    public static $user = array();

    
    public function getData ($nazwa, $pass) {
        if ($nazwa == '') $nazwa = $_SESSION['nazwa'];
        if ($pass == '') $pass = $_SESSION['pass'];

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE nazwa='$nazwa' AND pass='$pass' LIMIT 1;"));
        return self::$user;
    }


   
   
    public function getDataById ($id) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1;"));
        return $user;
    }

    
    public function isLogged () {
     if (empty($_SESSION['nazwa']) || empty($_SESSION['pass'])) {
      return false;
     }

     else {
      return true;
     }
    }

    
    public function passSalter ($pass) {
        $pass = '$@@#$#@$'.$pass.'q2#$3$%##@';
        return md5($pass);
    }

}






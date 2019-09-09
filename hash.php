  <?php

    function hash_passwd($passwd, $salt) {
      $passwd = base64_encode("$passwd$passwd");
      //$passwd = password_hash($hash, PASSWORD_DEFAULT);
      $salt = base64_encode($salt);
      $hash = hash('sha512', $passwd.$salt);
      //$hash = password_hash($hash, PASSWORD_BCRYPT);
      return $hash;
    }

    function generate_salt(int $length = 26){
      $x = '';
      for($i = 1; $i <= $length; $i++){
        $x .= dechex(random_int(0,255));
      }
      return substr($x, 0, $length);
    }

    function str_rand(int $length = 16){
      $x = '';
      for($i = 1; $i <= $length; $i++){
        $x .= dechex(random_int(0,255));
      }
      return substr($x, 0, $length);
    }

    function hash_email($email) {
      $email = base64_encode("$email");
      $hash = hash('sha256', $email);
      return $hash;
    }


    function vercode() {
      $i = random_int(10000000, 99999999);
      return $i;
    }

    #echo hash_email("maris.beer@icloud.com", "eb4eeec5775d812564d06bcd4f");
    #echo str_rand("42");


    /*
    echo "hash_passwd(soos, nicesalt):<br>";
    echo hash_passwd("soos", "nicesalt");
    echo "<br>generate_salt:<br>";
    echo generate_salt();
    echo "<br>str_rand(100):<br>";
    echo str_rand("100");
    echo "<br>hash_email(soos, nicesalt):<br>";
    echo hash_email("soos", "nicesalt");
    echo "<br>xrandom_int():<br>";
    echo vercode();//*/
?>

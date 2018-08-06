<?php
  if (isset($_POST["username"])) {
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
      die();
    }
    $mysqli = new mysqli('localhost' , 'roj2009_deng1', 'kAzLhdtw', 'roj2009_pohjai01');
    if ($mysqli->connect_error){
      die('Could not connect to database!');
    }
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    $usernamelength = strlen($username);
    $statement = $mysqli->prepare("SELECT ma_username FROM memberAd WHERE ma_username = ?");
    $statement->bind_param('s', $username);
    $statement->execute();
    $statement->bind_result($username);
    if ($statement->fetch()) {
      die('<img src="../images/not-available.png" style="width: 20px;"><a style="color: red;"> มี Username ซ้ำในระบบ </a>');
    } else {
      if (($usernamelength < 6) || ($usernamelength > 12)) {
        die('<img src="../images/not-available.png" style="width: 20px;"><a style="color: red;"> ต้องมีความยาว 6-12 ตัว </a>');
      } else {
        die('<img src="../images/available.png" style="width: 20px;"><a style="color: green;"> สามารถใช้งานได้ </a>');
      }
    }
  }
?>

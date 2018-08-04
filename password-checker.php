<?php
  if ((isset($_POST["password"]))) {
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    $cfmpassword = filter_var($_POST["cfmpassword"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    $passwordlength = strlen($password);
    if (($passwordlength < 6) || ($passwordlength > 12)) {
      die('<img src="../images/not-available.png" style="width: 20px;"><a style="color: red;"> ต้องมีความยาว 6-12 ตัว </a>');
    } else {
      die('<img src="../images/available.png" style="width: 20px;"><a style="color: green;"> สามารถใช้งานได้ </a>');
    }
  }
?>

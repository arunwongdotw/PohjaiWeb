<?php
  if ((isset($_POST["password"])) && (isset($_POST["cfmpassword"]))) {
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    $cfmpassword = filter_var($_POST["cfmpassword"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    if ($password != $cfmpassword) {
      die('<img src="../images/not-available.png" style="width: 20px;"><a style="color: red;"> ยืนยันรหัสผ่านไม่ตรงกัน </a>');
    } else {
      die('<img src="../images/available.png" style="width: 20px;"><a style="color: green;"> สามารถใช้งานได้ </a>');
    }
  }
?>

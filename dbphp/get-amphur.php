<?php
  include "connect.php";
  if (!empty($_POST["province_name"])) {
    $province_name = $_POST["province_name"];
    $sqlGetAmphur = "SELECT a.* FROM province p, amphur a WHERE p.province_name = '$province_name' AND p.province_id = a.province_id";
    $queryGetAmphur = mysql_query($sqlGetAmphur);
    while ($resultGetAmphur = mysql_fetch_array($queryGetAmphur)) {
      echo '<option value="'.$resultGetAmphur["AMPHUR_NAME"].'">'.$resultGetAmphur["AMPHUR_NAME"].'</option>';
    }
  }
?>

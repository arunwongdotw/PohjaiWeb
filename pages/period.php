<?php
  $startdatetime = $_REQUEST["startdatetime"];
  $enddatetime = $_REQUEST["enddatetime"];
  echo $startdatetime;
  echo $enddatetime;
  $start = strtotime($startdatetime);
  $end = strtotime($enddatetime);
  for ($second = $start; $second <= $end; $second += 86400) {
    $date = date("Y-m-d", $second);
    echo $date . "<br>";
  }
?>

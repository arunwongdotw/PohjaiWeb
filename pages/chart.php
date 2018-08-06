<?php
  session_start();
  include "../dbphp/connect.php";
  if (!$_SESSION) {
    ?><script>window.location="../pages/login.php";</script><?php
  }
  if ($_REQUEST["action"] == "logout") {
    session_destroy();
    echo "<script type='text/javascript'>alert('Log Out สำเร็จ');</script>";
    ?><script>window.location="../index.html";</script><?php
  }
  if (!$_REQUEST["questionsetid"]) {
    ?><script>window.location="../pages/member.php";</script><?php
  } else {
    if ($_REQUEST["chartdata"]) {
      $questionsetid = $_REQUEST["questionsetid"];
      $charttype = $_REQUEST["charttype"];
      $chartdata = $_REQUEST["chartdata"];
      $startdatetime = $_REQUEST["startdatetime"];
      $enddatetime = $_REQUEST["enddatetime"];
    } else {
      $questionsetid = $_REQUEST["questionsetid"];
      $charttype = $_REQUEST["charttype"];
      $startdatetime = $_REQUEST["startdatetime"];
      $enddatetime = $_REQUEST["enddatetime"];
    }
    if ($chartdata == "2") {
      $title = "กราฟแสดงข้อมูลแบบสอบถามเบื้องต้น";
      $sqlGetInfoFlag = "SELECT * FROM basicInfo WHERE bi_question_set_id = '$questionsetid'";
      $queryGetInfoFlag = mysql_query($sqlGetInfoFlag);
      $resultGetInfoFlag = mysql_fetch_array($queryGetInfoFlag);
      if ($resultGetInfoFlag["bi_age"] == "1") {
        $sqlCountAge = "SELECT count(info_age) as countage, info_age FROM info WHERE info_question_set_id = '$questionsetid'
                        AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_age";
        $queryCountAge = mysql_query($sqlCountAge);
        $countRowAge = mysql_num_rows($queryCountAge);
        if ($countRowAge == 0) {
          echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
          ?><script>window.location="../pages/member.php";</script><?php
        }
        $dataAge = array();
        if ($charttype == "1") {
          while ($resultCountAge = mysql_fetch_array($queryCountAge)) {
            if ($resultCountAge["info_age"] == "10-15") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "10-15 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "16-20") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "16-20 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "21-25") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "21-25 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "26-30") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "26-30 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "31-35") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "31-35 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "36-40") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "36-40 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "41-45") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "41-45 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "46-50") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "46-50 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "51-55") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "51-55 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "56-60") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "56-60 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "61+") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "61 ปีขึ้นไป");
              array_push($dataAge, $array);
            }
          }
        } else if ($charttype == "2") {
          while ($resultCountAge = mysql_fetch_array($queryCountAge)) {
            if ($resultCountAge["info_age"] == "10-15") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "10-15 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "16-20") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "16-20 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "21-25") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "21-25 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "26-30") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "26-30 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "31-35") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "31-35 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "36-40") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "36-40 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "41-45") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "41-45 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "46-50") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "46-50 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "51-55") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "51-55 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "56-60") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "56-60 ปี");
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "61+") {
              $array = array("y" => intval($resultCountAge["countage"]), "label" => "61 ปีขึ้นไป");
              array_push($dataAge, $array);
            }
          }
        } else if ($charttype == "3") {
          while ($resultCountAge = mysql_fetch_array($queryCountAge)) {
            if ($resultCountAge["info_age"] == "10-15") {
              $array = array("label" => "10-15 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "16-20") {
              $array = array("label" => "16-20 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "21-25") {
              $array = array("label" => "21-25 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "26-30") {
              $array = array("label" => "26-30 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "31-35") {
              $array = array("label" => "31-35 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "36-40") {
              $array = array("label" => "36-40 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "41-45") {
              $array = array("label" => "41-45 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "46-50") {
              $array = array("label" => "46-50 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "51-55") {
              $array = array("label" => "51-55 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "56-60") {
              $array = array("label" => "56-60 ปี", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            } else if ($resultCountAge["info_age"] == "61+") {
              $array = array("label" => "61 ปีขึ้นไป", "y" => intval($resultCountAge["countage"]));
              array_push($dataAge, $array);
            }
          }
        }
      }
      if ($resultGetInfoFlag["bi_sex"] == "1") {
        $sqlCountSex = "SELECT count(info_sex) as countsex, info_sex FROM info WHERE info_question_set_id = '$questionsetid'
                        AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_sex";
        $queryCountSex = mysql_query($sqlCountSex);
        $countRowSex = mysql_num_rows($queryCountSex);
        if ($countRowSex == 0) {
          echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
          ?><script>window.location="../pages/member.php";</script><?php
        }
        $dataSex = array();
        if ($charttype == "1") {
          while ($resultCountSex = mysql_fetch_array($queryCountSex)) {
            if ($resultCountSex["info_sex"] == "Male") {
              $array = array("y" => intval($resultCountSex["countsex"]), "label" => "ผู้ชาย");
              array_push($dataSex, $array);
            } else if ($resultCountSex["info_sex"] == "Female") {
              $array = array("y" => intval($resultCountSex["countsex"]), "label" => "ผู้หญิง");
              array_push($dataSex, $array);
            }
          }
        } else if ($charttype == "2") {
          while ($resultCountSex = mysql_fetch_array($queryCountSex)) {
            if ($resultCountSex["info_sex"] == "Male") {
              $array = array("y" => intval($resultCountSex["countsex"]), "label" => "ผู้ชาย");
              array_push($dataSex, $array);
            } else if ($resultCountSex["info_sex"] == "Female") {
              $array = array("y" => intval($resultCountSex["countsex"]), "label" => "ผู้หญิง");
              array_push($dataSex, $array);
            }
          }
        } else if ($charttype == "3") {
          while ($resultCountSex = mysql_fetch_array($queryCountSex)) {
            if ($resultCountSex["info_sex"] == "Male") {
              $array = array("label" => "ผู้ชาย", "y" => intval($resultCountSex["countsex"]));
              array_push($dataSex, $array);
            } else if ($resultCountSex["info_sex"] == "Female") {
              $array = array("label" => "ผู้หญิง", "y" => intval($resultCountSex["countsex"]));
              array_push($dataSex, $array);
            }
          }
        }
      }
      if ($resultGetInfoFlag["bi_education"] == "1") {
        $sqlCountEducation = "SELECT count(info_education) as counteducation, info_education FROM info WHERE info_question_set_id = '$questionsetid'
                              AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_education";
        $queryCountEducation = mysql_query($sqlCountEducation);
        $countRowEducation = mysql_num_rows($queryCountEducation);
        if ($countRowEducation == 0) {
          echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
          ?><script>window.location="../pages/member.php";</script><?php
        }
        $dataEducation = array();
        if ($charttype == "1") {
          while ($resultCountEducation = mysql_fetch_array($queryCountEducation)) {
            if ($resultCountEducation["info_education"] == "Lower Secondary School") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ต่ำกว่ามัธยมศึกษา");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Secondary School") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "มัธยมศึกษาหรือเทียบเท่า");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Diploma") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "อนุปริญญาหรือเทียบเท่า");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Bachelor Degree") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ปริญญาตรี");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Master Degree") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ปริญญาโท");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Doctor Degree") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ปริญญาเอก");
              array_push($dataEducation, $array);
            }
          }
        } else if ($charttype == "2") {
          while ($resultCountEducation = mysql_fetch_array($queryCountEducation)) {
            if ($resultCountEducation["info_education"] == "Lower Secondary School") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ต่ำกว่ามัธยมศึกษา");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Secondary School") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "มัธยมศึกษาหรือเทียบเท่า");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Diploma") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "อนุปริญญาหรือเทียบเท่า");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Bachelor Degree") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ปริญญาตรี");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Master Degree") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ปริญญาโท");
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Doctor Degree") {
              $array = array("y" => intval($resultCountEducation["counteducation"]), "label" => "ปริญญาเอก");
              array_push($dataEducation, $array);
            }
          }
        } else if ($charttype == "3") {
          while ($resultCountEducation = mysql_fetch_array($queryCountEducation)) {
            if ($resultCountEducation["info_education"] == "Lower Secondary School") {
              $array = array("label" => "ต่ำกว่ามัธยมศึกษา", "y" => intval($resultCountEducation["counteducation"]));
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Secondary School") {
              $array = array("label" => "มัธยมศึกษาหรือเทียบเท่า", "y" => intval($resultCountEducation["counteducation"]));
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Diploma") {
              $array = array("label" => "อนุปริญญาหรือเทียบเท่า", "y" => intval($resultCountEducation["counteducation"]));
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Bachelor Degree") {
              $array = array("label" => "ปริญญาตรี", "y" => intval($resultCountEducation["counteducation"]));
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Master Degree") {
              $array = array("label" => "ปริญญาโท", "y" => intval($resultCountEducation["counteducation"]));
              array_push($dataEducation, $array);
            } else if ($resultCountEducation["info_education"] == "Doctor Degree") {
              $array = array("label" => "ปริญญาเอก", "y" => intval($resultCountEducation["counteducation"]));
              array_push($dataEducation, $array);
            }
          }
        }
      }
      if ($resultGetInfoFlag["bi_salary"] == "1") {
        $sqlCountSalary = "SELECT count(info_income) as countincome, info_income FROM info WHERE info_question_set_id = '$questionsetid' AND info_datetime >= '$startdatetime'
                            AND info_datetime <= '$enddatetime' GROUP BY info_income";
        $queryCountSalary = mysql_query($sqlCountSalary);
        $countRowSalary = mysql_num_rows($queryCountSalary);
        if ($countRowSalary == 0) {
          echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
          ?><script>window.location="../pages/member.php";</script><?php
        }
        $dataSalary = array();
        if ($charttype == "1") {
          while ($resultCountSalary = mysql_fetch_array($queryCountSalary)) {
            if ($resultCountSalary["info_income"] == "0") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "ไม่มีรายได้");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "Less than 5,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "ต่ำกว่า 5,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "5,001 - 10,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "5,001 - 10,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "10,001 - 15,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "10,001 - 15,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "15,001 - 20,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "15,001 - 20,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "20,001 - 30,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "20,001 - 30,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "30,001 - 40,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "30,001 - 40,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "More than 40,001") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "40,001 บาท/เดือน ขึ้นไป");
              array_push($dataSalary, $array);
            }
          }
        } else if ($charttype == "2") {
          while ($resultCountSalary = mysql_fetch_array($queryCountSalary)) {
            if ($resultCountSalary["info_income"] == "0") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "ไม่มีรายได้");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "Less than 5,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "ต่ำกว่า 5,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "5,001 - 10,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "5,001 - 10,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "10,001 - 15,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "10,001 - 15,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "15,001 - 20,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "15,001 - 20,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "20,001 - 30,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "20,001 - 30,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "30,001 - 40,000") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "30,001 - 40,000 บาท/เดือน");
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "More than 40,001") {
              $array = array("y" => intval($resultCountSalary["countincome"]), "label" => "40,001 บาท/เดือน ขึ้นไป");
              array_push($dataSalary, $array);
            }
          }
        } else if ($charttype == "3") {
          while ($resultCountSalary = mysql_fetch_array($queryCountSalary)) {
            if ($resultCountSalary["info_income"] == "0") {
              $array = array("label" => "ไม่มีรายได้", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "Less than 5,000") {
              $array = array("label" => "ต่ำกว่า 5,000 บาท/เดือน", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "5,001 - 10,000") {
              $array = array("label" => "5,001 - 10,000 บาท/เดือน", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "10,001 - 15,000") {
              $array = array("label" => "10,001 - 15,000 บาท/เดือน", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "15,001 - 20,000") {
              $array = array("label" => "15,001 - 20,000 บาท/เดือน", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "20,001 - 30,000") {
              $array = array("label" => "20,001 - 30,000 บาท/เดือน", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "30,001 - 40,000") {
              $array = array("label" => "30,001 - 40,000 บาท/เดือน", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            } else if ($resultCountSalary["info_income"] == "More than 40,001") {
              $array = array("label" => "40,001 บาท/เดือน ขึ้นไป", "y" => intval($resultCountSalary["countincome"]));
              array_push($dataSalary, $array);
            }
          }
        }
      }
      $sqlGetBasicQuestion = "SELECT * FROM basicQuestion WHERE bq_question_set_id = '$questionsetid' ORDER BY bq_id";
      $queryGetBasicQuestion = mysql_query($sqlGetBasicQuestion);
      while ($resultGetBasicQuestion = mysql_fetch_array($queryGetBasicQuestion)) {
        if ($resultGetBasicQuestion["bq_type"] == "2") {
          $bqid = $resultGetBasicQuestion["bq_id"];
          $sqlCountAns = "SELECT count(a.ans_answer) as countans, a.* FROM answer a, info i WHERE a.ans_bq_id = '$bqid' AND i.info_datetime >= '$startdatetime' AND i.info_datetime <= '$enddatetime'
                          AND a.ans_info_id = i.info_id GROUP BY a.ans_answer ORDER BY a.ans_bqa_id";
          $queryCountAns = mysql_query($sqlCountAns);
          ${'data' . $bqid} = array();
          if ($charttype == "1") {
            while ($resultCountAns = mysql_fetch_array($queryCountAns)) {
              $array = array("y" => intval($resultCountAns["countans"]), "label" => $resultCountAns["ans_answer"]);
              array_push(${'data' . $bqid}, $array);
            }
          } else if ($charttype == "2") {
            while ($resultCountAns = mysql_fetch_array($queryCountAns)) {
              $array = array("y" => intval($resultCountAns["countans"]), "label" => $resultCountAns["ans_answer"]);
              array_push(${'data' . $bqid}, $array);
            }
          } else if ($charttype == "3") {
            while ($resultCountAns = mysql_fetch_array($queryCountAns)) {
              $array = array("label" => $resultCountAns["ans_answer"], "y" => intval($resultCountAns["countans"]));
              array_push(${'data' . $bqid}, $array);
            }
          }
        }
      }
    } else {
      $title = "กราฟแสดงข้อมูลแบบประเมินความพึงพอใจ";
      $sqlGetQuestionSetNoBtn = "SELECT * FROM questionSet WHERE question_set_id = '$questionsetid'";
      $queryGetQuestionSetNoBtn = mysql_query($sqlGetQuestionSetNoBtn);
      $resultGetQuestionSetNoBtn = mysql_fetch_array($queryGetQuestionSetNoBtn);
      $noBtn = $resultGetQuestionSetNoBtn["question_set_number_btn"];
      $sqlGetQuestionInQuestionSet = "SELECT * FROM question WHERE question_question_set_id = '$questionsetid' ORDER BY question_id";
      $queryGetQuestionInQuestionSet = mysql_query($sqlGetQuestionInQuestionSet);
      $sqlCountScoreInQuestionSet = "SELECT count(score_value) as countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '$questionsetid'
                                    AND s.score_datetime >= '$startdatetime' AND s.score_datetime <= '$enddatetime' AND s.score_question_id = q.question_id
                                    AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";
      $queryCountScoreInQuestionSet = mysql_query($sqlCountScoreInQuestionSet);
      while ($resultGetQuestionInQuestionSet = mysql_fetch_array($queryGetQuestionInQuestionSet)) {
        $questionid = $resultGetQuestionInQuestionSet["question_id"];
        $sqlCountScore = "SELECT count(score_value) as countvalue, s.score_value FROM score s WHERE score_question_id = '$questionid' AND score_datetime >= '$startdatetime'
                          AND score_datetime <= '$enddatetime' GROUP BY score_value ORDER BY score_value";
        $queryCountScore = mysql_query($sqlCountScore);
        $countRowScore = mysql_num_rows($queryCountScore);
        ${'data' . $questionid} = array();
        if ($countRowScore == 0) {
          echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
          ?><script>window.location="../pages/member.php";</script><?php
        }
        while ($resultCountScore = mysql_fetch_array($queryCountScore)) {
          if ($noBtn == "1") { // 4 btn
            if ($charttype == "1") {
              if ($resultCountScore["score_value"] == "2") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ควรปรับปรุง");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "3") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "พอใช้");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "4") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดี");
                array_push(${'data' . $questionid}, $array);
              } else {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดีมาก");
                array_push(${'data' . $questionid}, $array);
              }
            } else if ($charttype == "2") {
              if ($resultCountScore["score_value"] == "2") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ควรปรับปรุง");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "3") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "พอใช้");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "4") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดี");
                array_push(${'data' . $questionid}, $array);
              } else {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดีมาก");
                array_push(${'data' . $questionid}, $array);
              }
            } else if ($charttype == "3") {
              if ($resultCountScore["score_value"] == "2") {
                $array = array("label" => "ควรปรับปรุง", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "3") {
                $array = array("label" => "พอใช้", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "4") {
                $array = array("label" => "ดี", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else {
                $array = array("label" => "ดีมาก", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              }
            }
          } else { // 5 btn
            if ($charttype == "1") {
              if ($resultCountScore["score_value"] == "1") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "แย่มาก");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "2") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "แย่");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "3") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "พอใช้");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "4") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดี");
                array_push(${'data' . $questionid}, $array);
              } else {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดีมาก");
                array_push(${'data' . $questionid}, $array);
              }
            } else if ($charttype == "2") {
              if ($resultCountScore["score_value"] == "1") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "แย่มาก");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "2") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "แย่");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "3") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "พอใช้");
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "4") {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดี");
                array_push(${'data' . $questionid}, $array);
              } else {
                $array = array("y" => intval($resultCountScore["countvalue"]), "label" => "ดีมาก");
                array_push(${'data' . $questionid}, $array);
              }
            } else if ($charttype == "3") {
              if ($resultCountScore["score_value"] == "1") {
                $array = array("label" => "แย่มาก", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "2") {
                $array = array("label" => "แย่", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "3") {
                $array = array("label" => "พอใช้", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else if ($resultCountScore["score_value"] == "4") {
                $array = array("label" => "ดี", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              } else {
                $array = array("label" => "ดีมาก", "y" => intval($resultCountScore["countvalue"]));
                array_push(${'data' . $questionid}, $array);
              }
            }
          }
        }
      }
      ${'data' . $questionsetid} = array();
      while ($resultCountScoreInQuestionSet = mysql_fetch_array($queryCountScoreInQuestionSet)) {
        if ($noBtn == "1") { // 4 btn
          if ($charttype == "1") {
            if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ควรปรับปรุง");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "พอใช้");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดี");
              array_push(${'data' . $questionsetid}, $array);
            } else {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดีมาก");
              array_push(${'data' . $questionsetid}, $array);
            }
          } else if ($charttype == "2") {
            if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ควรปรับปรุง");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "พอใช้");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดี");
              array_push(${'data' . $questionsetid}, $array);
            } else {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดีมาก");
              array_push(${'data' . $questionsetid}, $array);
            }
          } else if ($charttype == "3") {
            if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $array = array("label" => "ควรปรับปรุง", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $array = array("label" => "พอใช้", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $array = array("label" => "ดี", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else {
              $array = array("label" => "ดีมาก", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            }
          }
        } else { // 5 btn
          if ($charttype == "1") {
            if ($resultCountScoreInQuestionSet["score_value"] == "1") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "แย่มาก");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "แย่");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "พอใช้");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดี");
              array_push(${'data' . $questionsetid}, $array);
            } else {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดีมาก");
              array_push(${'data' . $questionsetid}, $array);
            }
          } else if ($charttype == "2") {
            if ($resultCountScoreInQuestionSet["score_value"] == "1") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "แย่มาก");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "แย่");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "พอใช้");
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดี");
              array_push(${'data' . $questionsetid}, $array);
            } else {
              $array = array("y" => intval($resultCountScoreInQuestionSet["countvalue"]), "label" => "ดีมาก");
              array_push(${'data' . $questionsetid}, $array);
            }
          } else if ($charttype == "3") {
            if ($resultCountScoreInQuestionSet["score_value"] == "1") {
              $array = array("label" => "แย่มาก", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $array = array("label" => "แย่", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $array = array("label" => "พอใช้", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $array = array("label" => "ดี", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            } else {
              $array = array("label" => "ดีมาก", "y" => intval($resultCountScoreInQuestionSet["countvalue"]));
              array_push(${'data' . $questionsetid}, $array);
            }
          }
        }
      }
    }
  }
?>
<html lang="">
  <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
  <head>
    <title>Pohjai : แอปพลิเคชันพอใจ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <script>
      window.onload = function() {
        <?php if ($chartdata == "2") { ?>
          <?php if (($resultGetInfoFlag["bi_age"] == "1") && ($charttype == "1")) { ?>
          var chartAge = new CanvasJS.Chart("chartAge", {
          	animationEnabled: true,
            exportEnabled: true,
          	theme: "light2",
          	title:{
          		text: "ช่วงอายุของผู้ทำแบบสอบถามความพึงพอใจ"
          	},
          	axisY: {
          		title: "จำนวน (คน)"
          	},
          	data: [{
          		type: "column",
          		yValueFormatString: "#,##0.## คน",
          		dataPoints: <?php echo json_encode($dataAge); ?>
          	}]
          });
          chartAge.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_age"] == "1") && ($charttype == "2")) { ?>
            var chartAge = new CanvasJS.Chart("chartAge", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
            	title: {
            		text: "ช่วงอายุของผู้ทำแบบสอบถามความพึงพอใจ"
            	},
            	axisY: {
            		title: "จำนวน (คน)"
            	},
            	data: [{
            		type: "line",
                yValueFormatString: "#,##0.## คน",
            		dataPoints: <?php echo json_encode($dataAge); ?>
            	}]
            });
            chartAge.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_age"] == "1") && ($charttype == "3")) { ?>
          var chartAge = new CanvasJS.Chart("chartAge", {
          	animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
          	title: {
          		text: "ช่วงอายุของผู้ทำแบบสอบถามความพึงพอใจ"
          	},
          	data: [{
          		type: "pie",
          		yValueFormatString: "#,##0 คน",
            	indexLabel: "{label} ({y})",
          		dataPoints: <?php echo json_encode($dataAge); ?>
          	}]
          });
          chartAge.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_sex"] == "1") && ($charttype == "1")) { ?>
          var chartSex = new CanvasJS.Chart("chartSex", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title:{
              text: "เพศของผู้ทำแบบสอบถามความพึงพอใจ"
            },
            axisY: {
              title: "จำนวน (คน)"
            },
            data: [{
              type: "column",
              yValueFormatString: "#,##0.## คน",
              dataPoints: <?php echo json_encode($dataSex); ?>
            }]
          });
          chartSex.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_sex"] == "1") && ($charttype == "2")) { ?>
            var chartSex = new CanvasJS.Chart("chartSex", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
              title: {
                text: "เพศของผู้ทำแบบสอบถามความพึงพอใจ"
              },
              axisY: {
                title: "จำนวน (คน)"
              },
              data: [{
                type: "line",
                yValueFormatString: "#,##0.## คน",
                dataPoints: <?php echo json_encode($dataSex); ?>
              }]
            });
            chartSex.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_sex"] == "1") && ($charttype == "3")) { ?>
          var chartSex = new CanvasJS.Chart("chartSex", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title: {
              text: "เพศของผู้ทำแบบสอบถามความพึงพอใจ"
            },
            data: [{
              type: "pie",
              yValueFormatString: "#,##0 คน",
              indexLabel: "{label} ({y})",
              dataPoints: <?php echo json_encode($dataSex); ?>
            }]
          });
          chartSex.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_education"] == "1") && ($charttype == "1")) { ?>
          var chartEducation = new CanvasJS.Chart("chartEducation", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title:{
              text: "ระดับการศึกษาของผู้ทำแบบสอบถามความพึงพอใจ"
            },
            axisY: {
              title: "จำนวน (คน)"
            },
            data: [{
              type: "column",
              yValueFormatString: "#,##0.## คน",
              dataPoints: <?php echo json_encode($dataEducation); ?>
            }]
          });
          chartEducation.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_education"] == "1") && ($charttype == "2")) { ?>
            var chartEducation = new CanvasJS.Chart("chartEducation", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
              title: {
                text: "ระดับการศึกษาของผู้ทำแบบสอบถามความพึงพอใจ"
              },
              axisY: {
                title: "จำนวน (คน)"
              },
              data: [{
                type: "line",
                yValueFormatString: "#,##0.## คน",
                dataPoints: <?php echo json_encode($dataEducation); ?>
              }]
            });
            chartEducation.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_education"] == "1") && ($charttype == "3")) { ?>
          var chartEducation = new CanvasJS.Chart("chartEducation", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title: {
              text: "ระดับการศึกษาของผู้ทำแบบสอบถามความพึงพอใจ"
            },
            data: [{
              type: "pie",
              yValueFormatString: "#,##0 คน",
              indexLabel: "{label} ({y})",
              dataPoints: <?php echo json_encode($dataEducation); ?>
            }]
          });
          chartEducation.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_salary"] == "1") && ($charttype == "1")) { ?>
          var chartSalary = new CanvasJS.Chart("chartSalary", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title:{
              text: "ช่วงรายได้ของผู้ทำแบบสอบถามความพึงพอใจ"
            },
            axisY: {
              title: "จำนวน (คน)"
            },
            data: [{
              type: "column",
              yValueFormatString: "#,##0.## คน",
              dataPoints: <?php echo json_encode($dataSalary); ?>
            }]
          });
          chartSalary.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_education"] == "1") && ($charttype == "2")) { ?>
            var chartSalary = new CanvasJS.Chart("chartSalary", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
              title: {
                text: "ช่วงรายได้ของผู้ทำแบบสอบถามความพึงพอใจ"
              },
              axisY: {
                title: "จำนวน (คน)"
              },
              data: [{
                type: "line",
                yValueFormatString: "#,##0.## คน",
                dataPoints: <?php echo json_encode($dataSalary); ?>
              }]
            });
            chartSalary.render();
          <?php } ?>

          <?php if (($resultGetInfoFlag["bi_salary"] == "1") && ($charttype == "3")) { ?>
          var chartSalary = new CanvasJS.Chart("chartSalary", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title: {
              text: "ช่วงรายได้ของผู้ทำแบบสอบถามความพึงพอใจ"
            },
            data: [{
              type: "pie",
              yValueFormatString: "#,##0 คน",
              indexLabel: "{label} ({y})",
              dataPoints: <?php echo json_encode($dataSalary); ?>
            }]
          });
          chartSalary.render();
          <?php } ?>

          <?php
            $sqlGetBasicQuestion = "SELECT * FROM basicQuestion WHERE bq_question_set_id = '$questionsetid' ORDER BY bq_id";
            $queryGetBasicQuestion = mysql_query($sqlGetBasicQuestion);
          ?>
          <?php while($resultGetBasicQuestion = mysql_fetch_array($queryGetBasicQuestion)) { ?>
            <?php if ($resultGetBasicQuestion["bq_type"] == "2") { ?>
              <?php if ($charttype == "1") { ?>
              var chart<?php echo $resultGetBasicQuestion["bq_id"]; ?> = new CanvasJS.Chart("chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light2",
                title:{
                  text: "คำถาม : <?php echo $resultGetBasicQuestion["bq_question"]; ?>"
                },
                axisY: {
                  title: "จำนวน (คน)"
                },
                data: [{
                  type: "column",
                  yValueFormatString: "#,##0.## คน",
                  dataPoints: <?php echo json_encode(${'data' . $resultGetBasicQuestion["bq_id"]}); ?>
                }]
              });
              chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>.render();
              <?php } ?>

              <?php if ($charttype == "2") { ?>
              var chart<?php echo $resultGetBasicQuestion["bq_id"]; ?> = new CanvasJS.Chart("chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light2",
                title: {
                  text: "คำถาม : <?php echo $resultGetBasicQuestion["bq_question"]; ?>"
                },
                axisY: {
                  title: "จำนวน (คน)"
                },
                data: [{
                  type: "line",
                  yValueFormatString: "#,##0.## คน",
                  dataPoints: <?php echo json_encode(${'data' . $resultGetBasicQuestion["bq_id"]}); ?>
                }]
              });
              chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>.render();
              <?php } ?>

              <?php if ($charttype == "3") { ?>
              var chart<?php echo $resultGetBasicQuestion["bq_id"]; ?> = new CanvasJS.Chart("chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light2",
                title: {
                  text: "คำถาม : <?php echo $resultGetBasicQuestion["bq_question"]; ?>"
                },
                data: [{
                  type: "pie",
                  yValueFormatString: "#,##0 คน",
                  indexLabel: "{label} ({y})",
                  dataPoints: <?php echo json_encode(${'data' . $resultGetBasicQuestion["bq_id"]}); ?>
                }]
              });
              chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>.render();
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } else { ?>
          <?php
            $sqlGetQuestionInQuestionSet = "SELECT * FROM question WHERE question_question_set_id = '$questionsetid' ORDER BY question_id";
            $queryGetQuestionInQuestionSet = mysql_query($sqlGetQuestionInQuestionSet);
          ?>
          <?php while($resultGetQuestionInQuestionSet = mysql_fetch_array($queryGetQuestionInQuestionSet)) { ?>
            <?php if ($charttype == "1") { ?>
            var chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?> = new CanvasJS.Chart("chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
              title:{
                text: "หัวข้อ : <?php echo $resultGetQuestionInQuestionSet["question_name"]; ?>"
              },
              axisY: {
                title: "จำนวน (คน)"
              },
              data: [{
                type: "column",
                yValueFormatString: "#,##0.## คน",
                dataPoints: <?php echo json_encode(${'data' . $resultGetQuestionInQuestionSet["question_id"]}); ?>
              }]
            });
            chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>.render();
            <?php } ?>

            <?php if ($charttype == "2") { ?>
            var chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?> = new CanvasJS.Chart("chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
              title: {
                text: "หัวข้อ : <?php echo $resultGetQuestionInQuestionSet["question_name"]; ?>"
              },
              axisY: {
                title: "จำนวน (คน)"
              },
              data: [{
                type: "line",
                yValueFormatString: "#,##0.## คน",
                dataPoints: <?php echo json_encode(${'data' . $resultGetQuestionInQuestionSet["question_id"]}); ?>
              }]
            });
            chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>.render();
            <?php } ?>

            <?php if ($charttype == "3") { ?>
            var chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?> = new CanvasJS.Chart("chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>", {
              animationEnabled: true,
              exportEnabled: true,
              theme: "light2",
              title: {
                text: "หัวข้อ : <?php echo $resultGetQuestionInQuestionSet["question_name"]; ?>"
              },
              data: [{
                type: "pie",
                yValueFormatString: "#,##0 คน",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode(${'data' . $resultGetQuestionInQuestionSet["question_id"]}); ?>
              }]
            });
            chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>.render();
            <?php } ?>
          <?php } ?>
          <?php if ($charttype == "1") { ?>
          var chart<?php echo $questionsetid; ?> = new CanvasJS.Chart("chart<?php echo $questionsetid; ?>", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title:{
              text: "สรุปภาพรวมทั้งหมด"
            },
            axisY: {
              title: "จำนวน (คน)"
            },
            data: [{
              type: "column",
              yValueFormatString: "#,##0.## คน",
              dataPoints: <?php echo json_encode(${'data' . $questionsetid}); ?>
            }]
          });
          chart<?php echo $questionsetid; ?>.render();
          <?php } ?>

          <?php if ($charttype == "2") { ?>
          var chart<?php echo $questionsetid; ?> = new CanvasJS.Chart("chart<?php echo $questionsetid; ?>", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title: {
              text: "สรุปภาพรวมทั้งหมด"
            },
            axisY: {
              title: "จำนวน (คน)"
            },
            data: [{
              type: "line",
              yValueFormatString: "#,##0.## คน",
              dataPoints: <?php echo json_encode(${'data' . $questionsetid}); ?>
            }]
          });
          chart<?php echo $questionsetid; ?>.render();
          <?php } ?>

          <?php if ($charttype == "3") { ?>
          var chart<?php echo $questionsetid; ?> = new CanvasJS.Chart("chart<?php echo $questionsetid; ?>", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title: {
              text: "สรุปภาพรวมทั้งหมด"
            },
            data: [{
              type: "pie",
              yValueFormatString: "#,##0 คน",
              indexLabel: "{label} ({y})",
              dataPoints: <?php echo json_encode(${'data' . $questionsetid}); ?>
            }]
          });
          chart<?php echo $questionsetid; ?>.render();
          <?php } ?>
        <?php } ?>
      }
    </script>
  </head>
  <body id="top">
    <div class="wrapper row0">
      <div id="topbar" class="hoc clear">
        <div class="fl_left">
          <ul class="nospace">
            <li><a href="../index.html"><i class="fas fa-home fa-lg"></i></a></li>
            <li><a href="#">เกี่ยวกับเรา</a></li>
          </ul>
        </div>
        <div class="fl_right">
          <ul class="nospace">
            <?php if ($_SESSION) { ?>
            <li><i class="fas fa-user rgtspace-5"> ยินดีต้อนรับ <?php echo $_SESSION["member_username"]; ?></i>
            <li><i class="fas fa-sign-out-alt rgtspace-5"></i><a href="member.php?action=logout"> Log Out</a></li>
            <?php } else { ?>
            <li><i class="fas fa-phone rgtspace-5"></i> 080-9907722</li>
            <li><i class="fas fa-envelope rgtspace-5"></i> info@pohjai.com</li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="wrapper row1">
      <header id="header" class="hoc clear">
        <div id="logo" class="one_half first">
          <h1 class="logoname"><a href="../index.html"><span>Pohjai</span> พอใจ</a></h1>
        </div>
        <div class="one_half">
          <ul class="nospace clear">
            <li class="one_half first">
              <div class="block clear"><i class="fas fa-phone"></i><span><strong class="block">ติดต่อเรา : </strong> 080-9907722</span></div>
            </li>
            <li class="one_half">
              <div class="block clear"><i class="far fa-clock"></i><span><strong class="block">จันทร์ - เสาร์ : </strong> 09.00 - 18.00 น.</span></div>
            </li>
          </ul>
        </div>
      </header>
    </div>
    <div class="wrapper row1">
      <section class="hoc container clear">
        <div class="sectiontitle">
          <h6 class="heading"><?php echo $title; ?></h6>
        </div>
        <?php if ($chartdata == "2") { ?>
          <?php if ($resultGetInfoFlag["bi_name"] == "1") { ?>
          <form action="alllist.php" method="POST">
            <center>
              <label style="font-family: arial; font-size: 32px; font-weight: bold;">รายชื่อผู้ทำแบบสอบถามความพึงพอใจ :</label><br><br>
              <input type="hidden" name="questionsetid" value="<?php echo $questionsetid; ?>">
              <input type="hidden" name="name" value="1">
              <input type="hidden" name="startdatetime" value="<?php echo $startdatetime; ?>">
              <input type="hidden" name="enddatetime" value="<?php echo $enddatetime; ?>">
              <input type="submit" name="chart" class="btn" value="ดูรายชื่อผู้ทำแบบสอบถามความพึงพอใจ"><br><br><br><br>
            </center>
          </form>
          <?php } ?>
          <div id="chartAge" style="height: 370px; width: 100%;"></div><br><br>
          <div id="chartSex" style="height: 370px; width: 100%;"></div><br><br>
          <div id="chartEducation" style="height: 370px; width: 100%;"></div><br><br>
          <div id="chartSalary" style="height: 370px; width: 100%;"></div><br><br>
          <?php
            $sqlGetBasicQuestion = "SELECT * FROM basicQuestion WHERE bq_question_set_id = '$questionsetid' ORDER BY bq_id";
            $queryGetBasicQuestion = mysql_query($sqlGetBasicQuestion);
          ?>
          <?php while($resultGetBasicQuestion = mysql_fetch_array($queryGetBasicQuestion)) { ?>
            <?php if ($resultGetBasicQuestion["bq_type"] == "1") { ?>
            <form action="alllist.php" method="POST">
              <center>
                <label style="font-family: arial; font-size: 32px; font-weight: bold;">คำถาม : <?php echo $resultGetBasicQuestion["bq_question"]; ?></label><br><br>
                <input type="hidden" name="questionsetid" value="<?php echo $questionsetid; ?>">
                <input type="hidden" name="ansbqid" value="<?php echo $resultGetBasicQuestion["bq_id"]; ?>">
                <input type="hidden" name="startdatetime" value="<?php echo $startdatetime; ?>">
                <input type="hidden" name="enddatetime" value="<?php echo $enddatetime; ?>">
                <input type="submit" name="chart" class="btn" value="ดูคำตอบของผู้ทำแบบสอบถามความพึงพอใจ"><br><br><br><br>
              </center>
            </form>
            <?php } else { ?>
            <div id="chart<?php echo $resultGetBasicQuestion["bq_id"]; ?>" style="height: 370px; width: 100%;"></div><br><br>
            <?php } ?>
          <?php } ?>
        <?php } else { ?>
          <?php
            $sqlGetQuestionInQuestionSet = "SELECT * FROM question WHERE question_question_set_id = '$questionsetid' ORDER BY question_id";
            $queryGetQuestionInQuestionSet = mysql_query($sqlGetQuestionInQuestionSet);
          ?>
          <?php while($resultGetQuestionInQuestionSet = mysql_fetch_array($queryGetQuestionInQuestionSet)) { ?>
          <div id="chart<?php echo $resultGetQuestionInQuestionSet["question_id"]; ?>" style="height: 370px; width: 100%;"></div><br><br>
          <?php } ?>
          <div id="chart<?php echo $questionsetid; ?>" style="height: 370px; width: 100%;"></div><br><br>
        <?php } ?>
      </section>
    </div>
    <div class="wrapper row2">
      <footer id="footer" class="hoc clear">
        <div class="one_third first">
          <h1 class="logoname"><span>Pohjai</span> พอใจ</h1>
          <!-- <p class="btmspace-30">Sem nam et erat nec eros elementum gravida proin bibendum diam sed congue sagittis metus risus rutrum mauris sed euismod nisl purus vel leo phasellus nunc erat cursus aliquet [<a href="#">&hellip;</a>]</p> -->
          <p class="btmspace-30">แอปพลิเคชันพอใจ เป็นแอปพลิเคชันประเมินความพึงพอใจของลูกค้าหรือผู้ได้รับบริการจากที่ต่างๆ ให้สามารถประเมินความพึงพอใจได้
            สามารถตั้งค่าการใช้งานได้หลากหลายตามความต้องการของผู้ใช้งาน นอกจากนี้ยังมีการแสดงผลแบบกราฟ ซึ่งจะช่วยทำให้ท่านดูผลได้เข้าใจง่ายยิ่งขึ้น</p>
          <!-- <ul class="faico clear">
            <li><a class="faicon-dribble" href="#"><i class="fab fa-dribbble"></i></a></li>
            <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
            <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
          </ul> -->
        </div>
      </footer>
    </div>
    <div class="wrapper row5">
      <div id="copyright" class="hoc clear">
        <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
        <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
      </div>
    </div>
    <a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  </body>
</html>

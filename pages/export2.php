<?php
  include "../dbphp/connect.php";
  require_once '../Classes/PHPExcel.php';

  $questionsetid = $_REQUEST["questionsetid"];
  $chartdata = $_REQUEST["chartdata"];
  $startdatetime = $_REQUEST["startdatetime"];
  $enddatetime = $_REQUEST["enddatetime"];

  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getActiveSheet();

  if ($chartdata == "1") {
    $sqlGetQuestionSetNoBtn = "SELECT * FROM questionSet WHERE question_set_id = '$questionsetid'";
    $queryGetQuestionSetNoBtn = mysql_query($sqlGetQuestionSetNoBtn);
    $resultGetQuestionSetNoBtn = mysql_fetch_array($queryGetQuestionSetNoBtn);
    $questionsetname = $resultGetQuestionSetNoBtn["question_set_name"];
    $noBtn = $resultGetQuestionSetNoBtn["question_set_number_btn"];
    $commentFlag = $resultGetQuestionSetNoBtn["question_set_comment"];

    $sqlGetQuestionInQuestionSet = "SELECT * FROM question WHERE question_question_set_id = '$questionsetid' ORDER BY question_id";
    $queryGetQuestionInQuestionSet = mysql_query($sqlGetQuestionInQuestionSet);

    $sqlCountScoreInQuestionSet = "SELECT count(score_value) as countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '$questionsetid'
                                  AND s.score_datetime >= '$startdatetime' AND s.score_datetime <= '$enddatetime' AND s.score_question_id = q.question_id
                                  AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";
    $queryCountScoreInQuestionSet = mysql_query($sqlCountScoreInQuestionSet);
    $countCountScoreInQuestionSet = mysql_num_rows($queryCountScoreInQuestionSet);

    if ($countCountScoreInQuestionSet == 0) {
      echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
      echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
      ?><script>window.location="../pages/member.php";</script><?php
    }

    $rowCount = 1;
    $columnCount = 'A';

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', $questionsetname);
    $rowCount = $rowCount + 1;

    while ($resultGetQuestionInQuestionSet = mysql_fetch_array($queryGetQuestionInQuestionSet)) {
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบประเมินความพึงพอใจ');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $resultGetQuestionInQuestionSet["question_name"]);
      $rowCount = $rowCount + 1;

      $questionid = $resultGetQuestionInQuestionSet["question_id"];
      $sqlCountScore = "SELECT count(score_value) as countvalue, s.score_value FROM score s WHERE score_question_id = '$questionid' AND score_datetime >= '$startdatetime'
                        AND score_datetime <= '$enddatetime' GROUP BY score_value ORDER BY score_value";
      $queryCountScore = mysql_query($sqlCountScore);

      $scoreColumnCount = $columnCount;

      while ($resultCountScore = mysql_fetch_array($queryCountScore)) {
        $scoreRowCount = $rowCount;
        if ($noBtn == "1") {
          if ($resultCountScore["score_value"] == "2") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'ควรปรับปรุง');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "3") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'พอใช้');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "4") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'ดี');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "5") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'ดีมาก');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          }
        } else {
          if ($resultCountScore["score_value"] == "1") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'แย่มาก');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "2") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'แย่');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "3") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'พอใช้');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "4") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'ดี');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          } else if ($resultCountScore["score_value"] == "5") {
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, 'ดีมาก');
            $scoreRowCount = $scoreRowCount + 1;
            $objPHPExcel->getActiveSheet()->setCellValue($scoreColumnCount . $scoreRowCount, $resultCountScore["countvalue"]);
            $scoreColumnCount++;
          }
        }
      }
      $rowCount = $rowCount + 2;
    }

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'สรุปผลประเมินความพึงพอใจ');

    $rowCount = $rowCount + 1;
    $sumColumnCount = $columnCount;

    while ($resultCountScoreInQuestionSet = mysql_fetch_array($queryCountScoreInQuestionSet)) {
      $sumRowCount = $rowCount;
      if ($noBtn == "1") {
        if ($resultCountScoreInQuestionSet["score_value"] == "2") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'ควรปรับปรุง');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'พอใช้');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'ดี');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "5") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'ดีมาก');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        }
      } else {
        if ($resultCountScoreInQuestionSet["score_value"] == "1") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'แย่มาก');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "2") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'แย่');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'พอใช้');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'ดี');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        } else if ($resultCountScoreInQuestionSet["score_value"] == "5") {
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, 'ดีมาก');
          $sumRowCount = $sumRowCount + 1;
          $objPHPExcel->getActiveSheet()->setCellValue($sumColumnCount . $sumRowCount, $resultCountScoreInQuestionSet["countvalue"]);
          $sumColumnCount++;
        }
      }
    }

    $objPHPExcel->getActiveSheet()->setTitle('การประเมินความพึงพอใจ');

    if ($commentFlag == "1") {
      $sqlGetComment = "SELECT * FROM comment WHERE comment_question_set_id = '$questionsetid' AND comment_datetime >= '$startdatetime' AND comment_datetime <= '$enddatetime'";
      $queryGetComment = mysql_query($sqlGetComment);

      $objWorksheet = $objPHPExcel->createSheet(1);

      $rowCount = 1;
      $columnCount = 'A';

      $objWorksheet->getColumnDimension('A')->setWidth(30);
      $objWorksheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objWorksheet->getColumnDimension('B')->setWidth(30);
      $objWorksheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $objWorksheet->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
      $objWorksheet->setCellValue('B1', $questionsetname);
      $rowCount = $rowCount + 1;

      $objWorksheet->setCellValue('A2', 'ลำดับ');
      $objWorksheet->setCellValue('B2', 'ข้อเสนอแนะเพิ่มเติม');
      $rowCount = $rowCount + 1;
      $index = 1;

      while ($resultGetComment = mysql_fetch_array($queryGetComment)) {
        $commentColumnCount = $columnCount;
        $objWorksheet->setCellValue($commentColumnCount . $rowCount, $index);
        $commentColumnCount++;
        $objWorksheet->setCellValue($commentColumnCount . $rowCount, $resultGetComment["comment_detail"]);
        $rowCount++;
        $index++;
      }
      $objWorksheet->setTitle('ข้อเสนอแนะเพิ่มเติม');
    }
  } else {
    $sqlGetQuestionSetNoBtn = "SELECT * FROM questionSet WHERE question_set_id = '$questionsetid'";
    $queryGetQuestionSetNoBtn = mysql_query($sqlGetQuestionSetNoBtn);
    $resultGetQuestionSetNoBtn = mysql_fetch_array($queryGetQuestionSetNoBtn);
    $questionsetname = $resultGetQuestionSetNoBtn["question_set_name"];

    $sqlGetInfoFlag = "SELECT * FROM basicInfo WHERE bi_question_set_id = '$questionsetid'";
    $queryGetInfoFlag = mysql_query($sqlGetInfoFlag);
    $resultGetInfoFlag = mysql_fetch_array($queryGetInfoFlag);

    if ($resultGetInfoFlag["bi_age"] == "1") {
      $sqlCountAge = "SELECT count(info_age) as countage, info_age FROM info WHERE info_question_set_id = '$questionsetid'
                      AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_age ORDER BY info_age ASC";
      $queryCountAge = mysql_query($sqlCountAge);
      $countRowAge = mysql_num_rows($queryCountAge);
      if ($countRowAge == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    if ($resultGetInfoFlag["bi_sex"] == "1") {
      $sqlCountSex = "SELECT count(info_sex) as countsex, info_sex FROM info WHERE info_question_set_id = '$questionsetid'
                      AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_sex ORDER BY info_sex DESC";
      $queryCountSex = mysql_query($sqlCountSex);
      $countRowSex = mysql_num_rows($queryCountSex);
      if ($countRowSex == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    if ($resultGetInfoFlag["bi_education"] == "1") {
      $sqlCountEducation = "SELECT count(info_education) as counteducation, info_education FROM info WHERE info_question_set_id = '$questionsetid'
                            AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_education";
      $queryCountEducation = mysql_query($sqlCountEducation);
      $countRowEducation = mysql_num_rows($queryCountEducation);
      if ($countRowEducation == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    if ($resultGetInfoFlag["bi_salary"] == "1") {
      $sqlCountSalary = "SELECT count(info_income) as countincome, info_income FROM info WHERE info_question_set_id = '$questionsetid' AND info_datetime >= '$startdatetime'
                          AND info_datetime <= '$enddatetime' GROUP BY info_income";
      $queryCountSalary = mysql_query($sqlCountSalary);
      $countRowSalary = mysql_num_rows($queryCountSalary);
      if ($countRowSalary == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    $rowCount = 1;
    $columnCount = 'A';

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', $questionsetname);
    $rowCount = $rowCount + 1;

    if ($resultGetInfoFlag["bi_age"] == "1") {
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'อายุ');
      $rowCount = $rowCount + 1;

      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, '10-15 ปี');
      $ageIndex1 = 'A' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, '16-20 ปี');
      $ageIndex2 = 'B' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, '21-25 ปี');
      $ageIndex3 = 'C' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, '26-30 ปี');
      $ageIndex4 = 'D' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, '31-35 ปี');
      $ageIndex5 = 'E' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, '36-40 ปี');
      $ageIndex6 = 'F' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, '41-45 ปี');
      $ageIndex7 = 'G' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowCount, '46-50 ปี');
      $ageIndex8 = 'H' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('I' . $rowCount, '51-55 ปี');
      $ageIndex9 = 'I' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('J' . $rowCount, '56-60 ปี');
      $ageIndex10 = 'J' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('K' . $rowCount, '61 ปีขึ้นไป');
      $ageIndex11 = 'K' . ($rowCount + 1);

      while ($resultCountAge = mysql_fetch_array($queryCountAge)) {
        if ($resultCountAge["info_age"] == "10-15") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex1 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "16-20") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex2 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "21-25") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex3 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "26-30") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex4 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "31-35") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex5 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "36-40") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex6 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "41-45") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex7 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "46-50") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex8 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "51-55") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex9 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "56-60") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex10 , $resultCountAge["countage"]);
        } else if ($resultCountAge["info_age"] == "61+") {
          $objPHPExcel->getActiveSheet()->setCellValue($ageIndex11 , $resultCountAge["countage"]);
        }
      }
      $rowCount = $rowCount + 2;
    }

    if ($resultGetInfoFlag["bi_sex"] == "1") {
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'เพศ');
      $rowCount = $rowCount + 1;

      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'ผู้ชาย');
      $sexIndex1 = 'A' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'ผู้หญิง');
      $sexIndex2 = 'B' . ($rowCount + 1);

      while ($resultCountSex = mysql_fetch_array($queryCountSex)) {
        if ($resultCountSex["info_sex"] == "Male") {
          $objPHPExcel->getActiveSheet()->setCellValue($sexIndex1 , $resultCountSex["countsex"]);
        } else if ($resultCountSex["info_sex"] == "Female") {
          $objPHPExcel->getActiveSheet()->setCellValue($sexIndex2 , $resultCountSex["countsex"]);
        }
      }
      $rowCount = $rowCount + 2;
    }

    if ($resultGetInfoFlag["bi_education"] == "1") {
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'ระดับการศึกษา');
      $rowCount = $rowCount + 1;

      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'ต่ำกว่ามัธยมศึกษา');
      $educationIndex1 = 'A' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'มัธยมศึกษาหรือเทียบเท่า');
      $educationIndex2 = 'B' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, 'อนุปริญญาหรือเทียบเท่า');
      $educationIndex3 = 'C' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, 'ปริญญาตรี');
      $educationIndex4 = 'D' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, 'ปริญญาโท');
      $educationIndex5 = 'E' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, 'ปริญญาเอก');
      $educationIndex6 = 'F' . ($rowCount + 1);

      while ($resultCountEducation = mysql_fetch_array($queryCountEducation)) {
        if ($resultCountEducation["info_education"] == "Lower Secondary School") {
          $objPHPExcel->getActiveSheet()->setCellValue($educationIndex1 , $resultCountEducation["counteducation"]);
        } else if ($resultCountEducation["info_education"] == "Secondary School") {
          $objPHPExcel->getActiveSheet()->setCellValue($educationIndex2 , $resultCountEducation["counteducation"]);
        } else if ($resultCountEducation["info_education"] == "Diploma") {
          $objPHPExcel->getActiveSheet()->setCellValue($educationIndex3 , $resultCountEducation["counteducation"]);
        } else if ($resultCountEducation["info_education"] == "Bachelor Degree") {
          $objPHPExcel->getActiveSheet()->setCellValue($educationIndex4 , $resultCountEducation["counteducation"]);
        } else if ($resultCountEducation["info_education"] == "Master Degree") {
          $objPHPExcel->getActiveSheet()->setCellValue($educationIndex5 , $resultCountEducation["counteducation"]);
        } else if ($resultCountEducation["info_education"] == "Doctor Degree") {
          $objPHPExcel->getActiveSheet()->setCellValue($educationIndex6 , $resultCountEducation["counteducation"]);
        }
      }
      $rowCount = $rowCount + 2;
    }

    if ($resultGetInfoFlag["bi_salary"] == "1") {
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'รายได้');
      $rowCount = $rowCount + 1;

      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'ไม่มีรายได้');
      $salaryIndex1 = 'A' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'ต่ำกว่า 5,000 บาท/เดือน');
      $salaryIndex2 = 'B' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, '5,001 - 10,000 บาท/เดือน');
      $salaryIndex3 = 'C' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, '10,001 - 15,000 บาท/เดือน');
      $salaryIndex4 = 'D' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, '15,001 - 20,000 บาท/เดือน');
      $salaryIndex5 = 'E' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, '20,001 - 30,000 บาท/เดือน');
      $salaryIndex6 = 'F' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, '30,001 - 40,000 บาท/เดือน');
      $salaryIndex7 = 'G' . ($rowCount + 1);
      $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowCount, '40,001 บาท/เดือน ขึ้นไป');
      $salaryIndex8 = 'H' . ($rowCount + 1);

      while ($resultCountSalary = mysql_fetch_array($queryCountSalary)) {
        if ($resultCountSalary["info_income"] == "0") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex1 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "Less than 5,000") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex2 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "5,001 - 10,000") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex3 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "10,001 - 15,000") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex4 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "15,001 - 20,000") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex5 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "20,001 - 30,000") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex6 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "30,001 - 40,000") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex7 , $resultCountSalary["countincome"]);
        } else if ($resultCountSalary["info_income"] == "More than 40,001") {
          $objPHPExcel->getActiveSheet()->setCellValue($salaryIndex8 , $resultCountSalary["countincome"]);
        }
      }
      $rowCount = $rowCount + 2;
    }

    $sqlGetBasicQuestion = "SELECT * FROM basicQuestion WHERE bq_question_set_id = '$questionsetid' ORDER BY bq_id";
    $queryGetBasicQuestion = mysql_query($sqlGetBasicQuestion);

    while ($resultGetBasicQuestion = mysql_fetch_array($queryGetBasicQuestion)) {
      if ($resultGetBasicQuestion["bq_type"] == "2") {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'คำถามเบื้องต้น');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $resultGetBasicQuestion["bq_question"]);
        $rowCount = $rowCount + 1;

        $bqid = $resultGetBasicQuestion["bq_id"];
        $sqlGetBasicQuestionAns = "SELECT * FROM basicQuestionAns WHERE bqa_bq_id = '$bqid' ORDER BY bqa_id";
        $queryGetBasicQuestionAns = mysql_query($sqlGetBasicQuestionAns);

        $bqaColumnCount = $columnCount;

        while ($resultGetBasicQuestionAns = mysql_fetch_array($queryGetBasicQuestionAns)) {
          $bqaRowCount = $rowCount;

          $objPHPExcel->getActiveSheet()->setCellValue($bqaColumnCount . $bqaRowCount, $resultGetBasicQuestionAns["bqa_ans"]);
          $bqaRowCount = $bqaRowCount + 1;

          $bqaid = $resultGetBasicQuestionAns["bqa_id"];

          $sqlCountAns = "SELECT count(a.ans_answer) as countans, a.* FROM answer a, info i WHERE a.ans_bqa_id = '$bqaid' AND i.info_datetime >= '$startdatetime' AND i.info_datetime <= '$enddatetime'
                          AND a.ans_info_id = i.info_id GROUP BY a.ans_answer ORDER BY a.ans_bqa_id";
          $queryCountAns = mysql_query($sqlCountAns);
          $resultCountAns = mysql_fetch_array($queryCountAns);

          $objPHPExcel->getActiveSheet()->setCellValue($bqaColumnCount . $bqaRowCount, $resultCountAns["countans"]);
          $bqaColumnCount++;
        }
        $rowCount = $rowCount + 2;
      }
    }

    $objPHPExcel->getActiveSheet()->setTitle('แบบสอบถามเบื้องต้น');

    if ($resultGetInfoFlag["bi_name"] == "1") {
      $objWorksheet = $objPHPExcel->createSheet(1);

      $rowCount = 1;
      $columnCount = 'A';

      $objWorksheet->getColumnDimension('A')->setWidth(30);
      $objWorksheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objWorksheet->getColumnDimension('B')->setWidth(50);
      $objWorksheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $sqlGetName = "SELECT * FROM info WHERE info_question_set_id = '$questionsetid' AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime'";
      $queryGetName = mysql_query($sqlGetName);

      $objWorksheet->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
      $objWorksheet->setCellValue('B1', $questionsetname);
      $rowCount = $rowCount + 1;

      $objWorksheet->setCellValue('A2', 'ลำดับ');
      $objWorksheet->setCellValue('B2', 'รายชื่อผู้ตอบแบบสอบถามเบื้องต้น');
      $rowCount = $rowCount + 1;
      $index = 1;

      while ($resultGetName = mysql_fetch_array($queryGetName)) {
        if ($resultGetName["info_name"] != "-") {
          $nameColumnCount = $columnCount;
          $objWorksheet->setCellValue($nameColumnCount . $rowCount, $index);
          $nameColumnCount++;
          $objWorksheet->setCellValue($nameColumnCount . $rowCount, $resultGetName["info_name"]);
          $rowCount++;
          $index++;
        }
      }
      $objWorksheet->setTitle('รายชื่อผู้ตอบแบบสอบถามเบื้องต้น');
    }

    $sqlGetBasicQuestion2 = "SELECT * FROM basicQuestion WHERE bq_question_set_id = '$questionsetid' ORDER BY bq_id";
    $queryGetBasicQuestion2 = mysql_query($sqlGetBasicQuestion2);
    $index2 = 1;

    while ($resultGetBasicQuestion2 = mysql_fetch_array($queryGetBasicQuestion2)) {
      if ($resultGetBasicQuestion2["bq_type"] == "1") {
        $objWorksheet = $objPHPExcel->createSheet(1);

        $rowCount = 1;
        $columnCount = 'A';

        $objWorksheet->getColumnDimension('A')->setWidth(30);
        $objWorksheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objWorksheet->getColumnDimension('B')->setWidth(50);
        $objWorksheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $bqid = $resultGetBasicQuestion2["bq_id"];
        $sqlCount= "SELECT * FROM answer a, info i WHERE a.ans_bq_id = '$bqid' AND i.info_datetime >= '$startdatetime' AND i.info_datetime <= '$enddatetime'
                    AND a.ans_info_id = i.info_id  ORDER BY i.info_datetime";
        $queryCount = mysql_query($sqlCount);

        $objWorksheet->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
        $objWorksheet->setCellValue('B1', $questionsetname);
        $rowCount = $rowCount + 1;

        $objWorksheet->setCellValue('A2', 'คำถามเบื้องต้น');
        $objWorksheet->setCellValue('B2', $resultGetBasicQuestion2["bq_question"]);
        $rowCount = $rowCount + 1;

        $objWorksheet->setCellValue('A3', 'ลำดับ');
        $objWorksheet->setCellValue('B3', 'รายการคำตอบ');
        $rowCount = $rowCount + 1;
        $index3 = 1;

        while ($resultCount = mysql_fetch_array($queryCount)) {
          $countColumnCount = $columnCount;
          $objWorksheet->setCellValue($countColumnCount . $rowCount, $index3);
          $countColumnCount++;
          $objWorksheet->setCellValue($countColumnCount . $rowCount, $resultCount["ans_answer"]);
          $rowCount++;
          $index3++;
        }
        $objWorksheet->setTitle($resultGetBasicQuestion2["bq_question"]);
        $index2++;
      }
    }
  }

  header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="pohjaiexport.xlsx"');
  header('Cache-Control: max-age=0');


  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->setPreCalculateFormulas(TRUE);
  $objWriter->save('php://output');
  exit;
?>

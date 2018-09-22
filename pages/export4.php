<?php
  include "../dbphp/connect.php";
  require_once '../Classes/PHPExcel.php';

  $questionsetid = $_REQUEST["questionsetid"];
  $chartdata = $_REQUEST["chartdata"];
  $startdatetime = $_REQUEST["startdatetime"];
  $enddatetime = $_REQUEST["enddatetime"];

  $startInSecond = strtotime($startdatetime);
  $endInSecond = strtotime($enddatetime);

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

    $sqlCountRowScoreInQuestionSet = "SELECT count(score_value) AS countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '$questionsetid'
                                      AND s.score_datetime >= '$startdatetime' AND s.score_datetime <= '$enddatetime' AND s.score_question_id = q.question_id
                                      AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";
    $queryCountRowScoreInQuestionSet = mysql_query($sqlCountRowScoreInQuestionSet);
    $countCountRowScoreInQuestionSet = mysql_num_rows($queryCountRowScoreInQuestionSet);

    if ($countCountRowScoreInQuestionSet == 0) {
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

      if ($noBtn == "1") {
        $noBtnColumn = $columnCount;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'วัน-เดือน-ปี');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ควรปรับปรุง');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'พอใช้');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดี');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดีมาก');
        $rowCount++;
        $noBtnColumn++;
      } else {
        $noBtnColumn = $columnCount;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'วัน-เดือน-ปี');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'แย่มาก');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'แย่');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'พอใช้');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดี');
        $noBtnColumn++;
        $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดีมาก');
        $rowCount++;
        $noBtnColumn++;
      }

      $questionid = $resultGetQuestionInQuestionSet["question_id"];

      for ($start = $startInSecond; $start <= $endInSecond; $start += 86400) {
        $end = $start + 86400;
        $startDateTime = date("Y-m-d", $start);
        $endDateTime = date("Y-m-d", $end);

        $reverseStartDateTime = date("d-m-Y", $start);
        $reverseEndDateTime = date("d-m-Y", $end);

        $sqlCountScorePerQuestion = "SELECT count(score_value) AS countvalue, score_value, DATE(s.score_datetime) AS day FROM score s WHERE score_question_id = '$questionid'
                                    AND score_datetime >= '$startDateTime' AND score_datetime <= '$endDateTime' GROUP BY score_value, DATE(s.score_datetime)
                                    ORDER BY DATE(s.score_datetime) ASC, s.score_value";
        $queryCountScorePerQuestion = mysql_query($sqlCountScorePerQuestion);
        $countRowCountScorePerQuestion = mysql_num_rows($queryCountScorePerQuestion);

        $forColumn = $columnCount;

        if ($countRowCountScorePerQuestion != 0) {
          if ($noBtn == "1") {
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, $reverseStartDateTime);
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index1 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index2 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index3 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index4 = $forColumn . $rowCount;

            while ($resultCountScorePerQuestion = mysql_fetch_array($queryCountScorePerQuestion)) {
              if ($resultCountScorePerQuestion["score_value"] == "2") {
                $objPHPExcel->getActiveSheet()->setCellValue($index1, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "3") {
                $objPHPExcel->getActiveSheet()->setCellValue($index2, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "4") {
                $objPHPExcel->getActiveSheet()->setCellValue($index3, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "5") {
                $objPHPExcel->getActiveSheet()->setCellValue($index4, $resultCountScorePerQuestion["countvalue"]);
              }
            }
            $rowCount++;
          } else {
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, $reverseStartDateTime);
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index1 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index2 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index3 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index4 = $forColumn . $rowCount;
            $forColumn++;
            $objPHPExcel->getActiveSheet()->setCellValue($forColumn . $rowCount, '0');
            $index5 = $forColumn . $rowCount;

            while ($resultCountScorePerQuestion = mysql_fetch_array($queryCountScorePerQuestion)) {
              if ($resultCountScorePerQuestion["score_value"] == "1") {
                $objPHPExcel->getActiveSheet()->setCellValue($index1, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "2") {
                $objPHPExcel->getActiveSheet()->setCellValue($index2, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "3") {
                $objPHPExcel->getActiveSheet()->setCellValue($index3, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "4") {
                $objPHPExcel->getActiveSheet()->setCellValue($index4, $resultCountScorePerQuestion["countvalue"]);
              } else if ($resultCountScorePerQuestion["score_value"] == "5") {
                $objPHPExcel->getActiveSheet()->setCellValue($index5, $resultCountScorePerQuestion["countvalue"]);
              }
            }
            $rowCount++;
          }
        }
      }
    }

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'สรุปผลประเมินความพึงพอใจ');
    $rowCount = $rowCount + 1;

    if ($noBtn == "1") {
      $noBtnColumn = $columnCount;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'วัน-เดือน-ปี');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ควรปรับปรุง');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'พอใช้');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดี');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดีมาก');
      $rowCount++;
      $noBtnColumn++;
    } else {
      $noBtnColumn = $columnCount;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'วัน-เดือน-ปี');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'แย่มาก');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'แย่');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'พอใช้');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดี');
      $noBtnColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($noBtnColumn . $rowCount, 'ดีมาก');
      $rowCount++;
      $noBtnColumn++;
    }

    for ($start2 = $startInSecond; $start2 <= $endInSecond; $start2 += 86400) {
      $end2 = $start2 + 86400;
      $startDateTime2 = date("Y-m-d", $start2);
      $endDateTime2 = date("Y-m-d", $end2);

      $reverseStartDateTime2 = date("d-m-Y", $start2);
      $reverseEndDateTime2 = date("d-m-Y", $end2);

      $sqlCountScoreInQuestionSet = "SELECT count(score_value) AS countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '$questionsetid'
                                    AND s.score_datetime >= '$startDateTime2' AND s.score_datetime <= '$endDateTime2' AND s.score_question_id = q.question_id
                                    AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";
      $queryCountScoreInQuestionSet = mysql_query($sqlCountScoreInQuestionSet);
      $countCountScoreInQuestionSet = mysql_num_rows($queryCountScoreInQuestionSet);

      $for2Column = $columnCount;

      if ($countCountScoreInQuestionSet != 0) {
        if ($noBtn == "1") {
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, $reverseStartDateTime2);
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index1 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index2 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index3 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index4 = $for2Column . $rowCount;

          while ($resultCountScoreInQuestionSet = mysql_fetch_array($queryCountScoreInQuestionSet)) {
            if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $objPHPExcel->getActiveSheet()->setCellValue($index1, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $objPHPExcel->getActiveSheet()->setCellValue($index2, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $objPHPExcel->getActiveSheet()->setCellValue($index3, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "5") {
              $objPHPExcel->getActiveSheet()->setCellValue($index4, $resultCountScoreInQuestionSet["countvalue"]);
            }
          }
          $rowCount++;
        } else {
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, $reverseStartDateTime2);
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index1 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index2 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index3 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index4 = $for2Column . $rowCount;
          $for2Column++;
          $objPHPExcel->getActiveSheet()->setCellValue($for2Column . $rowCount, '0');
          $index5 = $for2Column . $rowCount;

          while ($resultCountScoreInQuestionSet = mysql_fetch_array($queryCountScoreInQuestionSet)) {
            if ($resultCountScoreInQuestionSet["score_value"] == "1") {
              $objPHPExcel->getActiveSheet()->setCellValue($index1, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "2") {
              $objPHPExcel->getActiveSheet()->setCellValue($index2, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "3") {
              $objPHPExcel->getActiveSheet()->setCellValue($index3, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "4") {
              $objPHPExcel->getActiveSheet()->setCellValue($index4, $resultCountScoreInQuestionSet["countvalue"]);
            } else if ($resultCountScoreInQuestionSet["score_value"] == "5") {
              $objPHPExcel->getActiveSheet()->setCellValue($index5, $resultCountScoreInQuestionSet["countvalue"]);
            }
          }
          $rowCount++;
        }
      }
    }

    $objPHPExcel->getActiveSheet()->setTitle('การประเมินความพึงพอใจ');

    if ($commentFlag == "1") {
      $objWorksheet = $objPHPExcel->createSheet(1);

      $rowCount = 1;
      $columnCount = 'A';

      $objWorksheet->getColumnDimension('A')->setWidth(30);
      $objWorksheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objWorksheet->getColumnDimension('B')->setWidth(30);
      $objWorksheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objWorksheet->getColumnDimension('C')->setWidth(50);
      $objWorksheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $objWorksheet->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
      $objWorksheet->setCellValue('B1', $questionsetname);
      $rowCount = $rowCount + 1;

      $objWorksheet->setCellValue('A2', 'วัน-เดือน-ปี');
      $objWorksheet->setCellValue('B2', 'ลำดับ');
      $objWorksheet->setCellValue('C2', 'ข้อเสนอแนะเพิ่มเติม');
      $rowCount = $rowCount + 1;
      $indexComment = 1;

      for ($start3 = $startInSecond; $start3 <= $endInSecond; $start3 += 86400) {
        $end3 = $start3 + 86400;
        $startDateTime3 = date("Y-m-d", $start3);
        $endDateTime3 = date("Y-m-d", $end3);

        $reverseStartDateTime3 = date("d-m-Y", $start3);
        $reverseEndDateTime3 = date("d-m-Y", $end3);

        $sqlGetComment = "SELECT * FROM comment WHERE comment_question_set_id = '$questionsetid' AND comment_datetime >= '$startDateTime3' AND comment_datetime <= '$endDateTime3'
                          ORDER BY comment_datetime";
        $queryGetComment = mysql_query($sqlGetComment);
        $countRowGetComment = mysql_num_rows($queryGetComment);

        $commentColumnCount = $columnCount;

        if ($countRowGetComment != 0) {
          $objWorksheet->setCellValue('A' . $rowCount, $reverseStartDateTime3);
        }

        while ($resultGetComment = mysql_fetch_array($queryGetComment)) {
          $commentColumnCount = $columnCount;
          $commentColumnCount++;
          $objWorksheet->setCellValue($commentColumnCount . $rowCount, $indexComment);
          $commentColumnCount++;
          $objWorksheet->setCellValue($commentColumnCount . $rowCount, $resultGetComment["comment_detail"]);
          $rowCount++;
          $indexComment++;
        }
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
      $sqlCountAlertAge = "SELECT count(info_age) AS countage, info_age FROM info WHERE info_question_set_id = '$questionsetid'
                          AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_age ORDER BY info_age ASC";
      $queryCountAlertAge = mysql_query($sqlCountAlertAge);
      $countRowCountAlertAge = mysql_num_rows($queryCountAlertAge);
      if ($countRowCountAlertAge == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    if ($resultGetInfoFlag["bi_sex"] == "1") {
      $sqlCountAlertSex = "SELECT count(info_sex) AS countsex, info_sex FROM info WHERE info_question_set_id = '$questionsetid'
                          AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_sex ORDER BY info_sex DESC";
      $queryCountAlertSex = mysql_query($sqlCountAlertSex);
      $countRowCountAlertSex = mysql_num_rows($queryCountAlertSex);
      if ($countRowCountAlertSex == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    if ($resultGetInfoFlag["bi_education"] == "1") {
      $sqlCountAlertEducation = "SELECT count(info_education) AS counteducation, info_education FROM info WHERE info_question_set_id = '$questionsetid'
                                AND info_datetime >= '$startdatetime' AND info_datetime <= '$enddatetime' GROUP BY info_education";
      $queryCountAlertEducation = mysql_query($sqlCountAlertEducation);
      $countRowCountAlertEducation = mysql_num_rows($queryCountAlertEducation);
      if ($countRowCountAlertEducation == 0) {
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }

    if ($resultGetInfoFlag["bi_salary"] == "1") {
      $sqlCountAlertSalary = "SELECT count(info_income) AS countincome, info_income FROM info WHERE info_question_set_id = '$questionsetid' AND info_datetime >= '$startdatetime'
                              AND info_datetime <= '$enddatetime' GROUP BY info_income";
      $queryCountAlertSalary = mysql_query($sqlCountAlertSalary);
      $countRowCountAlertSalary = mysql_num_rows($queryCountAlertSalary);
      if ($countRowCountAlertSalary == 0) {
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
    $rowCount++;

    if ($resultGetInfoFlag["bi_age"] == "1") {
      $ageColumn = $columnCount;
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'อายุ');
      $rowCount++;

      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, 'วัน-เดือน-ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '10-15 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '16-20 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '21-25 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '26-30 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '31-35 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '36-40 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '41-45 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '46-50 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '51-55 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '56-60 ปี');
      $ageColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($ageColumn . $rowCount, '61 ปีขึ้นไป');
      $ageColumn++;
      $rowCount++;

      for ($startAge = $startInSecond; $startAge <= $endInSecond; $startAge += 86400) {
        $endAge = $startAge + 86400;
        $startAgeDateTime = date("Y-m-d", $startAge);
        $endAgeDateTime = date("Y-m-d", $endAge);

        $reverseStartAgeDateTime = date("d-m-Y", $startAge);
        $reverseEndAgeDateTime = date("d-m-Y", $endAge);

        $sqlCountAge = "SELECT count(info_age) AS countage, info_age, DATE(info_datetime) AS day FROM info WHERE info_question_set_id = '$questionsetid'
                        AND info_datetime >= '$startAgeDateTime' AND info_datetime <= '$endAgeDateTime' GROUP BY info_age, DATE(info_datetime) ORDER BY DATE(info_datetime) ASC, info_age";
        $queryCountAge = mysql_query($sqlCountAge);
        $countCountAge = mysql_num_rows($queryCountAge);

        $forAgeColumn = $columnCount;

        if ($countCountAge != 0) {
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, $reverseStartAgeDateTime);
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex1 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex2 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex3 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex4 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex5 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex6 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex7 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex8 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex9 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex10 = $forAgeColumn . $rowCount;
          $forAgeColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forAgeColumn . $rowCount, '0');
          $ageIndex11 = $forAgeColumn . $rowCount;
          $rowCount++;

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
        }
      }
    }

    if ($resultGetInfoFlag["bi_sex"] == "1") {
      $sexColumn = $columnCount;
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'เพศ');
      $rowCount++;

      $objPHPExcel->getActiveSheet()->setCellValue($sexColumn . $rowCount, 'วัน-เดือน-ปี');
      $sexColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($sexColumn . $rowCount, 'ผู้ชาย');
      $sexColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($sexColumn . $rowCount, 'ผู้หญิง');
      $sexColumn++;
      $rowCount++;

      for ($startSex = $startInSecond; $startSex <= $endInSecond; $startSex += 86400) {
        $endSex = $startSex + 86400;
        $startSexDateTime = date("Y-m-d", $startSex);
        $endSexDateTime = date("Y-m-d", $endSex);

        $reverseStartSexDateTime = date("d-m-Y", $startSex);
        $reverseEndSexDateTime = date("d-m-Y", $endSex);

        $sqlCountSex = "SELECT count(info_sex) AS countsex, info_sex, DATE(info_datetime) AS day FROM info WHERE info_question_set_id = '$questionsetid'
                        AND info_datetime >= '$startSexDateTime' AND info_datetime <= '$endSexDateTime' GROUP BY info_sex, DATE(info_datetime) ORDER BY DATE(info_datetime) ASC, info_sex";
        $queryCountSex = mysql_query($sqlCountSex);
        $countRowCountSex = mysql_num_rows($queryCountSex);

        $forSexColumn = $columnCount;

        if ($countRowCountSex != 0) {
          $objPHPExcel->getActiveSheet()->setCellValue($forSexColumn . $rowCount, $reverseStartSexDateTime);
          $forSexColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSexColumn . $rowCount, '0');
          $sexIndex1 = $forSexColumn . $rowCount;
          $forSexColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSexColumn . $rowCount, '0');
          $sexIndex2 = $forSexColumn . $rowCount;
          $rowCount++;

          while ($resultCountSex = mysql_fetch_array($queryCountSex)) {
            if ($resultCountSex["info_sex"] == "Male") {
              $objPHPExcel->getActiveSheet()->setCellValue($sexIndex1 , $resultCountSex["countsex"]);
            } else if ($resultCountSex["info_sex"] == "Female") {
              $objPHPExcel->getActiveSheet()->setCellValue($sexIndex2 , $resultCountSex["countsex"]);
            }
          }
        }
      }
    }

    if ($resultGetInfoFlag["bi_education"] == "1") {
      $educationColumn = $columnCount;
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'ระดับการศึกษา');
      $rowCount++;

      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'วัน-เดือน-ปี');
      $educationColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'ต่ำกว่ามัธยมศึกษา');
      $educationColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'มัธยมศึกษาหรือเทียบเท่า');
      $educationColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'อนุปริญญาหรือเทียบเท่า');
      $educationColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'ปริญญาตรี');
      $educationColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'ปริญญาโท');
      $educationColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($educationColumn . $rowCount, 'ปริญญาเอก');
      $educationColumn++;
      $rowCount++;

      for ($startEducation = $startInSecond; $startEducation <= $endInSecond; $startEducation += 86400) {
        $endEducation = $startEducation + 86400;
        $startEducationDateTime = date("Y-m-d", $startEducation);
        $endEducationDateTime = date("Y-m-d", $endEducation);

        $reverseStartEducationDateTime = date("d-m-Y", $startEducation);
        $reverseEndEducationDateTime = date("d-m-Y", $endEducation);

        $sqlCountEducation = "SELECT count(info_education) AS counteducation, info_education, DATE(info_datetime) AS day FROM info WHERE info_question_set_id = '$questionsetid'
                              AND info_datetime >= '$startEducationDateTime' AND info_datetime <= '$endEducationDateTime' GROUP BY info_education, DATE(info_datetime)
                              ORDER BY DATE(info_datetime) ASC, info_education";
        $queryCountEducation = mysql_query($sqlCountEducation);
        $countRowCountEducation = mysql_num_rows($queryCountEducation);

        $forEducationColumn = $columnCount;

        if ($countRowCountEducation != 0) {
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, $reverseStartEducationDateTime);
          $forEducationColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, '0');
          $educationIndex1 = $forEducationColumn . $rowCount;
          $forEducationColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, '0');
          $educationIndex2 = $forEducationColumn . $rowCount;
          $forEducationColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, '0');
          $educationIndex3 = $forEducationColumn . $rowCount;
          $forEducationColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, '0');
          $educationIndex4 = $forEducationColumn . $rowCount;
          $forEducationColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, '0');
          $educationIndex5 = $forEducationColumn . $rowCount;
          $forEducationColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forEducationColumn . $rowCount, '0');
          $educationIndex6 = $forEducationColumn . $rowCount;
          $rowCount++;

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
        }
      }
    }

    if ($resultGetInfoFlag["bi_salary"] == "1") {
      $salaryColumn = $columnCount;
      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'หัวข้อแบบสอบถามเบื้องต้น');
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, 'รายได้');
      $rowCount++;

      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, 'วัน-เดือน-ปี');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, 'ไม่มีรายได้');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, 'ต่ำกว่า 5,000 บาท/เดือน');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, '5,001 - 10,000 บาท/เดือน');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, '10,001 - 15,000 บาท/เดือน');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, '15,001 - 20,000 บาท/เดือน');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, '20,001 - 30,000 บาท/เดือน');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, '30,001 - 40,000 บาท/เดือน');
      $salaryColumn++;
      $objPHPExcel->getActiveSheet()->setCellValue($salaryColumn . $rowCount, '40,001 บาท/เดือน ขึ้นไป');
      $rowCount++;

      for ($startSalary = $startInSecond; $startSalary <= $endInSecond; $startSalary += 86400) {
        $endSalary = $startSalary + 86400;
        $startSalaryDateTime = date("Y-m-d", $startSalary);
        $endSalaryDateTime = date("Y-m-d", $endSalary);

        $reverseStartSalaryDateTime = date("d-m-Y", $startSalary);
        $reverseEndSalaryDateTime = date("d-m-Y", $endSalary);

        $sqlCountSalary = "SELECT count(info_income) AS countincome, info_income, DATE(info_datetime) AS day FROM info WHERE info_question_set_id = '$questionsetid' AND info_datetime >= '$startSalaryDateTime'
                          AND info_datetime <= '$endSalaryDateTime' GROUP BY info_income, DATE(info_datetime) ORDER BY DATE(info_datetime) ASC, info_income";
        $queryCountSalary = mysql_query($sqlCountSalary);
        $countRowCountSalary = mysql_num_rows($queryCountSalary);

        $forSalaryColumn = $columnCount;

        if ($countRowCountSalary != 0) {
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, $reverseStartSalaryDateTime);
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex1 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex2 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex3 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex4 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex5 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex6 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex7 = $forSalaryColumn . $rowCount;
          $forSalaryColumn++;
          $objPHPExcel->getActiveSheet()->setCellValue($forSalaryColumn . $rowCount, '0');
          $salaryIndex8 = $forSalaryColumn . $rowCount;
          $rowCount++;

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
        }
      }
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
        $countGetBasicQuestionAns = mysql_num_rows($queryGetBasicQuestionAns);

        $whileBQAColumn = $columnCount;
        $objPHPExcel->getActiveSheet()->setCellValue($whileBQAColumn . $rowCount, 'วัน-เดือน-ปี');
        $whileBQAColumn++;

        $index = 0;

        while ($resultGetBasicQuestionAns = mysql_fetch_array($queryGetBasicQuestionAns)) {
          $objPHPExcel->getActiveSheet()->setCellValue($whileBQAColumn . $rowCount, $resultGetBasicQuestionAns["bqa_ans"]);
          ${"ansIndex" . $index} = $resultGetBasicQuestionAns["bqa_ans"];
          $index++;
          $whileBQAColumn++;
        }

        $rowCount++;

        for ($startBQA = $startInSecond; $startBQA <= $endInSecond; $startBQA += 86400) {
          $endBQA = $startBQA + 86400;
          $startBQADateTime = date("Y-m-d", $startBQA);
          $endBQADateTime = date("Y-m-d", $endBQA);

          $reverseStartBQADateTime = date("d-m-Y", $startBQA);
          $reverseEndBQADateTime = date("d-m-Y", $endBQA);

          $sqlGetCountAns = "SELECT count(a.ans_answer) AS countans, a.ans_answer AS ansValue, DATE(i.info_datetime) AS day FROM answer a, info i WHERE a.ans_bq_id = '$bqid'
                            AND i.info_datetime >= '$startBQADateTime' AND i.info_datetime <= '$endBQADateTime' AND a.ans_info_id = i.info_id GROUP BY a.ans_answer, DATE(i.info_datetime)
                            ORDER BY DATE(i.info_datetime), a.ans_bqa_id";
          $queryGetCountAns = mysql_query($sqlGetCountAns);
          $countGetCountAns = mysql_num_rows($queryGetCountAns);

          $forBQAColumn = $columnCount;

          if ($countGetCountAns != 0) {
            $objPHPExcel->getActiveSheet()->setCellValue($forBQAColumn . $rowCount, $reverseStartBQADateTime);
            $forBQAColumn++;
            $ifBQAColumn = $forBQAColumn;
            for ($i = 0; $i < $countGetBasicQuestionAns; $i++) {
              $objPHPExcel->getActiveSheet()->setCellValue($ifBQAColumn . $rowCount, '0');
              $ifBQAColumn++;
            }
            while ($resultGetCountAns = mysql_fetch_array($queryGetCountAns)) {
              $whileForColumn = $forBQAColumn;
              for ($i = 0; $i < $countGetBasicQuestionAns; $i++) {
                if (${"ansIndex" . $i} == $resultGetCountAns["ansValue"]) {
                  $objPHPExcel->getActiveSheet()->setCellValue($whileForColumn . $rowCount, $resultGetCountAns["countans"]);
                  $whileForColumn++;
                } else {
                  $whileForColumn++;
                }
              }
            }
            $rowCount++;
          }
        }
      }
    }

    $objPHPExcel->getActiveSheet()->setTitle('แบบสอบถามเบื้องต้น');

    if ($resultGetInfoFlag["bi_name"] == "1") {
      $objWorksheet = $objPHPExcel->createSheet(1);

      $rowCount = 1;
      $columnCount = 'A';

      $objWorksheet->getColumnDimension('A')->setWidth(30);
      $objWorksheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objWorksheet->getColumnDimension('B')->setWidth(30);
      $objWorksheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objWorksheet->getColumnDimension('C')->setWidth(50);
      $objWorksheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $objWorksheet->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
      $objWorksheet->setCellValue('B1', $questionsetname);
      $rowCount = $rowCount + 1;

      $objWorksheet->setCellValue('A2', 'วัน-เดือน-ปี');
      $objWorksheet->setCellValue('B2', 'ลำดับ');
      $objWorksheet->setCellValue('C2', 'รายชื่อผู้ตอบแบบสอบถามเบื้องต้น');
      $rowCount = $rowCount + 1;
      $indexName = 1;

      for ($startName = $startInSecond; $startName <= $endInSecond; $startName += 86400) {
        $endName = $startName + 86400;
        $startNameDateTime = date("Y-m-d", $startName);
        $endNameDateTime = date("Y-m-d", $endName);

        $reverseStartNameDateTime = date("d-m-Y", $startName);
        $reverseEndNameDateTime = date("d-m-Y", $endName);

        $sqlGetName = "SELECT * FROM info WHERE info_question_set_id = '$questionsetid' AND info_datetime >= '$startNameDateTime' AND info_datetime <= '$endNameDateTime'";
        $queryGetName = mysql_query($sqlGetName);
        $countGetName = mysql_num_rows($queryGetName);

        $nameColumnCount = $columnCount;

        if ($countGetName != 0) {
          $objWorksheet->setCellValue('A' . $rowCount, $reverseStartNameDateTime);
        }

        while ($resultGetName = mysql_fetch_array($queryGetName)) {
          $nameColumnCount = $columnCount;
          $nameColumnCount++;
          $objWorksheet->setCellValue($nameColumnCount . $rowCount, $indexName);
          $nameColumnCount++;
          $objWorksheet->setCellValue($nameColumnCount . $rowCount, $resultGetName["info_name"]);
          $rowCount++;
          $indexName++;
        }
      }

      $objWorksheet->setTitle('รายชื่อผู้ตอบแบบสอบถามเบื้องต้น');
    }

    $sqlGetBasicQuestion2 = "SELECT * FROM basicQuestion WHERE bq_question_set_id = '$questionsetid' ORDER BY bq_id";
    $queryGetBasicQuestion2 = mysql_query($sqlGetBasicQuestion2);

    while ($resultGetBasicQuestion2 = mysql_fetch_array($queryGetBasicQuestion2)) {
      if ($resultGetBasicQuestion2["bq_type"] == "1") {
        $objWorksheet = $objPHPExcel->createSheet(1);

        $rowCount = 1;
        $columnCount = 'A';

        $objWorksheet->getColumnDimension('A')->setWidth(30);
        $objWorksheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objWorksheet->getColumnDimension('B')->setWidth(30);
        $objWorksheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objWorksheet->getColumnDimension('C')->setWidth(50);
        $objWorksheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objWorksheet->setCellValue('A1', 'ชื่อชุดแบบประเมินความพึงพอใจ');
        $objWorksheet->setCellValue('B1', $questionsetname);
        $rowCount = $rowCount + 1;

        $objWorksheet->setCellValue('A2', 'คำถามเบื้องต้น');
        $objWorksheet->setCellValue('B2', $resultGetBasicQuestion2["bq_question"]);
        $rowCount = $rowCount + 1;

        $objWorksheet->setCellValue('A3', 'วัน-เดือน-ปี');
        $objWorksheet->setCellValue('B3', 'ลำดับ');
        $objWorksheet->setCellValue('C3', 'รายชื่อผู้ตอบแบบสอบถามเบื้องต้น');
        $rowCount = $rowCount + 1;
        $indexQS = 1;

        for ($startQS = $startInSecond; $startQS <= $endInSecond; $startQS += 86400) {
          $endQS = $startQS + 86400;
          $startQSDateTime = date("Y-m-d", $startQS);
          $endQSDateTime = date("Y-m-d", $endQS);

          $reverseStartQSDateTime = date("d-m-Y", $startQS);
          $reverseEndQSDateTime = date("d-m-Y", $endQS);

          $bqid = $resultGetBasicQuestion2["bq_id"];
          $sqlCount= "SELECT * FROM answer a, info i WHERE a.ans_bq_id = '$bqid' AND i.info_datetime >= '$startQSDateTime' AND i.info_datetime <= '$endQSDateTime'
                      AND a.ans_info_id = i.info_id  ORDER BY i.info_datetime";
          $queryCount = mysql_query($sqlCount);
          $countRowCount = mysql_num_rows($queryCount);

          $qsColumnCount = $columnCount;

          if ($countRowCount != 0) {
            $objWorksheet->setCellValue('A' . $rowCount, $reverseStartQSDateTime);
          }

          while ($resultCount = mysql_fetch_array($queryCount)) {
            $qsColumnCount = $columnCount;
            $qsColumnCount++;
            $objWorksheet->setCellValue($qsColumnCount . $rowCount, $indexQS);
            $qsColumnCount++;
            $objWorksheet->setCellValue($qsColumnCount . $rowCount, $resultCount["ans_answer"]);
            $rowCount++;
            $indexQS++;
          }
        }
        $objWorksheet->setTitle($resultGetBasicQuestion2["bq_question"]);
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

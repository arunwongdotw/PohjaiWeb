<?php
  include "../dbphp/connect.php";

  // header("Content-Type: application/vnd.ms-excel"); // ประเภทของไฟล์
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename="myexcel.xls"'); //กำหนดชื่อไฟล์
  header("Content-Type: application/force-download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
  // header("Content-Type: application/octet-stream");
  // header("Content-Type: application/download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
  // header("Content-Transfer-Encoding: binary");
  // header("Content-Length: ".filesize("myexcel.xls"));

  // @readfile($filename);

  $questionsetid = $_REQUEST["questionsetid"];
  $chartdata = $_REQUEST["chartdata"];
  $startdatetime = $_REQUEST["startdatetime"];
  $enddatetime = $_REQUEST["enddatetime"];

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
    $sqlGetComment = "SELECT * FROM comment WHERE comment_question_set_id = '$questionsetid'";
    $queryGetComment = mysql_query($sqlGetComment);
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
      if ($countRowAge == 0) {
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
        echo "<script type='text/javascript'>alert('ไม่พบข้อมูลในช่วงระยะวันเวลาที่ท่านกำหนด');</script>";
        ?><script>window.location="../pages/member.php";</script><?php
      }
    }
  }
  // $sqlCountScoreInQuestionSet = "SELECT count(score_value) as countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '$questionsetid'
  //                               AND s.score_datetime >= '$startdatetime' AND s.score_datetime <= '$enddatetime' AND s.score_question_id = q.question_id
  //                               AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";


?>
<html lang="" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
  <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
  <head>
    <title>Pohjai : แอปพลิเคชันพอใจ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <?php if ($chartdata == "1") { ?>
    <table>
      <tr>
        <th>สรุปผลประเมินความพึงพอใจ</th>
      </tr>
      <tr>
        <th>แบบประเมิน</th>
        <th><?php echo $questionsetname; ?></th>
      </tr>
      <?php while($resultGetQuestionInQuestionSet = mysql_fetch_array($queryGetQuestionInQuestionSet)) { ?>
      <tr>
        <th>หัวข้อ</th>
        <th><?php echo $resultGetQuestionInQuestionSet["question_name"]; ?></th>
      </tr>
      <?php if ($noBtn == "2") { ?>
      <tr>
        <th>แย่มาก</th>
        <th>แย่</th>
        <th>พอใช้</th>
        <th>ดี</th>
        <th>ดีมาก</th>
      </tr>
      <?php } else { ?>
      <tr>
        <th>ควรปรับปรุง</th>
        <th>พอใช้</th>
        <th>ดี</th>
        <th>ดีมาก</th>
      </tr>
      <?php } ?>
      <?php
        $questionid = $resultGetQuestionInQuestionSet["question_id"];
        $sqlCountScore = "SELECT count(score_value) as countvalue, s.score_value FROM score s WHERE score_question_id = '$questionid' AND score_datetime >= '$startdatetime'
                          AND score_datetime <= '$enddatetime' GROUP BY score_value ORDER BY score_value";
        $queryCountScore = mysql_query($sqlCountScore);
      ?>
      <tr>
        <?php while($resultCountScore = mysql_fetch_array($queryCountScore)) { ?>
        <td align="center"><?php echo $resultCountScore["countvalue"]; ?></td>
        <?php } ?>
      </tr>
      <?php } ?>
    </table>
    <table>
      <tr>
        <th>สรุปผลทั้งหมด</th>
      </tr>
      <?php if ($noBtn == "2") { ?>
      <tr>
        <th>แย่มาก</th>
        <th>แย่</th>
        <th>พอใช้</th>
        <th>ดี</th>
        <th>ดีมาก</th>
      </tr>
      <?php } else { ?>
      <tr>
        <th>ควรปรับปรุง</th>
        <th>พอใช้</th>
        <th>ดี</th>
        <th>ดีมาก</th>
      </tr>
      <?php }?>
      <tr>
        <?php while($resultCountScoreInQuestionSet = mysql_fetch_array($queryCountScoreInQuestionSet)) { ?>
        <td align="center"><?php echo $resultCountScoreInQuestionSet["countvalue"]; ?></td>
        <?php } ?>
      </tr>
    </table>
    <table>
      <tr>
        <th>ข้อเสนอแนะทั้งหมด</th>
      </tr>
      <tr>
        <th>ลำดับ</th>
        <th>ข้อเสนอแนะ</th>
      </tr>
      <?php $i = 1; ?>
      <?php while($resultGetComment = mysql_fetch_array($queryGetComment)) { ?>
      <tr>
        <td align="center"><?php echo $i; ?></td>
        <td align="center"><?php echo $resultGetComment["comment_detail"]; ?></td>
      </tr>
      <?php $i = $i + 1; ?>
      <?php } ?>
    </table>
    <?php } else { ?>
    <table>
      <tr>
        <th>สรุปแบบสอบถามเบื้องต้น</th>
      </tr>
      <tr>
        <th>แบบประเมิน</th>
        <th><?php echo $questionsetname; ?></th>
      </tr>
      <?php if ($resultGetInfoFlag["bi_age"] == "1") { ?>
      <tr>
        <th>หัวข้อ</th>
        <th>อายุ</th>
      </tr>
      <tr>
        <th>10-15 ปี</th>
        <th>16-20 ปี</th>
        <th>21-25 ปี</th>
        <th>26-30 ปี</th>
        <th>31-35 ปี</th>
        <th>36-40 ปี</th>
        <th>41-45 ปี</th>
        <th>46-50 ปี</th>
        <th>51-55 ปี</th>
        <th>56-60 ปี</th>
        <th>61 ปีขึ้นไป</th>
      </tr>
      <tr>
      <?php while($resultCountAge = mysql_fetch_array($queryCountAge)) { ?>
      <?php if ($resultCountAge["info_age"] == "10-15") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "16-20") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "21-25") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "26-30") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "31-35") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "36-40") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "41-45") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "46-50") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "51-55") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "56-60") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else if ($resultCountAge["info_age"] == "61+") { ?>
        <td align="center"><?php echo $resultCountAge["countage"]; ?></td>
      <?php } else { ?>
        <td align="center"></td>
      <?php } ?>
      <?php } ?>
      </tr>
    <?php } ?>

    <?php if ($resultGetInfoFlag["bi_sex"] == "1") { ?>
    <tr>
      <th>หัวข้อ</th>
      <th>เพศ</th>
    </tr>
    <tr>
      <th>ชาย</th>
      <th>หญิง</th>
    </tr>
    <tr>
    <?php while($resultCountSex = mysql_fetch_array($queryCountSex)) { ?>
    <?php if ($resultCountSex["info_sex"] == "Male") { ?>
      <td align="center"><?php echo $resultCountSex["countsex"]; ?></td>
    <?php } else if ($resultCountSex["info_sex"] == "Female") { ?>
      <td align="center"><?php echo $resultCountSex["countsex"]; ?></td>
    <?php } else { ?>
      <td align="center"></td>
    <?php } ?>
    <?php } ?>
    </tr>
    <?php } ?>

    <?php if ($resultGetInfoFlag["bi_education"] == "1") { ?>
    <tr>
      <th>หัวข้อ</th>
      <th>ระดับการศึกษา</th>
    </tr>
    <tr>
      <th>ต่ำกว่ามัธยมศึกษา</th>
      <th>มัธยมศึกษาหรือเทียบเท่า</th>
      <th>อนุปริญญาหรือเทียบเท่า</th>
      <th>ปริญญาตรี</th>
      <th>ปริญญาโท</th>
      <th>ปริญญาเอก</th>
    </tr>
    <tr>
    <?php while($resultCountEducation = mysql_fetch_array($queryCountEducation)) { ?>
    <?php if ($resultCountEducation["info_education"] == "Lower Secondary School") { ?>
      <td align="center"><?php echo $resultCountEducation["counteducation"]; ?></td>
    <?php } else if ($resultCountEducation["info_education"] == "Secondary School") { ?>
      <td align="center"><?php echo $resultCountEducation["counteducation"]; ?></td>
    <?php } else if ($resultCountEducation["info_education"] == "Diploma") { ?>
      <td align="center"><?php echo $resultCountEducation["counteducation"]; ?></td>
    <?php } else if ($resultCountEducation["info_education"] == "Bachelor Degree") { ?>
      <td align="center"><?php echo $resultCountEducation["counteducation"]; ?></td>
    <?php } else if ($resultCountEducation["info_education"] == "Master Degree") { ?>
      <td align="center"><?php echo $resultCountEducation["counteducation"]; ?></td>
    <?php } else if ($resultCountEducation["info_education"] == "Doctor Degree") { ?>
      <td align="center"><?php echo $resultCountEducation["counteducation"]; ?></td>
    <?php } else { ?>
      <td align="center"></td>
    <?php } ?>
    <?php } ?>
    </tr>
    <?php } ?>

    <?php if ($resultGetInfoFlag["bi_salary"] == "1") { ?>
    <tr>
      <th>หัวข้อ</th>
      <th>เงินเดือน</th>
    </tr>
    <tr>
      <th>ไม่มีรายได้</th>
      <th>ต่ำกว่า 5,000 บาท/เดือน</th>
      <th>5,001 - 10,000 บาท/เดือน</th>
      <th>10,001 - 15,000 บาท/เดือน</th>
      <th>15,001 - 20,000 บาท/เดือน</th>
      <th>20,001 - 30,000 บาท/เดือน</th>
      <th>30,001 - 40,000 บาท/เดือน</th>
      <th>40,001 บาท/เดือน ขึ้นไป</th>
    </tr>
    <tr>
    <?php while($resultCountSalary = mysql_fetch_array($queryCountSalary)) { ?>
    <?php if ($resultCountSalary["info_income"] == "0") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "Less than 5,000") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "5,001 - 10,000") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "10,001 - 15,000") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "15,001 - 20,000") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "20,001 - 30,000") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "30,001 - 40,000") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else if ($resultCountSalary["info_income"] == "More than 40,001") { ?>
      <td align="center"><?php echo $resultCountSalary["countincome"]; ?></td>
    <?php } else { ?>
      <td align="center"></td>
    <?php } ?>
    <?php } ?>
    </tr>
    <?php } ?>

    </table>
    <?php } ?>
  </body>
</html>

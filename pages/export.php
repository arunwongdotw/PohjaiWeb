<?php
include "../dbphp/connect.php";
header("Content-Type: application/vnd.ms-excel"); // ประเภทของไฟล์
header('Content-Disposition: attachment; filename="myexcel.xls'); //กำหนดชื่อไฟล์
header("Content-Type: application/force-download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
header("Content-Type: application/octet-stream");
header("Content-Type: application/download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize("myexcel.xls"));

@readfile($filename);
// $sqlCountScoreInQuestionSet = "SELECT count(score_value) as countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '$questionsetid'
//                               AND s.score_datetime >= '$startdatetime' AND s.score_datetime <= '$enddatetime' AND s.score_question_id = q.question_id
//                               AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";

$sqlCountScoreInQuestionSet = "SELECT count(score_value) as countvalue, s.score_value FROM score s, question q, questionSet qs WHERE qs.question_set_id = '6'
                              AND s.score_datetime >= '2018-01-01' AND s.score_datetime <= '2018-08-16' AND s.score_question_id = q.question_id
                              AND q.question_question_set_id = qs.question_set_id GROUP BY s.score_value";
$queryCountScoreInQuestionSet = mysql_query($sqlCountScoreInQuestionSet);

?>
<html lang="" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
  <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
  <head>
    <title>Pohjai : แอปพลิเคชันพอใจ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <table border="1">
      <tr>
        <th>แย่มาก</th>
        <th>แย่</th>
        <th>ควรปรับปรุง</th>
        <th>ดี</th>
        <th>ดีมาก</th>
      </tr>
      <tr>
      <?php while($resultCountScoreInQuestionSet = mysql_fetch_array($queryCountScoreInQuestionSet)) { ?>
        <td align="center"><?php echo $resultCountScoreInQuestionSet["countvalue"]; ?></td>
      <?php } ?>
      </tr>
    </table>
  </body>
</html>

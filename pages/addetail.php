<?php
  session_start();
  include "../dbphp/connect.php";
  if ($_SESSION["type"] != "ad") {
    ?><script>window.location="../pages/adlogin.php";</script><?php
  } else {
    $ref = $_SESSION["ma_username"];
    $sqlGetRef1 = "SELECT * FROM memberAd WHERE ma_ref = '$ref' ORDER BY ma_id";
    $queryGetRef1 = mysql_query($sqlGetRef1);
    $sqlGetRef2 = "SELECT * FROM memberAd WHERE ma_ref IN (SELECT ma_username FROM memberAd WHERE ma_ref = '$ref')";
    $queryGetRef2 = mysql_query($sqlGetRef2);
  }
  if ($_REQUEST["action"] == "logout") {
    session_destroy();
    echo "<script type='text/javascript'>alert('Log Out สำเร็จ');</script>";
    ?><script>window.location="../pages/sale.php";</script><?php
  }
?>
<html lang="">
  <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
  <head>
    <title>Pohjai : แอปพลิเคชันพอใจ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
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
            <?php if ($_SESSION["type"] != "ad") { ?>
            <li><i class="fas fa-user rgtspace-5"> ยินดีต้อนรับ <?php echo $_SESSION["ma_username"]; ?></i>
            <li><i class="fas fa-sign-out-alt rgtspace-5"></i><a href="addetail.php?action=logout"> Log Out</a></li>
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
    <div class="wrapper row3">
      <section class="hoc container clear">
        <div class="sectiontitle">
          <h6 class="heading">ลิ้งแนะนำการขายโฆษณา</h6>
        </div>
        <center>
          <input type="text" class="form-control" value="http://www.pohjai.com/pages/register.php?ref=<?php echo $_SESSION["ma_username"]; ?>" id="link" style="display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 600px;"><br>
          <button class="btn" onclick="copy()" style="margin-top: 20;">คัดลอกลิ้งแนะนำ</button>
        </center>
        <div class="sectiontitle" style="margin-top: 70px;">
          <h6 class="heading">รายการผู้ขายโฆษณาระดับที่ 1</h6>
        </div>
        <table>
          <thead>
            <tr>
              <th>ชื่อผู้ใช้</th>
              <th>ชื่อ-นามสกุล</th>
              <th>อำเภอ</th>
              <th>จังหวัด</th>
              <th>เบอร์โทรศัพท์</th>
              <th>อีเมล</th>
              <th>อ้างอิง</th>
              <th>จำนวนที่ขาย</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($resultGetRef1 = mysql_fetch_array($queryGetRef1)) { ?>
            <tr>
              <td><?php echo $resultGetRef1["ma_username"]; ?></td>
              <td><?php echo $resultGetRef1["ma_firstname"] . " " . $resultGetRef1["ma_lastname"]; ?></td>
              <td><?php echo $resultGetRef1["ma_amphur"]; ?></td>
              <td><?php echo $resultGetRef1["ma_province"]; ?></td>
              <td><?php echo $resultGetRef1["ma_mobile"]; ?></td>
              <td><?php echo $resultGetRef1["ma_email"]; ?></td>
              <td><?php echo $resultGetRef1["ma_ref"]; ?></td>
              <td><?php echo $resultGetRef1["ma_salefreq"]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="sectiontitle" style="margin-top: 50px;">
          <h6 class="heading">รายการผู้ขายโฆษณาระดับที่ 2</h6>
        </div>
        <table>
          <thead>
            <tr>
              <th>ชื่อผู้ใช้</th>
              <th>ชื่อ-นามสกุล</th>
              <th>อำเภอ</th>
              <th>จังหวัด</th>
              <th>อ้างอิง</th>
              <th>จำนวนที่ขาย</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($resultGetRef2 = mysql_fetch_array($queryGetRef2)) { ?>
            <tr>
              <td><?php echo $resultGetRef2["ma_username"]; ?></td>
              <td><?php echo $resultGetRef2["ma_firstname"] . " " . $resultGetRef2["ma_lastname"]; ?></td>
              <td><?php echo $resultGetRef2["ma_amphur"]; ?></td>
              <td><?php echo $resultGetRef2["ma_province"]; ?></td>
              <td><?php echo $resultGetRef2["ma_ref"]; ?></td>
              <td><?php echo $resultGetRef2["ma_salefreq"]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
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

    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
    <script type="text/javascript">
      function copy() {
        var copyText = document.getElementById("link");
        copyText.select();
        document.execCommand("copy");
        // alert("Copied the text: " + copyText.value);
      }
    </script>
  </body>
</html>

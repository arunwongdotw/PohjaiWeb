<?php
  session_start();
  include "../dbphp/connect.php";
  if ($_REQUEST["action"] == "search") {
    $name = $_REQUEST["ownername"];
    $contact = $_REQUEST["ownercontact"];
    $mobile = $_REQUEST["omobile"];
    $sqlSelect = "SELECT * FROM owner WHERE owner_name LIKE '%$name%' AND owner_contact LIKE '%$contact%' AND owner_phone_number LIKE '%$mobile%'";
    $querySelect = mysql_query($sqlSelect);
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
            <li><i class="fas fa-phone rgtspace-5"></i> 080-9907722</li>
            <li><i class="fas fa-envelope rgtspace-5"></i> info@pohjai.com</li>
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
        <div class="sectiontitle" style="margin-top: 50px;">
          <h6 class="heading">ค้นหาร้านโฆษณา</h6>
        </div>
        <form method="post" action="seeshoplist.php?action=search">
          <div style="margin-left: 50px;">
            <div class="one_third first">
              ชื่อร้านโฆษณา : <input type="text" class="form-control" name="ownername" style="display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px;"><br>
            </div>
            <div class="one_third">
              ชื่อผู้ติดต่อ : <input type="text" class="form-control" name="ownercontact" style="display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px;"><br>
            </div>
            <div class="one_third">
              เบอร์โทรศัพท์ : <input type="text" class="form-control" name="ownermobile" style="display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px;"><br>
            </div>
          </div>
          <center>
            <input class="btn" type="submit" value="ค้นหา" style="margin-top: 50px;">
          </center>
        </form>
        <?php if ($_REQUEST["action"] == "search") {?>
          <table style="margin-top: 50px;">
            <thead>
              <tr>
                <th>ชื่อร้าน</th>
                <th>ชื่อผู้ติดต่อ</th>
                <th>จังหวัด</th>
                <th>เบอร์โทรศัพท์</th>
                <th>ชื่อผู้ขาย</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($resultSelect = mysql_fetch_array($querySelect)) { ?>
              <tr>
                <td><?php echo $resultSelect["owner_name"]; ?></td>
                <td><?php echo $resultSelect["owner_contact"]; ?></td>
                <td><?php echo $resultSelect["owner_province"]; ?></td>
                <td><?php echo $resultSelect["owner_phone_number"]; ?></td>
                <?php
                $maid = $resultSelect["owner_ma_id"];
                $sqlGetName = "SELECT * FROM memberAd WHERE ma_id = '$maid'";
                $queryGetName = mysql_query($sqlGetName);
                $resultGetName = mysql_fetch_array($queryGetName);
                $firstname = $resultGetName["ma_firstname"];
                ?>
                <td><?php echo $firstname; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
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

    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  </body>
</html>

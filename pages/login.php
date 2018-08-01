<?php
  session_start();
  include "../connect.php";
  if ($_SESSION) {
    ?><script>window.location="../pages/member.php";</script><?php
  }
  if ($_REQUEST["action"] == "login") {
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $sqlCheckUsername = "SELECT * FROM member WHERE member_username = '$username'";
    $queryCheckUsername = mysql_query($sqlCheckUsername);
    if ($resultCheckUsername = mysql_fetch_array($queryCheckUsername)) {
      $sqlCheckPassword = "SELECT * FROM member WHERE member_username = '$username' AND member_password = '$password'";
      $queryCheckPassword = mysql_query($sqlCheckPassword);
      if ($resultCheckPassword = mysql_fetch_array($queryCheckPassword)) {
        $_SESSION = $resultCheckPassword;
        ?><script>window.location="../pages/member.php";</script><?php
      } else {
        echo "<script type='text/javascript'>alert('Password ไม่ถูกต้อง');</script>";
      }
    } else {
      echo "<script type='text/javascript'>alert('ไม่พบ Username นี้ในระบบ');</script>";
    }
  }
  if ($_REQUEST["action"] == "logout") {
    session_destroy();
    echo "<script type='text/javascript'>alert('Log Out สำเร็จ');</script>";
    ?><script>window.location="../index.html";</script><?php
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
            <?php if ($_SESSION) { ?>
            <li><i class="fas fa-user rgtspace-5"> ยินดีต้อนรับ <?php echo $_SESSION["member_username"]; ?></i>
            <li><i class="fas fa-sign-out-alt rgtspace-5"></i><a href="login.php?action=logout"> Log Out</a></li>
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
          <h6 class="heading">เข้าสู่ระบบ</h6>
        </div>
        <center>
          <form method="post" action="login.php?action=login">
            Username : <input type="text" class="form-control" name="username" required><br>
            Password : <input type="password" class="form-control" name="password" required><br>
            <input class="btn" type="submit" value="ตกลง">
          </form>
        </center>
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
        <!-- <div class="one_third">
          <h6 class="heading">Massa hendrerit bibendum</h6>
          <ul class="nospace linklist">
            <li><a href="#">Tincidunt vel vulputate egestas</a></li>
            <li><a href="#">Leo sed porttitor accumsan arcu</a></li>
            <li><a href="#">Aenean ac urna et leo posuere</a></li>
            <li><a href="#">Pretium suspendisse ac elit ut</a></li>
          </ul>
        </div>
        <div class="one_third">
          <h6 class="heading">Etiam auctor dignissim</h6>
          <p class="nospace btmspace-15">Leo integer sem nisl mollis ut ornare eu lobortis eget ante mauris tempor.</p>
          <form method="post" action="#">
            <fieldset>
              <legend>Newsletter:</legend>
              <input class="btmspace-15" type="text" value="" placeholder="Name">
              <input class="btmspace-15" type="text" value="" placeholder="Email">
              <button type="submit" value="submit">Submit</button>
            </fieldset>
          </form>
        </div> -->
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

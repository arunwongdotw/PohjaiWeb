<?php
  session_start();
  include "../connect.php";
  if ($_REQUEST["ref"]) {
    $ref = $_REQUEST["ref"];
  }
  if ($_REQUEST["action"] == "register") {
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $firstname = $_REQUEST["firstname"];
    $lastname = $_REQUEST["lastname"];
    $province = $_REQUEST["province"];
    $amphur = $_REQUEST["amphur"];
    $mobile = $_REQUEST["mobile"];
    $email = $_REQUEST["email"];
    $ref = $_REQUEST["ref"];
    $datetime = date('Y-m-d H:i:s');
    if ($ref) {
      $sqlInsert = "INSERT INTO memberAd VALUES ('', '$username', '$password', '$firstname', '$lastname', '$province', '$amphur', '$mobile', '$email', '$ref', '0', '$datetime')";
    } else {
      $sqlInsert = "INSERT INTO memberAd VALUES ('', '$username', '$password', '$firstname', '$lastname', '$province', '$amphur', '$mobile', '$email', '-', '0', '$datetime')";
    }
    if (mysql_query($sqlInsert)) {
      echo "<script type='text/javascript'>alert('ลงทะเบียนผู้ขายโฆษณาสำเร็จ');</script>";
      ?><script>window.location="sale.php";</script><?php
    } else {
      echo "<script type='text/javascript'>alert('ลงทะเบียนผู้ขายโฆษณาไม่สำเร็จ');</script>";
      ?><script>window.location="register.php";</script><?php
    }
  }
  $sqlGetProvince = "SELECT * FROM province ORDER BY PROVINCE_ID";
  $queryGetProvince = mysql_query($sqlGetProvince);
  $sqlGetAmphur = "SELECT * FROM amphur WHERE PROVINCE_ID = '1' ORDER BY AMPHUR_CODE";
  $queryGetAmphur = mysql_query($sqlGetAmphur);
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
        <div class="sectiontitle">
          <h6 class="heading">ลงทะเบียนผู้ขายโฆษณาแอปพลิเคชันพอใจ</h6>
        </div>
        <form method="post" action="register.php?action=register&ref=<?php echo $ref; ?>">
          <div style="margin-left: 50px;">
            <div class="one_half first">
              ชื่อผู้ใช้ (Username) :
              <input type="text" name="username" id="username" style="display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" minlength=6 maxlength=12 required>
              &nbsp;&nbsp;<i id="user-result"></i>
            </div>
            <div class="one_half">
              รหัสผ่าน (Password) :
              <input type="password" name="password" id="password" style="display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" minlength=6 maxlength=12 required>
              &nbsp;&nbsp;<i id="pass-result"></i>
            </div>
            <div class="one_half first" style="margin-top: 20px;">
              ยืนยันรหัสผ่าน :
              <input type="password" name="cfmpassword" id="cfmpassword" style="margin-left: 48px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" required>
              &nbsp;&nbsp;<i id="cfmpass-result"></i>
            </div>
            <div class="one_half" style="margin-top: 20px;">
              ชื่อจริง :
              <input type="text" name="firstname" style="margin-left: 94px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" required>
            </div>
            <div class="one_half first" style="margin-top: 20px;">
              นามสกุล :
              <input type="text" name="lastname" style="margin-left: 81px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" required>
            </div>
            <div class="one_half" style="margin-top: 20px;">
              จังหวัด :
              <select name="province" id="province" style="margin-left: 92px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;">
                <?php while ($resultGetProvince = mysql_fetch_array($queryGetProvince)) { ?>
                <option value="<?php echo $resultGetProvince["PROVINCE_NAME"]; ?>"><?php echo $resultGetProvince["PROVINCE_NAME"]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="one_half first" style="margin-top: 20px;">
              อำเภอ :
              <select name="amphur" id="amphur" style="margin-left: 93px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;">
                <?php while ($resultGetAmphur = mysql_fetch_array($queryGetAmphur)) { ?>
                <option value="<?php echo $resultGetAmphur["AMPHUR_NAME"]; ?>"><?php echo $resultGetAmphur["AMPHUR_NAME"]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="one_half" style="margin-top: 20px;">
              เบอร์โทรศัพท์ :
              <input type="text" name="mobile" style="margin-left: 53px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" required>
            </div>
            <div class="one_half first" style="margin-top: 20px;">
              อีเมล :
              <input type="text" name="email" style="margin-left: 100px; display: inline; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; padding: 12px 20px; width: 170px;" required>
            </div>
          </div>
          <input class="btn" type="submit" style="margin-top: 150px;" value="ตกลง">
        </form>
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
      $(function() {
        $("#username").keypress(function(event) {
          var ew = event.which;
          if (ew == 32)
            return true;
          if (48 <= ew && ew <= 57)
            return true;
          if (65 <= ew && ew <= 90)
            return true;
          if (97 <= ew && ew <= 122)
            return true;
          return false;
        });

        $("#password").keypress(function(event) {
          var ew = event.which;
          if (ew == 32)
            return true;
          if (48 <= ew && ew <= 57)
            return true;
          if (65 <= ew && ew <= 90)
            return true;
          if (97 <= ew && ew <= 122)
            return true;
          return false;
        });

        $("#cfmpassword").keypress(function(event) {
          var ew = event.which;
          if (ew == 32)
            return true;
          if (48 <= ew && ew <= 57)
            return true;
          if (65 <= ew && ew <= 90)
            return true;
          if (97 <= ew && ew <= 122)
            return true;
          return false;
        });
      });

      $(document).ready(function() {
        $("#username").blur(function(event) {
          var user_name = $(this).val();
          var user_name_length = user_name.length;
          if (user_name_length > 0) {
            check_username_ajax(user_name);
          }
        });

        $("#password").blur(function(event) {
          var pass = $(this).val();
          var pass_length = pass.length;
          if (pass_length > 0) {
            check_password_ajax(pass);
          }
        });

        $("#cfmpassword").blur(function(event) {
          var pass = $("#password").val();
          var cfm_pass = $(this).val();
          var cfm_pass_length = cfm_pass.length;
          if (cfm_pass_length > 0) {
            check_cfmpassword_ajax(pass, cfm_pass);
          }
        });

        $('#province').on('change',function() {
          var province_name = $(this).val();
          if (province_name) {
            $.ajax({
              type:'POST',
              url:'../get-amphur.php',
              data:'province_name=' + province_name,
              success:function(html) {
                $('#amphur').html(html);
              }
            });
          }
        });

        // $("#username").keyup(function(e) {
        //   clearTimeout(x_timer);
        //   var user_name = $(this).val();
        //   x_timer = setTimeout(function() {
        //     check_username_ajax(user_name);
        //   }, 1000);
        // });

        // $("#password").keyup(function(e) {
        //   clearTimeout(x_timer);
        //   var pass = $(this).val();
        //   x_timer = setTimeout(function() {
        //     check_password_ajax(pass);
        //   }, 1000);
        // });

        // $("#cfmpassword").keyup(function(e) {
        //   clearTimeout(x_timer);
        //   var pass = $("#password").val();
        //   var cfm_pass = $(this).val();
        //   x_timer = setTimeout(function() {
        //     check_cfmpassword_ajax(pass, cfm_pass);
        //   }, 1000);
        // });

        function check_username_ajax(username) {
          $("#user-result").html('<img src="../images/ajax-loader.gif" />');
          $.post('../username-checker.php', {'username':username}, function(data) {
            $("#user-result").html(data);
          });
        }

        function check_password_ajax(pass) {
          $("#pass-result").html('<img src="../images/ajax-loader.gif" />');
          $.post('../password-checker.php', {'password':pass}, function(data) {
            $("#pass-result").html(data);
          });
        }

        function check_cfmpassword_ajax(pass, cfm_pass) {
          $("#cfmpass-result").html('<img src="../images/ajax-loader.gif" />');
          $.post('../cfmpassword-checker.php', {'password':pass, 'cfmpassword': cfm_pass}, function(data) {
            $("#cfmpass-result").html(data);
          });
        }
      });
    </script>
  </body>
</html>

<!-- if session not start then start it -->
<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
<?php require_once('Connections/conn_db.php');?>
<!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>
<!-- login path setting -->
<?php
if(isset($_GET['sPath'])){
  $sPath=$_GET['sPath'].".php";
}else{
  $sPath="index_p01.php";
}
if(isset($_SESSION['login'])){
  header(sprintf("location:%s",$sPath));
  // for php 5.2 version
  // echo "<script>window.location.href='".$sPath."';</script>";
}


?>
<!doctype html>
<html lang="en">
  <!-- head setup -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project01</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./website_p01.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
    <!-- AOS plugin -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Lightbox css plugin -->
    <link rel="stylesheet" href="./css/jquery.lightbox-0.5.css">
    
  </head>
  <body class="position-relative" style="background-image:radial-gradient(rgba(250,200,100,0.5),rgba(255,255,255,0.8));">
  <!-- whole page absolute item -->
   <?php require_once("./page_deco.php") ?>

<div class="wrapper container-fluid">
<section id="header" style="position: sticky;top:0; z-index:3;" >
  <!-- navigation -->
  <?php require_once("navbar.php") ?>
</section>
<section id="productcontent">
  <div class="container-fluid">
      <div class="row align-items-start g-0 d-flex flex-row">
          <div class="col-md-3" style="height: 100vh;">
            <!-- sidebar -->
              <?php require_once("./sidebar.php") ?>
          </div>
          <div class="col-md-9" style="height: 100vh;">
            <!-- Member login form -->
            <?php require_once("./member_login_content.php") ?>


             
          </div>
      </div>
  </div>
</section>

<section id="footer" >
<?php
require_once('./footer.php')
?>
</section>
<!-- loading page while loading -->
 <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,0.5);z-index:10;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>


      
</div>

    
<!--plugin section  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/jquery.lightbox-0.5.js"></script>
<script src="./js/jslib.js"></script>
<script src="./js/commlib.js"></script>

<!-- init or function section -->
<script>
    AOS.init();
</script>
<script>
// chating box
document.getElementById("chatToggle").addEventListener("click", function() {
  const panel = document.getElementById("chatPanel");
  panel.style.display = panel.style.display === "block" ? "none" : "block";
});

 $(function(){
    $("#form1").submit(function(e){
      e.preventDefault();
      const inputAccount=$("#inputAccount").val();
      const inputPassword=MD5($("#inputPassword").val());
      $("#loading").show();
      // 利用$ajax函數呼叫後台的auth_user.php驗證帳號密碼
      $.ajax({
        url:'./auth_user.php',
        type:'post',
        dataType:'json',
        data:{
          inputAccount:inputAccount,
          inputPassword:inputPassword,
        },
        success:function(data){
          if(data.c==true){
            alert(data.m);
            // window.location.reload();
            window.location.href="<?php echo $sPath; ?>";
          }else{
            alert(data.m);
          }
        },
        error:function(data){
          alert("系統無法連接後台資料庫");
        }
      });
    });
  });
</script>


</body>
</html>
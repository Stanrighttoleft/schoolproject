<!-- if session not start then start it -->
<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
 <?php require_once('Connections/conn_db.php');?>
  <!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>

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
  <body class="position-relative">
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
          <div class="col-md-3" style="height: 200vh;">
            <!-- sidebar -->
              <?php require_once("./sidebar.php") ?>
          </div>
          <div class="col-md-9" style="height: 250vh;">
            <!-- checkoutpage content -->
<h3>會員結帳作業</h3>

<div class="row">
    <div class="card col">
    <div class="card-header" style="color:#007bff;"><i class="fas fa-truck fa-flip-horizontal me-1"></i>配送資訊</div>
    <div class="card-body">
        <h4 class="card-title">收件人資訊：</h4>
        <h5 class="card-title">姓名：</h5>
        <p class="card-text">電話：</p>
        <p class="card-text">郵遞區號：</p>
        <p class="card-text">地址：</p>
        <a href="#" class="btn btn-primary">選擇其他收件人：</a>
    </div>
    </div>
    <div class="card col ms-3">
    <div class="card-header" style="color:#000;"><i class="fas fa-truck fa-flip-horizontal me-1"></i>付款人資訊</div>
    <div class="card-body">
        <h4 class="card-title">付款人資訊：</h4>
        <h5 class="card-title">姓名：</h5>
        <p class="card-text">電話：</p>
        <p class="card-text">郵遞區號：</p>
        <p class="card-text">地址：</p>
        <a href="#" class="btn btn-primary">選擇其他收件人：</a>
    </div>
    </div>
</div>
<div class="table-responsive-md">
  <table class="table table-hover mt-3">
    <thead>
      <tr class="text-bg-primary">
        <td width="10%">產品編號</td>
        <td width="10%">圖片</td>
        <td width="30%">名稱</td>
        <td width="15%">價格</td>
        <td width="15%">數量</td>
        <td width="20%">小計</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td><img src="" alt=""></td>
        <td>Hi</td>
        <td>
          <h4>$9999</h4>
        </td>
        <td>10</td>
        <td>
          <h4 class="text-danger pt-1">$99999</h4>
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td><img src="" alt=""></td>
        <td>Hi</td>
        <td>
          <h4>$9999</h4>
        </td>
        <td>10</td>
        <td>
          <h4 class="text-danger pt-1">$99999</h4>
        </td>
      </tr>
    </tbody>
    <tfoot class="text-center">
      <tr>
        <td colspan="7">累計：</td>
      </tr>
      <tr>
        <td colspan="7">運費：</td>
      </tr>
      <tr>
        <td colspan="7" class="text-danger">總計：</td>
      </tr>
      <tr >
        <td colspan="7"><button id="btn04" name="btn04" class="btn btn-danger"><i class="fas fa-cart-arrow-down pr-2"></i>確認結帳</button></td>
      </tr>
    </tfoot>
  </table>
</div>
             
          </div>
      </div>
  </div>
</section>
<section id="productview" class="p-5 pt-1" data-aos="zoom-in-up">
    
</section>
<section id="news">
</section>
<section id="aboutus" class="bg-warning">
</section>
<section id="procedure"> 
</section>
<section id="footer" >
<?php
require_once('./footer.php')
?>
</section>
      
</div>

    
<!--plugin section  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/jquery.lightbox-0.5.js"></script>
<script src="./js/jslib.js"></script>

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
//change the main image when hover
$(function(){
  // when hover change #showGoods src
  $(".smpic").on("mouseover",function(){
    var imgsrc=$(this).attr("src");
      $("#showGoods").attr({"src":imgsrc});
    
  });
});
</script>
<!-- lightbox -->
<script>
 $(function(){
  $('a[rel="group"]').lightBox({
    maxHeight:$(window).height()*0.9,
    maxWidth:$(window).width()*0.9,
    overlayBgColor:'#000',
    overlayOpacity:0.5,
    fixedNavigation:true,
    containerResizeSpeed:700,
    txtImage:"產品",
    txt0f:'至',
  });
 });
</script>


</body>
</html>
<!-- if session not start then start it -->
<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
<?php require_once('Connections/conn_db.php');?>
<!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>
<!-- check wheather the user is login -->
<?php
if(!isset($_SESSION['login'])){
  $sPath="member_login.php?sPath=product_checkout.php";
  header(sprintf("Location:%s",$sPath));
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
    <div class="card-header" style="color:#000;"><i class="fas fa-truck fa-flip-horizontal me-1"></i>付款方式</div>
    <div class="card-body">
<!-- bootstrap card and tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style="font-size:14pt;">貨到付款</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" style="font-size:14pt;" aria-selected="false"  >信用卡付款</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false" style="font-size:14pt;">銀行轉帳</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="epay-tab" data-bs-toggle="tab" data-bs-target="#epay" type="button" role="tab" aria-controls="epay" aria-selected="false" style="font-size:14pt;">電子支付</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active ps-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <h4 class="card-title pt-3">收件人資訊：</h4>
    <h5 class="card-title">姓名：</h5>
    <p class="card-text">電話：</p>
    <p class="card-text">郵遞區號：</p>
    <p class="card-text">地址：</p>
  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
<!-- 信用卡分頁 -->
<table class="table caption-top">
  <caption>選擇付款帳戶</caption>
  <thead>
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="35%">信用卡系統</th>
      <th scope="col" width="30%">發卡銀行</th>
      <th scope="col" width="30%">信用卡號</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><input type="radio" name="creditCard" id="creditCard[]" checked></th>
      <td><img src="images/assets/Visa_Inc._logo.svg" alt="visa" class="img-fluid"></td>
      <td>玉山銀行</td>
      <td>1234****</td>
    </tr>
    <tr>
      <th scope="row"><input type="radio" name="creditCard" id="creditCard[]" checked></th>
      <td><img src="images/assets/MasterCard_Logo.svg" alt="master" class="img-fluid"></td>
      <td>玉山銀行</td>
      <td>1234****</td>
    </tr>
    <tr>
      <th scope="row"><input type="radio" name="creditCard" id="creditCard[]" checked></th>
      <td><img src="images/assets/UnionPay_logo.svg" alt="unionpay" class="img-fluid"></td>
      <td>玉山銀行</td>
      <td>1234****</td>
    </tr>
  </tbody>
</table>
<hr>
<button type="button" class="btn btn-outline-success">使用其他信用卡付款</button>
  </div>
  <!-- 建立銀行轉帳分頁 -->
  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
    <h4 class="card-title pt-3">ATM匯款資訊：</h4>
    <img src="./images/assets/Cathay-bk-rgb-db.svg" alt="cathay" class="img-fluid">
    <h5 class="card-title">匯款銀行： 銀行代碼：</h5>
    <h5 class="card-title">姓名：</h5>
    <p class="card-text">匯款帳號：</p>
    <p class="card-text">備註：</p>
  </div>
  <!-- 建立電子支付分頁 -->
  <div class="tab-pane fade" id="epay" role="tabpanel" aria-labelledby="epay-tab" tabindex="0">
    
<table class="table caption-top">
  <caption>選擇電子支付方式</caption>
  <thead>
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col" width="35%">電子支付系統</th>
      <th scope="col" width="60%">電子支付系統</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><input type="radio" name="epay[]" id="epay[]" checked></th>
      <td><img src="images/assets/Apple_Pay_logo.svg" alt="visa" class="img-fluid"></td>
      <td>Apple Pay</td>
    </tr>
    <tr>
      <th scope="row"><input type="radio" name="epay[]" id="epay[]"></th>
      <td><img src="images/assets/MasterCard_Logo.svg" alt="master" class="img-fluid"></td>
      <td>玉山銀行</td>
      <td>1234****</td>
    </tr>
    <tr>
      <th scope="row"><input type="radio" name="creditCard" id="creditCard[]" checked></th>
      <td><img src="images/assets/UnionPay_logo.svg" alt="unionpay" class="img-fluid"></td>
      <td>玉山銀行</td>
      <td>1234****</td>
    </tr>
  </tbody>
</table>

  </div>
</div>

<!-- the end of bootstrap card and tabs -->
        
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
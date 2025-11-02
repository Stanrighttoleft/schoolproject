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
    <style>
      table input:invalid{
        border:dotted red 2px;
      }
    </style>
    
  </head>
  <body class="position-relative">
  <!-- whole page absolute item -->
   <?php require_once("./page_deco.php") ?>

<div class="wrapper container-fluid">
<section id="header" style="position: sticky;top:0; z-index:3;" >
  <!-- navigation -->
  <?php require_once("navbar.php") ?>
</section>
<section id="cart" style="min-height:100vh;">

<div class="container-fluid">
  <div class="row align-items-start g-0 d-flex flex-row">
    <div class="col-md-3" >
      <!-- sidebar -->
      <?php require_once("./sidebar.php") ?>
    </div>
    <div class="col-md-9 mt-3 ps-3" >
      <!-- cart content -->
      <?php require_once('./product_cart_content.php') ?>
      
    </div>
  </div>
</div>
</div>
</section>
<section id="footer" >
<?php require_once("./footer.php"); ?>
</section>

<!--  Toast container -->
<div class="toast-container position-fixed translate-middle p-3" style="top:50%; right:20%;">
  <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1000">
    <div class="d-flex">
      <div class="toast-body fs-4 text-center" id="toastBody">
        <!-- Message text will be inserted here -->
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
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
//change the main image when hover for light box
$(function(){
  // when hover change #showGoods src
  $(".smpic").on("mouseover",function(){
    var imgsrc=$(this).attr("src");
      $("#showGoods").attr({"src":imgsrc});
    
  });
});
</script>
<script>
// lightbox
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
// toast function for the qty
function showToast(message,type="primary"){
  const toastLiveExample=document.getElementById('liveToast');
  const toastBody=document.getElementById('toastBody');

  // change color type dynamically
  toastLiveExample.className=`toast align-items-center text-bg-${type} border-0`;
  toastBody.textContent=message;
  
  const toastBootstrap=bootstrap.Toast.getOrCreateInstance(toastLiveExample);
  toastBootstrap.show();
}

//將變更數量寫入後台資料庫
$(".cartQty").change(function(){
  let qty=$(this).val();
  const cartid=$(this).attr("cartid");
  if(qty<=0 || qty>=20){
    showToast("數量請設為0以上，20比以上的數量請與網站小編聯繫大宗貨物購買方法！", 'danger');
    return false;
  }
  $.ajax({
    url:'change_qty.php',
    type:'post',
    dataType:'json',
    data:{
      cartid:cartid,
      qty:qty,
    },
    success:function(data){
      if(data.c==true){
        showToast(data.m, 'success');
        setTimeout(()=>window.location.reload(),1000);
        
      }else{
        showToast(data.m,'warning')
      }
    },
    error:function(data){
      showToast("無法建立連線，請聯絡管理人員",'danger')
    }
  });
});
</script>


</body>
</html>
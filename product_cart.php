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
      <!-- query the content for shopping cart -->
       <?php
       $SQLstring="SELECT * FROM cart, product, product_img WHERE ip='".$_SERVER['REMOTE_ADDR']."' AND orderid IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY  cartid DESC";
       $cart_rs=$link->query($SQLstring);
       $ptotal=0; //設定累加變數初始為0
       ?>
      <!-- cart detail content -->
      <h3 class="mb-3">購物車，你點選的東西都在這裡：</h3>
    <?php if($cart_rs->rowCount()!=0) { ?>
      <a id="btn01" class="btn btn-primary" href="./products_p01.php" >繼續購物</a>
      <button id="btn02" name="btn02" class="btn btn-secondary" onclick="window.history.go(-1)" >回上一頁</button>
      <button id="btn03" class="btn btn-secondary" onclick="btn_confirmLink('確定清空購物車?','shopcart_del.php?mode=2');" >清空</button>
      <a id="btn04" class="btn btn-danger" href="product_checkout.php" >前往結帳</a>
      <div class="table-responsive-md text-center">
        <table class="table table-hover mt-3 text-center">
          <thead>
            <tr class="table-warning text-center" >
              <td width="10%">產品編號</td>
              <td width="10%">圖片</td>
              <td width="25%">名稱</td>
              <td width="15%">價格</td>
              <td width="10%">數量</td>
              <td width="15%">小計</td>
              <td width="15%">下次再買</td>
            </tr>
          </thead>
          <tbody>
            <?php while($cart_data=$cart_rs->fetch()){ ?>
            <tr>
              <td><?php echo $cart_data['p_id']; ?></td>
              <td><a href="./product_detail.php?p_id=<?php echo $cart_data['p_id']; ?>"><img src="./images/products/big/<?php echo $cart_data['img_file']; ?>" alt="<?php echo $cart_data['p_name']; ?>" class="img-fluid" ></a></td>
              <td><a href="./product_detail.php?p_id=<?php echo $cart_data['p_id']; ?>" class="text-decoration-none text-black"><?php echo $cart_data['p_name']; ?></a></td>
              <td>
                <h4 class="text-danger"></h4>
              </td>
              <td style="min-width:100px;">
                <div class="input-group">
                  <input type="number" class="form-control" id="qty[]" name="qty[]" value="<?php echo $cart_data['qty']; ?>" min="1" max="19" cartid="<?php echo $cart_data['cartid']; ?>" required>
                </div>
              </td>
              <td>$<?php echo $cart_data['p_price'] * $cart_data['qty']; ?></td>
              <td><button id="btn[]" class="btn btn-danger" id="btn[]" name="btn[]" onclick="btn_confirmLink('確定刪除本資料?','shopcart_del.php?mode=1&cartid=<?php echo $cart_data['cartid']; ?>');" >取消</button></td>
            </tr>
            <?php $ptotal+=$cart_data['p_price']*$cart_data['qty']; } ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7">累計：<?php echo $ptotal; ?></td>
            </tr>
            <tr>
              <td colspan="7">運費：100</td>
            </tr>
            <tr>
              <td colspan="7" class="text-danger">總計：<?php echo $ptotal +100; ?> </td>
            </tr>
          </tfoot>
          
        </table>
      </div>
    <?php } else { ?>
      <div class="alert alert-warning" role="alert">購物車是空的！請先選購商品！</div>
    <?php } ?>
      
    </div>
  </div>
</div>
</div>
</section>
<section id="footer" >
<?php require_once("./footer.php"); ?>
</section>
      


    
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
//將變更數量寫入後台資料庫

</script>


</body>
</html>
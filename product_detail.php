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
          <div class="col-md-9" style="height: 200vh;">
              <!-- Product detail main content -->
            <div class="card mb-3 ms-3 mt-3" >
              <div class="row g-0">
                <div class="col-md-5">
                  <!-- php get the information of product from database -->
                   <?php
                   if(!isset($_GET['p_id'])){
                    die("missing productID");
                   }
                   $p_id=intval($_GET['p_id']);
                   //  ---1.get the product info
                   $SQLstring=sprintf("SELECT * FROM product WHERE p_id=%d", $p_id);
                   $product_rs=$link->query($SQLstring);
                   $data=$product_rs->fetch();
                   if(!$data){
                    die("<p class='text-danger'> No product found for ID: {$p_id}</p>");
                   }
                  //  ---2. get product images
                   $SQLstring=sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d ORDER BY sort", $p_id);
                   $img_rs=$link->query($SQLstring);
                   $imgList=$img_rs->fetch();

                   if (!$imgList) {
                    echo "<p class='text-danger'>No product images found for this product.</p>";
                  } else {

                   ?>
                   <!-- the main image -->
                  <img id="showGoods" name="showGoods" src="./images/products/big/<?php echo $imgList['img_file']; ?>" class="img-fluid rounded-start" alt="<?php echo $data['p_name']; ?>" title="<?php echo $data['p_name']; ?>" style="width:100%; height:400px; object-fit:contain;">
                    <div class="row mt-2">
                      
                      <!-- start to loop through all image in the  product_img table-->
                      <?php do { ?>
                      <div class="col-md-4">
                        <a href="./images/products/big/<?php echo $imgList['img_file']; ?>" rel="group" class="" title="<?php echo $data['p_name']; ?>">
                          <img  src="./images/products/big/<?php echo $imgList['img_file']; ?>" class="img-fluid smpic img<?php echo $data['p_id']; ?>" alt="<?php echo $data['p_name']; ?>" title="<?php echo $data['p_name']; ?>">
                        </a>
                      </div>
                      <?php } while ($imgList=$img_rs->fetch()); ?>
                      
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $data['p_name']; ?> </h5>
                    <p class="card-text"><?php echo $data['p_intro']; ?> </p>
                    <h4>NT: <?php echo $data['p_price']; ?></h4>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <div class="input-group input-group-lg">
                          <span class="input-group-text" id="inputGroup-sizing-lg">數量</span>
                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" id="qty" name="qty" value="1">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button name="button01" id="button01" type="button" class="btn btn-success btn-lg color-success" onclick="addcart(<?php echo $data['p_id']; ?>)" >加入購物車</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <!--above is image card  -->
             <!--start of the description drop box -->
            <div class="productContent ms-3">
             <?php echo $data['p_content']; ?>
             
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
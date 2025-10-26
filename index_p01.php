<!-- if session not start then start it -->
<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
 <?php require_once('Connections/conn_db.php');?>




<!doctype html>
<html lang="en">
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
    
  </head>
  <body class="position-relative">
    <!-- whole page decoration absolute item -->
     <?php require_once("./page_deco.php") ?>

    <div class="wrapper container-fluid">
      <section id="header" style="position: sticky;top:0; z-index:3;" >
        <!-- navigation -->
      <?php require_once("./navbar.php"); ?>
      </section>
    <section id="banner"   style="width: 100%; height: 600px;">
      <!--  carousel -->
        <div id="carouselBanner" class="carousel slide h-100 carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner h-100">
            <div class="carousel-item active position-relative h-100">
              <img src="./images/assets/rabbit.png" class="position-absolute" style="top:30%; left:45%; z-index:2">
              <img src="./images/assets/fun.png" class="position-absolute" style="left:50%; top:20%;">
              <img src="./images/assets/grass1.png" class="position-absolute" style="bottom:0%;">
              <img src="./images/assets/grass1.png" class="position-absolute" style="bottom:0%; left:50%">
            </div>

            <div class="carousel-item position-relative h-100">
              <!-- Another slide (e.g., a different background or image set) -->
              <img src="./images/assets/rabbit.png" class="position-absolute" style="top:40%; left:45%; z-index:2">
              <img src="./images/assets/fun.png" class="position-absolute" style="left:40%; top:20%;">
              <img src="./images/assets/grass1.png" class="position-absolute" style="bottom:0%;">
              <img src="./images/assets/grass1.png" class="position-absolute" style="bottom:0%; left:50%">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>       




        <!-- carousel -->
        <!-- <div class="position-relative overflow-hidden">
          <img src="./images/assets/rabbit.png" alt="" class="position-absolute" style="top:30%; left:45%; z-index:2">
          <img src="./images/assets/fun.png" alt="" class="position-absolute" style="left:50%; top:20%;">
          <img src="./images/assets/grass1.png" alt="" class="position-absolute" style="bottom:0%;  ">
          <img src="./images/assets/grass1.png" alt="" class="position-absolute" style="bottom:0%; left:50%  ">
        </div> -->
       
    </section>
    <section id="productview" class="p-5 pt-1" data-aos="zoom-in-up">
        <div class="w-100 d-flex justify-content-center mb-3" style="font-size: 20px;">優惠商品</div>
        <div class="scrollwrapper position-relative">

        <!-- navigation -->
             <i class="fa-solid fa-chevron-left position-absolute" style="color:#ffd43b; font-size:100px; top:30%; z-index:2; cursor:pointer;" alt=""></i>
             <i class="fa-solid fa-chevron-right position-absolute" style="color:#ffd43b; font-size:100px; top:30%; right:0%; z-index:2; cursor:pointer;" alt=""></i>
          <div class="product-row overflow-hidden d-flex flex-nowrap">
            
            <!-- product cards -->

            <?php 
            // lookup for the hot product from database
            $SQLstring="SELECT * FROM hot,product,product_img WHERE hot.p_id=product_img.p_id AND hot.p_id=product.p_id AND product_img.sort=1  order by h_sort";
            $hot=$link->query($SQLstring);
            ?>
            <?php while($data=$hot->fetch()){ ?>
            
            <div class="card flex-shrink-0 p-1 m-2 mx-5" style="width: 18rem;">
              <div class="text-center">
                <a href="./product_detail.php?p_id=<?php echo $data['p_id']; ?>" class=" text-decoration-none text-black">
                <img src="./images/products/big/<?php echo $data['img_file']; ?>" class="card-img-top" alt="..."
                style="width: 150px;">
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['p_name'] ?></h5>
                <p class="card-text">
                <?php 
                $intro = strip_tags($data['p_intro']); // remove HTML
                $preview = mb_substr($intro, 0, 50, "UTF-8"); // get first 50 characters
                echo $preview . (mb_strlen($intro, "UTF-8") > 50 ? '...' : '');
                ?>
                </p>
                <p class="card-text">NT: <?php echo $data['p_price'] ?></p>
                <div class="d-flex ">
                <button href="#" class="btn btn-primary me-1" onclick="addcart(<?php echo $data['p_id']; ?>) ">放入購物車</button>
                <a href="./product_detail.php?p_id=<?php echo $data['p_id']; ?>" class="btn btn-success">更多資訊</a>
              </div>
              </div>
            </div>
            <?php } ?>      
          </div>
        </div>
        <div class="w-100 d-flex justify-content-center mt-3" style="font-size: 20px;">瞭解更多</div>
    </section>
    <section id="news">
       <div class="row">
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-12 d-flex justify-content-center" style="font-size: 20px; font-weight:800">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;澳洲時事
            </div>
            <div class="col-md-12 d-flex">
              <div class="col-md-2" style="font-size: 16px;  border-bottom: dotted 1px black;">BBC</div>
              <div class="col-md-7" style="font-size: 16px;  border-bottom: dotted 1px black; ">澳洲總理脫光光遊街</div>
              <div class="col-md-3" style="font-size: 16px;  border-bottom: dotted 1px black; ">日期：04/12/2025</div>
            </div>
            <div class="col-md-12 d-flex">
              <div class="col-md-2" style="font-size: 16px;  border-bottom: dotted 1px black;">ABC</div>
              <div class="col-md-7" style="font-size: 16px;  border-bottom: dotted 1px black;">移民改革2025重磅消息</div>
              <div class="col-md-3" style="font-size: 16px;  border-bottom: dotted 1px black;">日期：05/12/2025</div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <img src="./images/assets/pen.gif" class="img-fluid" alt="" style="max-width:100%; height:auto;">
        </div>
       </div> 
      </section>
      <section id="aboutus" class="bg-warning">
        <div class="row">
          <div class="col-md-4">
            <img src="./images/assets/shipment1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-4">
            <img src="./images/assets/aboutus.svg" class="img-fluid" alt="" style="height:600px;">
          </div>
          <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi earum inventore sit repudiandae placeat amet esse, impedit autem ratione deserunt maiores eius officiis at sunt eveniet sequi. Ducimus, beatae laboriosam?</p>
            <button class="btn btn-warning shadow">關於我們</button>
          </div>
        </div>
      </section>
      <section id="procedure">
        <div class="position-relative">
          <img src="./images/assets/orderprocess.png" class="img-fluid" style="width: 100%;" alt="">
          <button class="position-absolute btn btn-warning  shadow fw-bolder" style="z-index:5; width:150px;height:50px; left:50%; bottom:20%; font-size:1.2em ">點我了解</button>
        </div>
        
</section>
<section id="footer" >
<?php require_once('./footer.php') ?>
</section>
      
    </div>

    
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="./js/jslib.js"></script>
  <script>
      AOS.init();
  </script>

  <!-- jquery version of scroll item list -->
  <!-- <script>
$(document).ready(function() {
  const $row = $(".product-row");
  const scrollAmount = 400; // Adjust this to how far each click scrolls

  $(".fa-chevron-left").on("click", function() {
    $row.animate({
      scrollLeft: $row.scrollLeft() - scrollAmount
    }, 400); // 400ms smooth scroll
  });

  $(".fa-chevron-right").on("click", function() {
    $row.animate({
      scrollLeft: $row.scrollLeft() + scrollAmount
    }, 400);
  });
});
</script> -->
<script>

  //product view
document.addEventListener("DOMContentLoaded", () => {
  const row = document.querySelector(".product-row");
  const scrollAmount = 400;

  document.querySelector(".fa-chevron-left").addEventListener("click", () => {
    row.scrollBy({ left: -scrollAmount, behavior: "smooth" });
  });

  document.querySelector(".fa-chevron-right").addEventListener("click", () => {
    row.scrollBy({ left: scrollAmount, behavior: "smooth" });
  });
});
// chating box
document.getElementById("chatToggle").addEventListener("click", function() {
  const panel = document.getElementById("chatPanel");
  panel.style.display = panel.style.display === "block" ? "none" : "block";
});
</script>


</body>
</html>
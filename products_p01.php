<!-- if session not start then start it -->
<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
 <?php require_once('Connections/conn_db.php');?>
  <!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>

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
    <div class="position-fixed carticon rounded-circle bg-white shadow" style="top:30%; right:20%; width:100px; height:100px; z-index:5;" >
      <img src="./images/assets/carticon.png" style="width: 100%; height:auto;" alt="">
    </div>
    <!-- Floating chat/contact box -->
    <div class="floating-box">
      <div class="chat-toggle" id="chatToggle">
        <i class="fa-solid fa-comments me-1"></i><span style="font-size: 1em;">聯絡我們</span>
      </div>
      <div class="chat-panel shadow-lg" id="chatPanel">
        <h5 class="mb-3 text-center">聯絡我們</h5>
        <div class="d-flex flex-column align-items-center">
          <a href="https://line.me/ti/p/xxxx" target="_blank" class="btn btn-success mb-2 w-75">
            <i class="fa-brands fa-line me-2"></i> LINE
          </a>
          <a href="https://facebook.com/xxxx" target="_blank" class="btn btn-primary mb-2 w-75">
            <i class="fa-brands fa-facebook me-2"></i> Facebook
          </a>
          <a href="mailto:info@yourmail.com" class="btn btn-warning text-dark w-75">
            <i class="fa-solid fa-envelope me-2"></i> Email
          </a>
        </div>
      </div>
    </div>
    

    <div class="wrapper container-fluid">
    <section id="header" style="position: sticky;top:0; z-index:3;" >

      <!-- php function multiList01 for the navbar -->
        <?php
          function multiList01(){
            global $link;
            //列出產品類別第一層
            $SQLstring="SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
            $pyclass01=$link->query($SQLstring);

          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; font-weight:600;">
                商品資訊
              </a>
              <ul class="dropdown-menu">
                <?php while ($pyclass01_Rows= $pyclass01->fetch()){ ?>
                <li class="nav-item dropend">
                  <a class="dropdown-item dropdown-toggle" href="#">
                    <?php echo $pyclass01_Rows['cname']; ?>
                  </a>
                  <?php
                  //list the second layer of the product according to the class
                  $SQLstring=sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort",$pyclass01_Rows['classid']);
                  $pyclass02=$link->query($SQLstring);
                  ?>
                    <ul class="dropdown-menu">
                      <?php while($pyclass02_Rows=$pyclass02->fetch()){ ?>
                        <li><a href="#" class="dropdown-item"><em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><?php echo $pyclass02_Rows['cname']; ?></a></li>
                      <?php } ?>
                    </ul>
                </li>
              <?php }?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">優惠商品</a></li>
            </ul>
          </li>
        <?php } ?>



        <div class="top d-flex bg-warning"> 
          <div class="topleft ms-auto w-60 d-flex justify-content-end" style="width: 50%;">
            <img src="./images/assets/facebook.png" class="mx-3" alt="" style="height: 30px;"> 粉絲團 
            <img src="images/assets/like.png" alt="" style="height: 30px;" class="mx-3">
          </div> 
        
          <div class="topright  d-flex justify-content-end w-40" style="width:50%;">
            <img src="" alt="">

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <i class="fa-solid fa-magnifying-glass mx-3 " style="font-size: 30px;"></i>
                <i class="fa-solid fa-user ms-3" style="font-size: 30px;"></i>
                <i class="fa-solid fa-cart-shopping mx-3" style="font-size: 30px;"></i>
                
          </div></div>
  
        <nav class="navbar navbar-expand-lg bg-warning sticky-top" >
          
          
          <div class="container-fluid ms-auto">
            <a class="navbar-brand" href="./index_p01.php"><img src="./images/assets/logov122.png" style="width: 80px;" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#" style="font-size: 20px; font-weight:600;">瞭解澳洲</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" style="font-size: 20px; font-weight:600;">澳洲時事</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; font-weight:600;">
                    澳洲代購
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>

                <!-- The dropdown component I am going to use -->
                <?php multiList01(); ?>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; font-weight:600;">
                    澳洲直購
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link " style="font-size: 20px; font-weight:600;">關於我們</a>
                </li>
              </ul>
              
              </form>
            </div>
          </div>
        </nav>      
    </section>
    <section id="productcontent">
            <div class="container-fluid">
                <div class="row align-items-start g-0 d-flex flex-row">
                    <div class="col-md-4" style="height: 200vh;">
                        <!-- Accordion item  -->
                        <?php
                        //列出產品第一層,取得資料庫資料並存在pyclass01
                        $SQLstring="SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
                        $pyclass01=$link->query($SQLstring);
                        $i=1;//控制編號順序
                        ?>
                        <div class="accordion mt-3" id="accordionExample">
                            <?php 
                            //列出第一層資訊
                            while($pyclass01_Rows=$pyclass01->fetch()){ ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>">
                                    <i class="fas <?php echo $pyclass01_Rows['fonticon']; ?>fa-lg fa-fw"></i><?php echo $pyclass01_Rows['cname'];?>
                                </button>
                                </h2>
                                <?php
                                //列出資料類別對應的第二層資料
                                $SQLstring=sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass01_Rows['classid']);
                                $pyclass02=$link->query($SQLstring);
                                ?>
                                <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo($i==1)?'show':''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table">
                                        <tbody>
                                        <?php while($pyclass02_Rows=$pyclass02->fetch()){ ?>
                                            <tr>
                                                <td>
                                                    <a href="" class="text-decoration-none text-black"><em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><?php echo $pyclass02_Rows['cname']; ?></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                                </div>
                            </div>
                            <?php $i++; }?>
                        </div>
                    </div>
                    <div class="col-md-8" style="height: 200vh;">
                        <!-- Product sortbar -->
                        <select class="form-select m-3" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <!-- Product main content -->
                         <?php
                         //get product information from database
                         $maxRows_rs=12; //maxpage
                         $pageNum_rs=0; //start page
                         if(isset($_GET['pageNum_rs'])){
                            $pageNum_rs=$_GET['pageNum_rs'];
                         }
                         $startRow_rs=$pageNum_rs*$maxRows_rs;
                         //列出產品product資料查詢
                         $queryFirst=sprintf("SELECT * FROM product, product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id DESC", $maxRows_rs);
                         $query=sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
                         $pList01=$link->query($query);
                         $i=1; //控制每row產生

                         

                         ?>
                         <!-- control the card to make product list -->
                        <!-- <div class="row ms-3"> -->
                        <?php while($pList01_Rows=$pList01->fetch()) { ?>
                            <?php if($i%3==1){ ?><div class="row text-center ms-3"><?php } ?>
                            <div class="card col-md-4">
                                <img src="./images/products/big/<?php echo $pList01_Rows['img_file']; ?>" class="card-img-top" alt="<?php echo $pList01_Rows['p_name']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $pList01_Rows['p_name']; ?></h5>
                                    <p class="card-text"><?php echo mb_substr($pList01_Rows['p_intro'],0,30,"utf-8"); ?></p>
                                    <p>NT<?php echo $pList01_Rows['p_price']; ?></p>
                                    <a href="#" class="btn btn-primary">更多資訊</a>
                                    <a href="#" class="btn btn-primary">放購物車</a>
                                </div>
                            </div>
                        <?php if($i %3==0 || $i==$pList01->rowCount()){?></div><?php } ?>
                        <?php $i++; ?>
                        <?php } ?> 
                        <!--This place reserve for  pagination  -->
                        <div class="mt-5" style="text-align: center;">
                            <?php //取得目前頁數
                            if(isset($_GET['totalRows_rs'])){
                                $totalRows_rs=$_GET['totalRows_rs'];
                            }else{
                                $all_rs=$link->query($queryFirst);
                                $totalRows_rs=$all_rs->rowCount();
                            }
                            $totalPages_rs=ceil($totalRows_rs/$maxRows_rs)-1;
                            //呼叫分頁功能函數
                            $prev_rs="&laquo";
                            $next_rs="&raquo";
                            $separator="|";
                            $max_links=20;
                            $pages_rs=buildNavigation($pageNum_rs,$totalPages_rs,$prev_rs,$next_rs,$separator,$max_links,true,3,"rs");
                            ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php echo $pages_rs[0].$pages_rs[1].$pages_rs[2]; ?>
                                </ul>
                            </nav>
                            test where it is
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
        <div class="row bg-success position-relative text-white footertop" style="height:400px;">
        
          <div class="col-md-4">

            <img src="./images/qrcode.jpg" style="width: 200px;" class="mt-5 mb-5" alt="">
            <br>
             掃我到客服
          </div>
          <div class="col-md-4">
            <img src="./images/assets/logov122.png" class="mt-5" style="width: 300px;" alt="">
          </div>
          <div class="col-md-4 mt-5 text-decoration-underline">
            公司名稱：澳打國際
            <br>
            公司電話：
            <br>
            公司住址：
            <br>
            copyright：all right reserved
          </div>
        </div>

        
      </section>
      
    </div>

    
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

// chating box
document.getElementById("chatToggle").addEventListener("click", function() {
  const panel = document.getElementById("chatPanel");
  panel.style.display = panel.style.display === "block" ? "none" : "block";
});
</script>


</body>
</html>
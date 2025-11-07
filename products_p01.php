<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
 <?php require_once('Connections/conn_db.php');?>
  <!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>

<!doctype html>
<style>
.card:hover {
  box-shadow: 0 8px 16px rgba(0,0,0,0.15);
  transform: translateY(-4px) ;
  opacity: 80%;
  transition: all 0.3s ease;
}
</style>
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
    <?php require_once('./page_deco.php') ?>

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
                    <!-- Product sortbar -->
                    <select class="form-select m-3" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <!-- Product main content -->

                    <!-- the product card -->
                    <?php
                        //get product information from database
                        $maxRows_rs=9; //max products per page
                        $pageNum_rs=0; //start page
                        if(isset($_GET['pageNum_rs'])){
                        $pageNum_rs=$_GET['pageNum_rs'];
                        }
                        $startRow_rs=$pageNum_rs*$maxRows_rs;

                        // 產品查詢功能邏輯區
                        if(isset($_GET['search_name'])){
                          //使用關鍵字查詢
                          $queryFirst=sprintf("SELECT * FROM product,product_img,pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid=pyclass.classid AND (product.p_name OR product.p_price LIKE '%s' ) ORDER BY product.p_id DESC",'%'.$_GET['search_name'].'%');
                        }elseif(isset($_GET['level'])&& $_GET['level']==1){
                          //使用第一層類別查詢
                          $queryFirst=sprintf("SELECT * FROM product,product_img,pyclass WHERE p_opne=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid=pyclass.classid AND pyclass.uplink='%d' ORDER BY product.p_id DESC", $_GET['classid']);
                        }elseif(isset($_GET['classid'])){
                            //使用產品類別查詢
                            $queryFirst=sprintf("SELECT * FROM product, product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid='%d' ORDER BY product.p_id DESC", $_GET['classid']);
                        }else{
                            //列出產品product資料查詢
                            $queryFirst=sprintf("SELECT * FROM product, product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id DESC", $maxRows_rs);
                        }

                        //列出產品product資料查詢
                        $query=sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
                        $pList01=$link->query($query);
                        $i=1; //控制每row產生
                        ?>

                      <!-- control the card to make product list -->
                      <!-- 查詢是否有資料 -->
                       <?php if($pList01->rowCount()!=0) { ?>

                      <!-- 列出資料 -->
                      <?php while($pList01_Rows=$pList01->fetch()) { ?>
                        <?php if($i%3==1){ ?><div class="row text-center ms-3 g-2"><?php } ?>
                        <div class="col-md-4">
                            <div class="card rounded-2 mb-1 " style="min-height: 550px; ">
                              <a href="./product_detail.php?p_id=<?php echo $pList01_Rows['p_id']; ?>" >
                                <img src="./images/products/big/<?php echo $pList01_Rows['img_file']; ?>" class="card-img-top" style="max-height:250px; width:100%; object-fit:contain;" alt="<?php echo $pList01_Rows['p_name']; ?>"> </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $pList01_Rows['p_name']; ?></h5>
                                    <p class="card-text"><?php echo mb_substr($pList01_Rows['p_intro'],0,30,"utf-8"); ?></p>
                                    <p>NT<?php echo $pList01_Rows['p_price']; ?></p>
                                    <a href="./product_detail.php?p_id=<?php echo $pList01_Rows['p_id']; ?>" class="btn btn-primary">更多資訊</a>
                                    <button id="button01[]" name="button01[]" class="btn btn-success" onclick="addcart(<?php echo $pList01_Rows['p_id']; ?>)" >加入購物車</button>
                                </div>
                            </div>
                        </div>
                        <?php if($i %3==0 || $i==$pList01->rowCount()){?></div><?php } ?>
                        <?php $i++; ?>
                      <?php } ?> 
                    <!--This place reserve for  pagination  -->
                    <div class="mt-5" style="text-align: center;">
                    <!-- produce warming line -->
                    <?php }else{ ?>
                      <div class="alert alert-danger ms-3" role="alert">
                        抱歉，小編還在搜尋中。
                      </div>
                    <?php } ?>
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
<?php
require_once('./footer.php')
?>
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

// chating box
document.getElementById("chatToggle").addEventListener("click", function() {
  const panel = document.getElementById("chatPanel");
  panel.style.display = panel.style.display === "block" ? "none" : "block";
});
</script>


</body>
</html>
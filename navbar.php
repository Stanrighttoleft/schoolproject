<!-- php function multiList01 for the navbar -->
<?php
    function multiList01(){
    global $link;
    //列出產品類別第一層
    $SQLstring="SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
    $pyclass01=$link->query($SQLstring);

    ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="./products_p01.php" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; font-weight:600;">
        商品資訊
        </a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="./products_p01.php">所有商品</a></li>
        <li><hr class="dropdown-divider"></li>
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
                <li><a href="products_p01.php?classid=<?php echo $pyclass02_Rows['classid']; ?>" class="dropdown-item"><em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><?php echo $pyclass02_Rows['cname']; ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <?php }?>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">優惠商品</a></li>
    </ul>
    </li>
<?php } ?>
<!-- 查詢推車商品數量 -->
<?php
$SQLstring="SELECT * FROM cart WHERE orderid is NULL AND ip='".$_SERVER['REMOTE_ADDR']."'";
$cart_rs=$link->query($SQLstring);
?>
<!-- navigation main part -->
<div class="top d-flex bg-warning"> 
    <div class="topleft ms-auto w-60 d-flex justify-content-end" style="width: 50%;">
    <img src="./images/assets/facebook.png" class="mx-3" alt="" style="height: 30px;"> 粉絲團 
    <img src="images/assets/like.png" alt="" style="height: 30px;" class="mx-3">
    </div> 

    <div class="topright  d-flex justify-content-end w-40" style="width:50%;">
    <img src="" alt="">

    <form class="d-flex" role="search" name="search" action="products_p01.php" method="get">

        <!-- searching box -->
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_name" id="search_name" value="<?php echo (isset($_GET['search_name']))?$_GET['search_name']:''; ?>" required>
        <button type="submit" class="btn p-0 border-0 bg-transparent"><i class="fa-solid fa-magnifying-glass mx-3 " style="font-size: 30px;"></i></button>

        <!-- member -->
        <i class="fa-solid fa-user ms-3 mt-1" style="font-size: 30px;"></i>

        <!-- shopping cart -->
        <a href="product_cart.php" class="text-decoration-none text-black position-relative"><i class="fa-solid fa-cart-shopping mx-3 mt-1" style="font-size: 30px;"><span class="badge text-bg-danger position-absolute rounded-circle" style="left:20%; top:10%; height:20px; width:20px; font-size:10px;"><?php echo($cart_rs) ?$cart_rs->rowCount() :''; ?></span></i></a>
        
    </div>
</div>

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
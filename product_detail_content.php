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
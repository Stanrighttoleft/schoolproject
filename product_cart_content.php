<?php
    $SQLstring="SELECT * FROM cart, product, product_img WHERE ip='".$_SERVER['REMOTE_ADDR']."' AND orderid IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY  cartid DESC";
    $cart_rs=$link->query($SQLstring);
    $ptotal=0; //設定累加變數初始為0
    ?>
    <!-- query the shipping method for selection -->
    <?php
    $SQLshipping="SELECT * FROM shipping_method WHERE status=1";
    $ship_rs=$link->query($SQLshipping);
    ?>
    <!-- cart detail content -->
    <h3 class="mb-3 fw-semibold">購物車，你點選的東西都在這裡：</h3>
<?php if($cart_rs->rowCount()!=0) { ?>
    <a id="btn01" class="btn btn-primary" href="./products_p01.php" >繼續購物</a>
    <button id="btn02" name="btn02" class="btn btn-secondary" onclick="window.history.go(-1)" >回上一頁</button>
    <button id="btn03" class="btn btn-secondary" onclick="btn_confirmLink('確定清空購物車?','shopcart_del.php?mode=2');" >清空</button>
    <a id="btn04" class="btn btn-danger"  onclick="goCheckout()" >前往結帳</a>
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
            <h5 class="text-danger">$<?php echo $cart_data['p_price'] ?></h5>
            </td>
            <td style="min-width:100px;">
            <div class="input-group">
                <input type="number" class="form-control cartQty" id="qty[]" name="qty[]" value="<?php echo $cart_data['qty']; ?>" min="1" max="19" cartid="<?php echo $cart_data['cartid']; ?>" required>
            </div>
            </td>
            <td>$<?php echo $cart_data['p_price'] * $cart_data['qty']; ?></td>
            <td><button id="btn[]" class="btn btn-danger" id="btn[]" name="btn[]" onclick="btn_confirmLink('確定刪除本資料?','shopcart_del.php?mode=1&cartid=<?php echo $cart_data['cartid']; ?>');" >取消</button></td>
        </tr>
        <?php $ptotal+=$cart_data['p_price']*$cart_data['qty']; } ?>
        </tbody>
        <tfoot>

        <tr>
            <td id="subtotal" colspan="7">累計：<?php echo $ptotal; ?></td>
        </tr>
            <td colspan="7">
                運送方式：
                <div class="input-group my-3">
                    <label for="" class="form-label"></label>
                    <select name="shipping" id="shippingSelect" class="form-control">
                        <option value="">請選擇運送方式</option>
                        <?php while($ship_data=$ship_rs->fetch()) { ?>
                            <option value="<?php echo $ship_data['shipping_id']; ?>" data-cost="<?php echo $ship_data['shipping_cost']; ?>">
                                <?php echo $ship_data['shipping_name'],"($".$ship_data['shipping_cost'].")"; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </td>
        
        <tr>
            <td id="grandTotal" colspan="7" class="text-danger">總計：<?php echo $ptotal; ?> </td>
        </tr>
        </tfoot>
        
    </table>
    </div>
<?php } else { ?>
    <div class="alert alert-warning" role="alert">購物車是空的！請先選購商品！</div>
<?php } ?>
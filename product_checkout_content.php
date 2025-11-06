<!-- checkoutpage content -->

<!--  運送方式查詢-->
<?php
  // Get the user's IP
$ip = $_SERVER['REMOTE_ADDR'];
// Query shipping info for this cart session
$sql = "SELECT c.shipping_id, s.shipping_name, s.shipping_cost
        FROM cart c
        LEFT JOIN shipping_method s ON c.shipping_id = s.shipping_id
        WHERE c.ip=? AND c.orderid IS NULL
        LIMIT 1"; // assuming all items share the same shipping method
$stmt = $link->prepare($sql);
$stmt->execute([$ip]);
$shipping = $stmt->fetch();

// If nothing selected yet
$shippingName = $shipping['shipping_name'] ?? '尚未選擇';
$shippingCost = $shipping['shipping_cost'] ?? 0;

?>

<!-- 結帳資料查詢 -->
<?php
$SQLstring="SELECT * FROM cart, product, product_img WHERE ip='".$_SERVER['REMOTE_ADDR']."' AND orderid IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cartid DESC";
$cart_rs=$link->query($SQLstring);
$ptotal=0;//設定累加的變數，初始為0;
?>

<!-- 取得收件人地址資訊 -->
<?php
$SQLstring=sprintf("SELECT * ,city.Name AS ctName, town.Name AS toName FROM addbook,city,town WHERE emailid='%d' AND setdefault='1' AND addbook.myZip=town.Post AND town.AutoNo=city.AutoNo", $_SESSION['emailid']);
$addbook_rs=$link->query($SQLstring);
if($addbook_rs && $addbook_rs->rowCount() !=0){
    $data=$addbook_rs->fetch();
    $cname=$data['cname'];
    $mobile=$data['mobile'];
    $myzip=$data['myZip'];
    $address=$data['address'];
    $ctName=$data['ctName'];
    $toName=$data['toName'];
}else{
    $cname="";
    $mobile="";
    $myzip="";
    $address="";
    $ctName="";
    $toName="";
}
?>

    
    <h3 class="text-center mb-3 bg-danger text-white">會員結帳作業</h3>
    
    <!-- 收件人跟寄件人資訊 -->
    <div class="row">
      <div class="card col-md-12 mb-3" >
          <div class="card-header" style="line-height: 2rem;" >
          <i class="fas fa-truck fa-flip-horizontal me-1"></i>收件人資訊
          </div>
        <div class="card-body">
           
            <table class="table table-striped">
              <tr>
                <td>配送方式</td>
                <td><?php echo htmlspecialchars($shippingName); ?></td>
              </tr>
              <tr>
                <td>運費</td>
                <td>$<?php echo number_format($shippingCost); ?></td>
              </tr>
              <tr>
                <td>收件人</td>
                <td><?php echo $cname; ?></td>
              </tr>
              <tr>
                <td>電話</td>
                <td><?php echo $mobile; ?></td>
              </tr>
              <tr>
                <td>郵遞區號</td>
                <td><?php echo $myzip . $ctName . $toName; ?></td>
              </tr>
              <tr>
                <td>地址</td>
                <td><?php echo $address; ?></td>
              </tr>
            </table>
            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">選擇其他收件人</a>
        </div>
      </div>
      <div class="card col-md-12">
          <div class="card-header d-flex justify-content-start align-items-center" style="line-height: 3rem; height:3rem;"><i class="fas fa-credit-card me-2"></i>配送資訊 
          </div>
          <div class="card-body ">
    <!-- bootstrap card and tabs -->
    <ul class="nav nav-tabs ms-3">
      <li class="nav-item" role="presentation">
        <button class="nav-link active text-black bg-light" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style=" font-size:14pt;">貨到付款</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link text-black bg-light" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" style=" font-size:14pt;" aria-selected="false" >信用卡</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link text-black bg-light" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"  style=" font-size:14pt;">銀行轉帳</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link text-black bg-light" id="epay-tab" data-bs-toggle="tab" data-bs-target="#epay" type="button" role="tab" aria-controls="epay" aria-selected="false"  style=" font-size:14pt;">電子支付</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active  " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        
        <table class="table table-striped">
          <tr>
            <td>收件人</td>
            <td><?php echo $cname; ?></td>
          </tr>
          <tr>
            <td>電話</td>
            <td><?php echo $mobile; ?></td>
          </tr>
          <tr>
            <td>郵遞區號</td>
            <td><?php echo $myzip . $ctName . $toName; ?></td>
          </tr>
          <tr>
            <td>地址</td>
            <td><?php echo $address; ?></td>
          </tr>
        </table>
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
          <td><img src="images/assets/Apple_Pay_logo.svg" alt="applepay" class="img-fluid"></td>
          <td>Apple Pay</td>
        </tr>
        <tr>
          <th scope="row"><input type="radio" name="epay[]" id="epay[]"></th>
          <td><img src="images/assets/Line_pay_logo.svg" alt="linepay" class="img-fluid"></td>
          <td>Line Pay</td>
          
        </tr>
        <tr>
          <th scope="row"><input type="radio" name="epay[]" id="epay[]" ></th>
          <td><img src="images/assets/JKOPAY_logo.svg" alt="jkopay" class="img-fluid"></td>
          <td>JKOpay</td>
          
        </tr>
      </tbody>
    </table>
    
      </div>
    </div>
    
    <!-- the end of bootstrap card and tabs -->
            
        </div>
        </div>
    </div>
    <!-- 產品結帳表格 -->
    
    
    <div class="table-responsive-md" style="width:100%;">
      <table class="table table-hover mt-3">
        <thead>
            <tr class="text-bg-danger">
                <td width="10%">產品編號</td>
                <td width="10%">圖片</td>
                <td width="30%">名稱</td>
                <td width="15%">價格</td>
                <td width="15%">數量</td>
                <td width="20%">小計</td>
            </tr>
        </thead>
        <tbody>
            <!-- 開始生成結帳表格 -->
             <?php while($cart_data=$cart_rs->fetch()) {?>
            <tr class="">
                <td><?php echo $cart_data['p_id']; ?> </td>
                <td><img src="images/products/big/<?php echo $cart_data['img_file']; ?>" alt="<?php echo $cart_data['p_name']; ?>" class="img-fluid"> </td>
                <td><?php echo $cart_data['p_name']; ?></td>
                <td>
                    <h5 class="pt-1">NT<?php echo $cart_data['p_price']; ?></h5>
                </td>
                <td><?php echo $cart_data['qty']; ?></td>
                <td>
                    <h5 class="pt-1">$<?php echo $cart_data['p_price']*$cart_data['qty']; ?></h5>
                </td>
            </tr>
            <?php $ptotal += $cart_data['p_price']*$cart_data['qty']; } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">累計：<?php echo $ptotal; ?></td>
            </tr>
            <tr>
                <td colspan="7">運費：$<?php echo number_format($shippingCost); ?></td>
            </tr>
            <tr>
                <td colspan="7" class="color_red">總計：<?php echo $ptotal+$shippingCost; ?></td>
            </tr>
            <tr>
                <td colspan="7"><button id="btn04" name="btn04" class="btn btn-danger mr-2"><i class="fas fa-cart-arrow-down pr-2"></i>確認結帳</button>
                <button type="button" id="btn05" name="btn05" class="btn btn-warning mr-2" onclick="window.history.go(-1);"><i class="fas fa-undo-alt pr-2"></i>回上一頁</button>
            </td>
            </tr>
        </tfoot>
      </table>
    </div>
 
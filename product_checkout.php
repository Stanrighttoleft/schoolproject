<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
<?php require_once('Connections/conn_db.php');?>
<!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>
<!-- check wheather the user is login -->
<?php
if(!isset($_SESSION['login'])){
  $sPath="member_login.php?sPath=product_checkout.php";
  header(sprintf("Location:%s",$sPath));
}
?>
<style>
  .table td,.table th{
    padding: .75rem;
    vertical-align: top;
    border-bottom: none;
    border-top: 1px solid #dee2e6;
  }
</style>

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
      <div class="row align-items-start g-0 d-flex flex-row" style="height:150vh;">
        <div class="col-md-3" >
          <!-- sidebar -->
          <?php require_once("./sidebar.php") ?>
        </div>
          
        <div class="col-md-9 ps-4 my-3">
            <!-- checkout content not including modal -->
             <?php require_once('./product_checkout_content.php') ?>
        </div>
      </div>
  </div>
</section>
 
<section id="footer" >
<?php
require_once('./footer.php')
?>
</section>
      
</div>

<!-- bootstrap Modal -->
<!-- Modal -->
<?php
// 取得所有收件人資料
$SQLstring=sprintf("SELECT * , city.Name AS ctName,town.Name AS toName FROM addbook,city,town WHERE emailid='%d' AND addbook.myZip=town.Post AND town.AutoNo=city.AutoNo", $_SESSION['emailid']);
$addbook_rs=$link->query($SQLstring);
?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">收件人資訊</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
            <div class="row">
                <div class="col">
                 
                    <input type="text" name="cname" id="cname" class="form-control" placeholder="收件人姓名">
                </div>
                <div class="col">
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="收件人電話">
                </div>
                <div class="col">
                   
                    <select name="myCity" id="myCity" class="form-control">
                        <option value="">請選擇市區</option>
                        <!-- 建立選擇市區的程式 -->
                        <?php $city="SELECT * FROM `city` WHERE State=0"; $city_rs=$link->query($city);
                        while($city_rows=$city_rs->fetch()) { ?>
                          <option value="<?php echo $city_rows['AutoNo']; ?>">
                            <?php echo $city_rows['Name']; ?>
                          </option>
                        <?php } ?>
                    </select><br>
                </div>
                <div class="col">
                    <select name="myTown" id="myTown" class="form-control">
                        <option value="">請選擇地區</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="hidden" name="myZip" id="myZip" value="">
                    <label for="address" id="add_label" name="add_label">郵遞區號：</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="地址">
                </div>
            </div>
            <div class="row mt-4 justify-content-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-success" id="recipient" name="recipient">新增收件人</button>
                </div>
            </div>
        </form>
        <hr>
<!-- 收件人表格 -->
<table class="table">
  <thead class="table-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">收件人</th>
        <th scope="col">電話</th>
        <th scope="col">地址</th>
    </tr>
  </thead>
  <tbody>
    <!-- 插入收件人資訊到表單中 -->
     <?php while($data=$addbook_rs->fetch()) { ?>
    <tr>
        <th scope="row"><input type="radio" name="gridRadios" id="gridRadios[]" value="<?php echo $data['addressid'] ?>" <?php echo ($data['setdefault']) ? 'checked':'';?>>
        </th>
        <td><?php echo $data['cname']; ?></td>
        <td><?php echo $data['mobile']; ?></td>
        <td><?php echo $data['myZip'].$data['ctName'].$data['toName'].$data['address']; ?></td>

    </tr>
    <?php }?>
    
  </tbody>
</table>

      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>
<!-- the end of bootstrap Modal -->
<!-- start of loading page -->
<div id="loading" name="loading" style="display:none; position:fixed; width:100%; height:100%; top:0; left:0; background-color:rgba(255,255,255,.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>

 
</body>
</html>

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
    //取得縣市代碼後查詢鄉鎮市的名稱
    $("#myCity").change(function(){
      var CNo=$('#myCity').val();
      if(CNo==""){
        return false;
      }
      $('#myZip').val("");
      $('#add_label').html("郵遞區號：")
      $.ajax({
        // 將鄉鎮市的名稱從後台取回
        url:'Town_ajax.php',
        type:'post',
        data:{
          CNo:CNo,
        },
        success:function(data){
          if(data.c==true){
            $('#myTown').html(data.m);
            
          }else{
            alert("資料庫回傳錯誤"+data.m)
          }
        },
        error:function(data){
          alert("系統目前無法連接到後台資料庫")
        }
      })
    });
    // 取得鄉鎮代碼，查詢郵遞區號放入#myZip,#zipcode
    $("#myTown").change(function(){
      var AutoNo=$('#myTown').val();
      if(AutoNo==''){
        $('#myZip').val("");
        $('#add_label').html("");
        return false;
      }
      $.ajax({
        url:'Zip_ajax.php',
        type:'get',
        dataType:'json',
        data:{
          AutoNo:AutoNo,
        },
        success:function(data){
          if(data.c==true){
            $('#myZip').val(data.Post);
            $('#add_label').html('郵遞區號：'+data.Post +data.Cityname+data.Name);
          }else{
            alert("伺服器回傳錯誤:"+data.m);
          }
        },
        error:function(data){
          alert("系統目前無法連結到後台資料庫");
        }
      });
    });
  })
  // 新增收件人程式
  $('#recipient').click(function(){
    var validate=0,
    msg="";
    var cname=$("#cname").val();
    var mobile=$("#mobile").val();
    var myZip=$("#myZip").val();
    var address=$("#address").val();
    if(cname==""){
      msg=msg+"收件人不得為空白！;\n";
      validate=1;
    }
    if(mobile==""){
      msg=msg+"電話不得為空白！;\n";
      validate=1;
    }
    var checkphone=/^[0]{1}[9]{1}[0-9]{8}$/;
    if(checkphone.test(mobile)==false){
      msg=msg+"電話格式有誤！;\n";
      validate=1;
    }
    if(myZip==""){
      msg=msg+"郵遞區號不得為空白！；\n";
      validate=1;
    }
    if(address==""){
      msg=msg+"地址不得為空白！;\n";
      validate=1;
    }
    if(validate){
      alert(msg);
      return false
    }
    $.ajax({
      url:'addbook.php',
      type:'post',
      dataType:'json',
      data:{
        cname:cname,
        mobile:mobile,
        myZip:myZip,
        address:address,
      },
      success:function(data){
        if(data.c==true){
          alert(data.m);
          window.location.reload();
        }else{
          alert("資料庫回應錯誤："+data.m);
        }
      },
      error:function(data){
        alert("系統無法與資料庫建立連線，請聯絡管理員")
      }
    });
  });
  // 更新收件人處理程序
  $('input[name=gridRadios]').change(function(){
    var addressid=$(this).val();
    $.ajax({
      url:'changeaddr.php',
      type:'post',
      dataType:'json',
      data:{
        addressid:addressid,
      },
      success:function(data){
        if(data.c==true){
          alert(data.m);
          window.location.reload();
        }else{
          alert("伺服器傳回錯誤："+data.m)
        }
      },
      error:function(data){
        alert("ajax傳送錯誤")
      }
    })
  })

  //系統進行結帳處理
  $('#btn04').click(function(){
    let msg="系統將進行結帳處理，請確認產品金額與收件人是否正確！";
    if(!confirm(msg)) return false;
    $("#loading").show();
    var addressid=$('input[name=gridRadios]:checked').val();
    var shippingid = <?php echo $shipping['shipping_id'] ?? 0; ?>;
    $.ajax({
      url:'addorder.php',
      type:'post',
      dataType:'json',
      data:{
        addressid:addressid,
        shippingid:shippingid
      },
      success:function(data){
        if(data.c==true){
          alert(data.m);
          window.location.href="index_p01.php";
        }else{
          alert("資料庫回傳錯誤："+data.m);
          $("#loading").hide();
        }
      },
      error:function(data){
        alert("ajax請求錯誤");
        $("#loading").hide();
      }
    });
  });
</script>



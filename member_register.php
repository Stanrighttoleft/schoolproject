<!-- if session not start then start it -->
<?php (!isset($_SESSION))? session_start(): ""; ?>
<!-- import the database -->
<?php require_once('Connections/conn_db.php');?>
<!-- import common PHP function -->
<?php require_once("php_lib.php"); ?>
<!-- login path setting -->




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
<style>
  .input-group>.form-control{
    width: 100%;
  }
  span.error-tips,span.error-tips::before{
  font-family:"Font Awesome 5 Free";
  color: red;
  font-weight: 900;
  content: "\f0c4";
  }
  span.valid-tips,span.valid-tips::before{
    font-family: "Font Awesome 5 Free";
    color: greenyellow;
    font-weight: 900;
    content: "\f00c";
  }
</style>
  <body class="position-relative" style="background-image:radial-gradient(rgba(250,200,100,0.5),rgba(255,255,255,0.8));">
  <!-- whole page absolute item -->
   <?php require_once("./page_deco.php") ?>

<div class="wrapper container-fluid">
<section id="header" style="position: sticky;top:0; z-index:3;" >
  <!-- navigation -->
  <?php require_once("navbar.php") ?>
</section>

<!-- send form and register the data to database -->
<?php
if(isset($_POST['formct']) && $_POST['formct']=='reg'){
  $email=$_POST['email'];
  $pw1=md5($_POST['pw1']);
  $cname=$_POST['cname'];
  $tssn=$_POST['tssn'];
  $birthday=$_POST['birthday'];
  $mobile=$_POST['mobile'];
  $myZip=$_POST['myZip']=='' ? NULL:$_POST['myZip'];
  $address=$_POST['address']==''? NULL:$_POST['address'];
  $imgname=$_POST['uploadname']==''?'avatar.svg': $_POST['uploadname'];
  $insertsql="INSERT INTO member (email,pw1,cname,tssn,birthday,imgname) VALUES ('".$email."','".$pw1."','".$cname."','".$tssn."','".$birthday."','".$imgname."')";
  $Result=$link->query($insertsql);
  if($Result){
    $emailid=$link->lastInsertId(); //新增會員編號
    $insertsql="INSERT INTO addbook (emailid,setdefault,cname,mobile,myzip,address) VALUES('".$emailid."','1','".$cname."','".$mobile."','".$myZip."','".$address."')"; //將會員的姓名、電話地址寫入addbook
    $result=$link->query($insertsql);
    $_SESSION['login']=true; //設定會員註冊完直接登入，資料存SESSION
    $_SESSION['emailid']=$emailid;
    $_SESSION['email']=$email;
    $_SESSION['cname']=$cname;
    $_SESSION['imgname']=$imgname;
    echo "<script>alert('謝謝您，會員資料已完成註冊'); location.href='./index_p01.php';</script>";
  }else{
    echo "<script>alert('註冊失敗，請重新註冊並連絡管理員。');location.href='./member_register.php';</script>";
  }
  
}
?>

<section id="productcontent">
  <div class="container-fluid">
      <div class="row align-items-start g-0 d-flex flex-row" style="height:200vh;">
          <div class="col-md-3" >
            <!-- sidebar -->
              <?php require_once("./sidebar.php") ?>
          </div>
          <div class="col-md-9" >
            <!-- Member register form -->
            <div class="shadow-sm rounded-3 ms-3" style="background-color:rgba(255,255,255,0.8);" >
              <div class="row mt-3">
                <div class="col-12 text-center">
                  <h1 class="mt-5">會員註冊</h1>
                  <p>請輸入相關資料，*為必填欄位</p>
                  <hr class="my-5">
                </div>
              </div>
              <div class="row">
                <div class="col-8 offset-2 text-left">
                  <form action="member_register.php" method="POST" name="reg" id="reg">
                    <div class="input-group mb-4">
                      <label for="email" class="form-label">會員信箱(將用作登入帳號)：</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="請輸入email帳號" autocomplete="off">
                    </div>
                    <div class="input-group mb-4">
                      <label for="email" class="form-label">密碼：</label>
                      <input type="password" name="pw1" id="pw1" class="form-control" placeholder="請輸入密碼" >
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" name="pw2" id="pw2" class="form-control" placeholder="請再次確認密碼">
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" name="cname" id="cname" class="form-control" placeholder="請輸入姓名">
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" name="tssn" id="tssn" class="form-control" placeholder="請輸入身份證字號">
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" name="birthday" id="birthday" onfocus="(this.type='date')" class="form-control" placeholder="請選擇生日">
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" name="mobile" id="mobile"  class="form-control" placeholder="請輸入手機號碼">
                    </div>
                    <div class="input-group mb-3">
                      <select name="myCity" id="myCity" class="form-control">
                        <option value="">請選擇市區</option>
                        <?php $city="SELECT * FROM city WHERE State=0";
                        $city_rs=$link->query($city);
                        while($city_rows=$city_rs->fetch()){?>
                          <option value="<?php echo $city_rows['AutoNo']; ?>"><?php echo $city_rows['Name']; ?></option>
                        <?php } ?>
                      </select><br>
                    </div>
                    <div class="input-group mb-3">
                      <select name="myTown" id="myTown" class="form-control">
                        <option value="">請選擇地區</option>
                      </select>
                    </div>
                    <label for="address" class="form-label" id="zipcode" name="zipcode">郵遞區號：地址</label>
                    <div class="input-group mb-3">
                      <input type="hidden" name="myZip" id="myZip" value="">
                      <input type="text" name="address" id="address" class="form-control" placeholder="請須入後續地址">
                    </div>
                    <label for="fileToUpload" class="form-label">上傳相片：</label>
                    <div class="input-group mb-3">
                      <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" title="請上傳圖片" accept="image/x-png,image/jpeg,image/git,image/jpg"/>
                      
                      <button class="btn btn-danger" id="uploadForm" name="uploadForm">開始上傳</button>
  
                      <!-- bootstrap progress bar -->
                       <div id="progress-div01" class="progress" style="width:100%;display:none;">
                        <div id="progress-bar01" class="progress-bar progress-bar" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%
  
                        </div>
                       </div>
  
                       <input type="hidden" name="uploadname" id="uploadname" value=""/>
                       <img src="" alt="photo" name="showimg" id="showimg" style="display:none;" class="img-fluid">
                    </div>
                    <div class="input-group mb-3">
                    <div class="input-group">
                      <input type="hidden" name="captcha" id="captcha" value="">
                      <a href="javascript:void(0);" title="按我更新認證" onclick="getCaptcha();">
                        <canvas id="can"></canvas>
                      </a>
                    </div> 
                    </div>
                    <input type="text" name="recaptcha" id="recaptcha" class="form-control" placeholder="請輸入驗證碼">
                    <input type="hidden" name="formct" id="formct" value="reg">
                    <div class="input-group mb-3 mt-3">
                      <button type="submit" class="btn btn-success btn-lg">送出</button>
                    </div>
  
                  </form>
                </div>
              </div>
            </div>


             
          </div>
      </div>
  </div>
</section>

<section id="footer" >
<?php
require_once('./footer.php')
?>
</section>
<!-- loading page while loading -->
 <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,0.5);z-index:10;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>


      
</div>
</body>
</html>

    
<!--plugin section  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./js/jslib.js"></script>
<script src="./js/commlib.js"></script>
<script src="./js/jquery.validate.js"></script>

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


  $(function(){
    //取得縣市代碼後查詢鄉鎮市的名稱
    $("#myCity").change(function(){
      var CNo=$('#myCity').val();
      if(CNo==""){
        return false;
      }
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
            $('#myZip').val("");
          }else{
            alert(data.m)
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
            $('#zipcode').html(data.Post +data.Cityname+data.Name);
          }else{
            alert(data.m);
          }
        },
        error:function(data){
          alert("系統目前無法連結到後台資料庫");
        }
      });
    });
  })
</script>


<script>
  // 亂數產生驗證內容
  function getCaptcha(){
    var inputTxt=document.getElementById("captcha");
    //can為canvas的ID名稱
    // 150=影像寬,50=影像高,blue是影像背景顏色
    // white=文字顏色,28px=文字大小，5=認證碼長度
    inputTxt.value=captchaCode("can",150,50,"blue","white","28px",5);
  }
  // 取得元素ID
  function getId(el){
    return document.getElementById(el);
  }
  // 圖示上傳處理
  $("#uploadForm").click(function(e){
    var fileName=$('#fileToUpload').val();
    var idxDot=fileName.lastIndexOf(".")+1;
    let extFile=fileName.substr(idxDot,fileName.length).toLowerCase();
    if(extFile=="jpg" || extFile=="jpeg" || extFile=="png" || extFile=="gif"){
      $('#progress-div01').css("display","flex");
      let file1=getId("fileToUpload").files[0];
      let formdata=new FormData();
      formdata.append("file1",file1);
      let ajax=new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler,false);
      ajax.addEventListener("error",errorHandler,false);
      ajax.addEventListener("abort",abortHandler,false);
      ajax.open("POST", "file_upload_parser.php");
      ajax.send(formdata);
      return false
    }else{
      alert('目前只支援jpg,jpeg,png,gif檔案格式上傳!');
    }
  });
  // 上傳過程顯示百分比
  function progressHandler(event){
    let percent=Math.round((event.loaded/event.total)*100);
    $("#progress-bar01").css("width",percent+"%");
    $("#progress-bar01").html(percent+"%");
  }
  // 上傳完成處理顯示圖片
  function completeHandler(event){
    let data=JSON.parse(event.target.responseText);
    if(data.success=='true'){
      $('#uploadname').val(data.fileName);
      $('#showimg').attr({
        'src':'uploads/'+data.fileName,
        'style':'display:block;'
      });
    }else{
      alert(data.error);
    }
  }
  // Upload failed:上傳發生錯誤處理
  function errorHandler(event){
    alert("Upload Failed:上傳發生錯誤");
  }
  // Upload Aborted:上傳作業取消處理
  function abortHandler(event){
    alert("Uload Aborted:上傳作業取消");
  }
  // 自訂身分證格式驗證
  jQuery.validator.addMethod("tssn",function(value,element,param){
    var tssn=/^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
    return this.optional(element) || (tssn.test(value));
  });
  // 自訂手機格式驗證
  jQuery.validator.addMethod("checkphone",function(value,element,param){
    var checkphone=/^[0]{1}[9]{1}[0-9]{8}$/;
    return this.optional(element) || (checkphone.test(value));
  });
  // 自訂郵遞區號驗證
  jQuery.validator.addMethod("checkMyTown",function(value,element,param){
    return (value !== "");
  });
  // 啟動驗證功能
  $(function(){
    getCaptcha();
  })
  // 驗證form #reg表單
  $('#reg').validate({
    rules:{
      email:{
        required:true,
        email:true,
        remote:'checkemail.php'
      },
      pw1:{
        required:true,
        maxlength:20,
        minlength:4,
      },
      pw2:{
        required:true,
        equalTo:'#pw1'
      },
      cname:{
        required:true,
      },
      tssn:{
        required:false,
        tssn:true,
      },
      birthday:{
        required:true,
      },
      mobile:{
        required:true,
        checkphone:true,
      },
      address:{
        required:true,
      },
      myTown:{
        checkMyTown:true,
      },
      recaptcha:{
        required:true,
        equalTo:'#captcha',
      },
    },
    messages:{
      email:{
        required:'email信箱不能空白',
        email:'email信箱格式有誤',
        remote:'email信箱已經註冊'
      },
      pw1:{
        required:'密碼不得為空白',
        maxlength:'密碼最大長度為20位(4-20位英文字母與數字的組合)',
        minlength:'密碼最小長度為4位(4-20位英文字母與數字的組合)',
      },
      pw2:{
        required:'確認密碼不得為空白',
        equalTo:'兩次輸入的密碼必須一致！',
      },
      cname:{
        required:'使用者名稱不得為空白',
      },
      tssn:{
        required:'身份證ID不得為空白',
        tssn:'身份證ID格式有誤',
      },
      birthday:{
        required:'生日不得為空白',
      },
      mobile:{
        required:'手機號碼不得為空白',
        checkphone:'手機號碼格式有誤',
      },
      address:{
        required:'地址不得為空白',
      },
      myTown:{
        checkMyTown:'需選擇郵遞區號',
      },
      recaptcha:{
        required:'驗證碼不得為空白！',
        equalTo:'驗證碼需相同！',
      },
    },
  });
</script>



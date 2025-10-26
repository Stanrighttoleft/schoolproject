// 加入購物車城市
function addcart(p_id) {
  var qty = $("#qty").val();
  if (qty <= 0) {
    alert("產品數量不能為零或負數!");
    return false;
  }
  if (qty == undefined) {
    qty = 1;
  } else if (qty >= 20) {
    alert("大宗採購請直接連絡我們，請不要在網路下單!謝謝!");
    return false;
  }
  //use jquery ajax call the backend addcart.php
  $.ajax({
    url: "addcart.php",
    type: "get",
    dataType: "json",
    data: { p_id: p_id, qty: qty },
    success: function (data) {
      if (data.c == "1") {
        alert(data.m);
        window.location.reload();
      } else {
        alert(data.m);
      }
    },
    error: function (data) {
      alert("無法連線");
    },
  });
}

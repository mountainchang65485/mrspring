<?php
$errMsg="";

try{
  require_once("connectBooks.php");

  $sql = "SELECT * FROM `coupon`";
  
  $coupon = $pdo->query($sql);//下指令

  //如果找得資料，取回資料，送出xml文件
  
}catch(PDOException $e){
  $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
  $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
}

$arrCoupon = [];
while($coupons = $coupon->fetch(PDO::FETCH_ASSOC)){
    $arrCoupon[] = $coupons;
}
echo json_encode($arrCoupon);
?>
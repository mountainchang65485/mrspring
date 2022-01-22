<?php

ob_start();
session_start();
$errMsg="";

try{
  require_once("connectBooks.php");
  $sql = "INSERT INTO `membercoupon` VALUE (null, :couponNo, :memNo, (select curdate()), 1)";
  
  $coupon = $pdo->prepare($sql);//下指令
  
  $coupon -> bindValue(":couponNo", $_REQUEST["couponNo"]);
  $coupon -> bindValue(":memNo",$_SESSION["memNo"]); //session
  
  $coupon->execute();  
  
}catch(PDOException $e){
  $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
  $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
  echo $errMsg;
}

?>
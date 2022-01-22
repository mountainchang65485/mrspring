<?php
$errMsg="";

try{
  require_once("connectBooks.php");

  $sql = "SELECT * FROM `item` natural join `effectType` where itemTime=0 order by `itemNo`";
  
  $herbs = $pdo->query($sql);//下指令

  //如果找得資料，取回資料，送出xml文件
  
}catch(PDOException $e){
  $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
  $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
}

$arr = [];
while($herb = $herbs->fetch(PDO::FETCH_ASSOC)){
    $arr[] = $herb;
}
echo json_encode($arr);
?>
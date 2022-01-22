<?php
	 require_once("connectBooks.php");

try{
  //機器人下方標籤
  // SELECT * FROM `keyword` WHERE `keywordTagStatus` != 0
  $sql_keywordTagStatus = "select keywordName from keyword where keywordStatus != 0 and keywordTagStatus != 0";
  $keywordTagStatus = $pdo->query( $sql_keywordTagStatus );
  $keywordTagStatusRows = $keywordTagStatus->fetchAll(PDO::FETCH_NUM);
  $jsonStr_keywordTagStatus = json_encode($keywordTagStatusRows);
  echo ($jsonStr_keywordTagStatus);
  

}catch(PDOException $e){
  echo $e->getMessage();
}
?>
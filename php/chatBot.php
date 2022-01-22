<?php
	 require_once("connectBooks.php");  

try{
  $sql = "select replytext from reply
  where keywordno = (select keywordno from keyword where keywordname LIKE :userkey)";
  $member = $pdo->prepare( $sql );
  $member->bindValue(":userkey", "%{$_REQUEST["chatBot"]}%");
  $member->execute();
  
  if( $member->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo json_encode("給我重打");
  }else{ //找得到
    //取回一筆資料
    $memRow = $member->fetch(PDO::FETCH_NUM); 
    //PDO::FETCH_ASSOC
    //{"no":"1","memName":"\u8463\u8463","memId":"Sara","memPsw":"111","email":"i750307@iii.org.tw","sex":"0","birthday":"1960-08-08","tel":"03-4257383"}

    //PDO::FETCH_NUM
    //["1","\u8463\u8463","Sara","111","i750307@iii.org.tw","0","1960-08-08","03-4257383"]
    
    //送出json字串
    echo json_encode($memRow);
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
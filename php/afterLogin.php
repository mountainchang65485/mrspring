<?php
session_start();
try{
  require_once("connectBooks.php");
  $sql = "select * from member where memId=:memId and memPsw=:memPsw";
  $member = $pdo->prepare( $sql );
  $member -> bindValue(":memId", $_POST["memId"]);
  $member -> bindValue(":memPsw", $_POST["memPsw"]);
  // $member -> bindValue(":memImgUrl", $_POST["memImgUrl"]);
  $member ->execute();

  if( $member->rowCount() == 0 ){//查無此帳號
  	echo "notFound";
  }else{
  	$memRow = $member->fetch(PDO::FETCH_ASSOC);
  	//寫session
    
    $_SESSION["memNo"] = $memRow["memNo"];
    $_SESSION["memId"] = $memRow["memId"];
    $_SESSION["memFirstName"] = $memRow["memFirstName"];
    $_SESSION["memLastName"] = $memRow["memLastName"];
    $_SESSION["memNickname"] = $memRow["memNickname"];
    $_SESSION["twId"] = $memRow["twId"];
    $_SESSION["memTel"] = $memRow["memTel"];
    $_SESSION["memEmail"] = $memRow["memEmail"];
    $_SESSION["memImgUrl"] = $memRow["memImgUrl"];
    $_SESSION["memStatus"] = $memRow["memStatus"];
    
    
    echo $_SESSION["memImgUrl"];

  }

}catch(PDOException $e){
  echo "error";
}


// $arr = [];
// while($memInfo = $member->fetch(PDO::FETCH_ASSOC)){
//     $arr[] = $memInfo;
// }
// echo json_encode($arr);
?>
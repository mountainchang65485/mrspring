<?php
$errMsg = "";
try{
	require_once("j_connect.php");
	$sql = "INSERT INTO message (mesNo, artNo, memNo, mesText, mesTime) 
			VALUES (NULL, :artNo, :memNo, :mesText, now());";

	$mes_add = $pdo -> prepare($sql);
	$mes_add -> bindValue(":artNo", $_REQUEST["artNo"]);
	$mes_add -> bindValue(":memNo", $_SESSION["memNo"]);
	$mes_add -> bindValue(":mesText", $_REQUEST["mesText"]);
	// $mes_add -> bindValue(":artTime", date("Y-m-d H:i:s"));
	$mes_add -> execute();


	$sql = "update article
			set artMesCount=artMesCount+1
			where artNo=".$_REQUEST["artNo"].";";
	$artMesCount =  $pdo -> query($sql);


	header("Location: ../forum_article.php?artNo={$_REQUEST['artNo']}");
  	
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}
echo $errMsg;

?>
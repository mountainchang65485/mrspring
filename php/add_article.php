<?php 
$errMsg = "";
try{
  require_once("j_connect.php");
	$sql_insert = "insert into article (artNo, artTitle, memNo, artText, artTime, cardNo) 
			VALUES (null, :artTitle,:memNo, :artText, now(), :cardNo);";
	$art_add = $pdo -> prepare($sql_insert);
	$art_add -> bindValue(":artTitle",$_REQUEST['article_title']);
	$art_add -> bindValue(":memNo",$_SESSION["memNo"]);
	$art_add -> bindValue(":artText",$_REQUEST['article_text']);
	// $art_add -> bindValue(":artTime",date("Y-m-d H:i:s"));
	$art_add -> bindValue(":cardNo",$_REQUEST['cardNO']);
	$art_add -> execute();
	header('Location: ../forum.php');


}catch(PDOException $e){
	$errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
	$errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}



?>
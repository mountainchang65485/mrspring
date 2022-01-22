<?php 
$errMsg = "";
try{
	require_once("j_connect.php");
	
	$sql = "
			update article 
			set artTitle = :artTitle ,artText = :artText,cardNo = :cardNo,artTime=:artTime
			where artNo = :artNo;
			";


	$artUpdate = $pdo->prepare( $sql );
	$artUpdate->bindValue(":artTitle", $_REQUEST["artTitle"]);
	$artUpdate->bindValue(":artText", $_REQUEST["artText"]);
	$artUpdate->bindValue(":cardNo", $_REQUEST["cardNo"]);
	$artUpdate->bindValue(":artNo", $_REQUEST["artNo"]);
	$artUpdate->bindValue(":artTime",date("Y-m-d H:i:s"));
	$artUpdate->execute();
	echo $_REQUEST['artNo']."<br>";
	echo $_REQUEST['cardNo']."<br>";
	echo $_REQUEST['artTitle']."<br>";
	echo $_REQUEST['artText']."<br>";
	echo date("Y-m-d H:i:s")."<br>"; 

	header('Location: ../forum_article.php?artNo='.$_REQUEST['artNo']);
	

}catch(PDOException $e){
	$errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
	$errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}



?>
<?php 
$errMsg = "";
try{
	require_once("j_connect.php");
	
	$sql = "
            update message 
            set mesText = :mesText,mesTime=:mesTime
            where mesNo = :mesNo;
            ";

    $mesUpdate = $pdo->prepare( $sql );
    $mesUpdate->bindValue(":mesNo", $_REQUEST["mesNo"]);
    $mesUpdate->bindValue(":mesText", $_REQUEST["mesText"]);
	$mesUpdate->bindValue(":mesTime",date("Y-m-d H:i:s"));
    $mesUpdate->execute();


	header('Location: ../forum_article.php?artNo='.$_REQUEST['artNo']);


}catch(PDOException $e){
	$errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
	$errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}



?>
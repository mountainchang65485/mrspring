<?php 
$errMsg = "";
try{
	require_once("j_connect.php");
	
	$sql = "
            DELETE FROM message 
            WHERE mesNo = ".$_REQUEST['mesNo'].";
            ";

    $delmes = $pdo->exec($sql);
    
    $sql = "
            update  article
            set artMesCount = artMesCount-1
            where artNo = ".$_REQUEST['artNo'].";
            ";
    echo $_REQUEST['artNo'];

    $delmes = $pdo->exec($sql);
	header('Location: ../forum_article.php?artNo='.$_REQUEST['artNo']);


}catch(PDOException $e){
	$errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
	$errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}



?>
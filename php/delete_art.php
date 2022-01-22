<?php 
$errMsg = "";
try{
	require_once("j_connect.php");    
    $sql = "
            update  article
            set artStatus = 0
            where artNo = ".$_REQUEST['artNo'].";
            ";
    echo $_REQUEST['artNo'];

    $delmes = $pdo->exec($sql);
	header('Location: ../forum.php');


}catch(PDOException $e){
	$errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
	$errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}



?>
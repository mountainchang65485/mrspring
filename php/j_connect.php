<?php
try {
$errMsg = "";
	session_start();
	require_once("connectBooks.php");
	// $_SESSION['memNo']=2;
	// $_SESSION['memNickname']="JJ";

} catch (PDOException $e) {
	$errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
	$errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
}


?>

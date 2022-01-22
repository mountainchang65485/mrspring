<?php
try {
	$dsn = "mysql:host=localhost;port=3306;dbname=cd106g4;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);

	$pdo = new PDO($dsn, $user, $password, $options);  

	session_start();
    // $_SESSION["memNo"] = $memRow["no"];
    $_SESSION["memId"] = "hsujie";
    $_SESSION["memName"] = "hsujie";

} catch (PDOException $e) {
	$errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
	$errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
}


?>      
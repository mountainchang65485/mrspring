<?php
	$dsn = "mysql:host=localhost;port=3306;dbname=cd106g4;charset=utf8";
	$user = "cd106g4";
	$password = "cd106g4";
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO( $dsn, $user, $password, $options);  
?>
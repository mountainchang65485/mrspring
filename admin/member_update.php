<?php
require_once("Pancake_connectbooks.php");  

    $sql =  "UPDATE member set ";

    $sql.=" memStatus = ".$_REQUEST['memStatus'];    
    $sql.=" where memNo = '".$_REQUEST['memNo']."'";
    
    echo $sql;
    $pdo->exec($sql);        


header('Location: admin_member.php');
?>
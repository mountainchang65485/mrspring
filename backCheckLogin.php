<?php
    require_once("php/connectBooks.php"); 
    $sql = "select * from manager where managerId = '".$_GET["mgrId"]."' and managerPsw = '".$_GET["mgrPsw"]."';";
    $check = $pdo->query($sql); 

    if($check->rowCount() == 0){
        echo "error";
    }else{
        echo "成功登入";
    }

?>
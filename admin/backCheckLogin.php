<?php
    require_once("Pancake_connectbooks.php");  
    $sql = "select * from manager where managerId = '".$_GET["mgrId"]."' and managerPsw = '".$_GET["mgrPsw"]."';";
    $check = $pdo->query($sql); 

    if($check->rowCount() == 0){
        echo "error";
    }else{
        echo "成功登入";
    }

?>
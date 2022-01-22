<?php
    $errMsg="";

    try {
        require_once("connectBooks.php");
        $sql = "select * from branch";
        $branchs = $pdo->query($sql);//下指令
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    $arr = [];
    while($branch = $branchs->fetch(PDO::FETCH_ASSOC)){
        $arr[] = $branch;
    }
    echo json_encode($arr);
?>
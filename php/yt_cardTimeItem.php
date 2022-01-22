<?php
    $errMsg="";

    try {
        require_once("connectBooks.php");
        $sql = "select * from item where itemNo = (select cardTimeItem from card where cardNo = {$_REQUEST["cardNo"]})";
        $items = $pdo->query($sql);//下指令
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    if($items->rowCount() == 0){
        echo json_encode("notFound");
    }else{
        $itemRow = $items->fetch(PDO::FETCH_ASSOC);
        echo json_encode($itemRow);
    }
    
?>
<?php
    $errMsg="";

    try {
        require_once("connectBooks.php");
        $sql = "select * from card join effectType USING (effectTypeNo) where cardNo = {$_REQUEST["cardNo"]}";
        $cardInfo = $pdo->query($sql);//下指令
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    if($cardInfo->rowCount() == 0){
        echo json_encode("notFound");
    }else{
        $cardInfoRow = $cardInfo->fetch(PDO::FETCH_ASSOC);
        echo json_encode($cardInfoRow);
    }
    
?>
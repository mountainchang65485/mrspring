<?php
    $errMsg="";

    try {
        require_once("connectBooks.php");
        $sql = "select * from reservation natural join branch where reserDate = :reserDate and branchName = :branchName";
        $result = $pdo->prepare($sql);//下指令
        $result->bindValue(":branchName",$_REQUEST["roomvalue"]);
        $result->bindValue(":reserDate",$_REQUEST["datevalue"]);
        $result->execute();
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    $arr = [];
    while($resultRow = $result->fetch(PDO::FETCH_ASSOC)){
        $arr[] = $resultRow;
    }
    echo json_encode($arr);
?>
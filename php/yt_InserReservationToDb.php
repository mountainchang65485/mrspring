<?php
    $errMsg="";

    try {
        require_once("connectBooks.php");
        $sql = "select branchNo from branch where branchName = :branchName";
        $branch = $pdo->prepare($sql);//下指令
        $branch->bindValue(":branchName",$_REQUEST["roomvalue"]);
        $branch->execute();
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    $branchRow = $branch->fetch(PDO::FETCH_ASSOC);
    $branchNo = $branchRow["branchNo"];
    
    if($_REQUEST["clockvalue"] == "morning"){
        $reserMorning = "1";
        $reserAfternoon = "0";
        $reserNight = "0";
    }elseif($_REQUEST["clockvalue"] == "afternoon"){
        $reserMorning = "0";
        $reserAfternoon = "1";
        $reserNight = "0";
    }elseif($_REQUEST["clockvalue"] == "night"){
        $reserMorning = "0";
        $reserAfternoon = "0";
        $reserNight = "1";
    }
    // echo $_REQUEST["datevalue"];

    try {
        require_once("connectBooks.php");
        $sql = "insert into reservation values (null,:branchNo,:reserDate,:reserMorning,:reserAfternoon,:reserNight)";
        $reser = $pdo->prepare($sql);//下指令
        $reser->bindValue(":branchNo",$branchNo);
        $reser->bindValue(":reserDate",$_REQUEST["datevalue"]);
        $reser->bindValue(":reserMorning",$reserMorning);
        $reser->bindValue(":reserAfternoon",$reserAfternoon);
        $reser->bindValue(":reserNight",$reserNight);
        $reser->execute();
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }
?>
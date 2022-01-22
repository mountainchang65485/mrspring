<?php

session_start();
$errMsg="";

    try{
       require_once("php/connectBooks.php");
        $sql="UPDATE article set artStatus=0 where memNo = :memNo and artNo = :artNo";

        $memNo = $_REQUEST['memNo'];
        $artNo = $_REQUEST['artNo'];

        $artStatus = $pdo ->prepare($sql);
        $artStatus -> bindValue(":memNo",$memNo);
        $artStatus -> bindValue(":artNo",$artNo);
        $artStatus -> execute();

        // header("Location: member.php");

        
       
    }catch(PDOException $e){
            $errMsg = "錯誤原因" . $e -> getMessage() . "<br>" ;
            $errMsg .= "錯誤行號" . $e -> getLine() . "<br>" ;

    }
<?php

session_start();
$errMsg="";

    try{
        require_once("php/connectBooks.php");
        $sql="UPDATE card set cardStatus=0 where memNo = :memNo and cardNo = :cardNo" ;

        $memNo = $_REQUEST['memNo'];
        $cardNo = $_REQUEST['cardNo'];

        $artStatus = $pdo ->prepare($sql);
        $artStatus -> bindValue(":memNo",$memNo);
        $artStatus -> bindValue(":cardNo",$cardNo);
        $artStatus -> execute();

        // header("Location: member.php");

        
       
    }catch(PDOException $e){
            $errMsg = "錯誤原因" . $e -> getMessage() . "<br>" ;
            $errMsg .= "錯誤行號" . $e -> getLine() . "<br>" ;

    }

    ?>
<?php
ob_start();
session_start();

try{
    require_once("php/connectBooks.php");  

    // json解碼
    $newCardInfo = json_decode($_REQUEST["jsonStr"]);
    
    // 取得湯牌數量
    $sql = "select count(*) from card";
    $countNum = $pdo->query($sql);
    $count = $countNum->fetch();
    $countPlus = $count[0]+1;

    // 湯牌基本資料
    $sql = "INSERT INTO card VALUES ( :cardNo, :cardName, :effecttypeNo, :memNo, :cardText, :cardFont, :cardTextColor1, :cardTextColor2, :cardTextColor3, :cardTextColor4, :cardTextColor5, :cardTextColor6, :cardPrice, :cardTimeItem, null, 1);";

    $newCard = $pdo->prepare($sql);
    $newCard->bindValue(":cardNo", $countPlus);
    $newCard->bindValue(":cardName", $newCardInfo->cardName);
    $newCard->bindValue(":effecttypeNo", $newCardInfo->effecttypeNo);

    // =====會員號=====
    $newCard->bindValue(":memNo", $_SESSION["memNo"]);
    // =====會員號=====

    $newCard->bindValue(":cardText", $newCardInfo->cardText);
    $newCard->bindValue(":cardFont", $newCardInfo->cardFont);
    $newCard->bindValue(":cardTextColor1", $newCardInfo->cardTextColor1);
    $newCard->bindValue(":cardTextColor2", $newCardInfo->cardTextColor2);
    $newCard->bindValue(":cardTextColor3", $newCardInfo->cardTextColor3);
    $newCard->bindValue(":cardTextColor4", $newCardInfo->cardTextColor4);
    $newCard->bindValue(":cardTextColor5", $newCardInfo->cardTextColor5);
    $newCard->bindValue(":cardTextColor6", $newCardInfo->cardTextColor6);
    $newCard->bindValue(":cardPrice", $newCardInfo->cardPrice);
    $newCard->bindValue(":cardTimeItem", $newCardInfo->cardTimeItem);

    $newCard -> execute();

    // 湯牌藥材們

    $sql = "INSERT INTO carditem1 VALUES(null, $countPlus, :item1);";
    $newCardItem1 = $pdo->prepare($sql);    
    $newCardItem1->bindValue(":item1", $newCardInfo->carditem1);
    $newCardItem1 -> execute();

    $sql = "INSERT INTO carditem2 VALUES(null, $countPlus, :item2);";
    $newCardItem2 = $pdo->prepare($sql);    
    $newCardItem2->bindValue(":item2", $newCardInfo->carditem2);
    $newCardItem2 -> execute();

    $sql = "INSERT INTO carditem3 VALUES(null, $countPlus, :item3);";
    $newCardItem3 = $pdo->prepare($sql);    
    $newCardItem3->bindValue(":item3", $newCardInfo->carditem3);
    $newCardItem3 -> execute();

    $sql = "INSERT INTO carditem4 VALUES(null, $countPlus, :item4);";
    $newCardItem4 = $pdo->prepare($sql);    
    $newCardItem4->bindValue(":item4", $newCardInfo->carditem4);
    $newCardItem4 -> execute();

    }catch(PDOException $e){
    echo $e->getMessage();
}
?>
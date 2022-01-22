<?php
    ob_start();
    session_start();

    $errMsg="";
    $OrderInfo = json_decode($_REQUEST["jsonStr"]);
    $memNo = $_SESSION["memNo"];//會員編號

    try {
        require_once("connectBooks.php");
        $sql = "select branchNo from branch where branchName = :branchName";
        $branch = $pdo->prepare($sql);//下指令
        $branch->bindValue(":branchName",$OrderInfo->branchNo);
        $branch->execute();
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    $branchRow = $branch->fetch(PDO::FETCH_ASSOC);
    $branchNo = $branchRow["branchNo"];//分店編號

    if($OrderInfo->orderResTime == "morning"){
        $orderResTime = 1;//入住時段
    }elseif($OrderInfo->orderResTime == "afternoon"){
        $orderResTime = 2;
    }elseif($OrderInfo->orderResTime == "night"){
        $orderResTime = 3;
    }

    //判斷有沒有使用優惠券
    if($OrderInfo->couponNo == ""){
        $OrderInfo->couponNo = null;
    }else{
        try {
            require_once("connectBooks.php");
            $sql = "update membercoupon set memCouponStatus = 0 where memCouponNo = :memCouponNo";
            $couponUpdate = $pdo->prepare($sql);//下指令
            $couponUpdate->bindValue(":memCouponNo",$OrderInfo->memCouponNo);
            $couponUpdate->execute();
        } catch (PDOException $e) {
            $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
            $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
        }
    }
    
    // echo json_encode($OrderInfo->memCouponNo);
    
    try {
        require_once("connectBooks.php");
        $sql = "insert into orders values (null,now(),:orderResDate,:orderResTime,:memNo,:branchNo,:cardNo,:orderOldPrice,:orderNewPrice,:couponNo,1)";
        $affectedRow = $pdo->prepare($sql);//下指令
        $affectedRow->bindValue(":orderResDate",$OrderInfo->orderResDate);
        $affectedRow->bindValue(":orderResTime",$orderResTime);
        $affectedRow->bindValue(":memNo",$memNo);
        $affectedRow->bindValue(":branchNo",$branchNo);
        $affectedRow->bindValue(":cardNo",$OrderInfo->cardNo);
        $affectedRow->bindValue(":orderOldPrice",$OrderInfo->orderOldPrice);
        $affectedRow->bindValue(":orderNewPrice",$OrderInfo->orderNewPrice);
        $affectedRow->bindValue(":couponNo",$OrderInfo->couponNo);
        $affectedRow->execute();
        // echo json_encode("null,now(),{$OrderInfo->orderResDate},{$orderResTime},{$memNo},{$branchNo},{$OrderInfo->cardNo},{$OrderInfo->orderOldPrice},{$OrderInfo->orderNewPrice},{$OrderInfo->couponNo},1");
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }
?>
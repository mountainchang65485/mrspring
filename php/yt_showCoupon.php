<?php
    ob_start();
    session_start();

    $errMsg="";

    // $_SESSION["memNo"] = 1;

    try {
        require_once("connectBooks.php");
        $sql = "select * from member join membercoupon using (memNo) join coupon using (couponNo) where memNo = {$_SESSION["memNo"]} and memCouponStatus = 1";
        $coupons = $pdo->query($sql);//下指令
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    $arr = [];
    while($couponRow = $coupons->fetch(PDO::FETCH_ASSOC)){
        $arr[] = $couponRow;
    }
    echo json_encode($arr);
?>
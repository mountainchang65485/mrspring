<?php
require_once("Pancake_connectbooks.php");  

if(isset($_REQUEST["couponAdd"])){

    // 用''把是字串的欄位包起來!!
    $sql  = "INSERT INTO `coupon` (`couponNo`, `couponName`, `couponType`, `couponDiscount`, `couponLevel`, `couponStatus`) VALUES          (NULL, '{$_REQUEST['couponName']}', {$_REQUEST['couponType']}, {$_REQUEST['couponDiscount']}, {$_REQUEST['couponLevel']}, {$_REQUEST['couponStatus']})";

    echo $sql;

    $pdo->exec($sql);
}else{
    $sql =  "UPDATE coupon set ";

    $sql.="couponName = '".$_REQUEST['couponName'];
    $sql.="',";
    $sql.="couponType = '".$_REQUEST['couponType'];
    $sql.="',";
    $sql.="couponDiscount = '".$_REQUEST['couponDiscount'];
    $sql.="',";
    $sql.="couponLevel = '".$_REQUEST['couponLevel'];
    $sql.="',";
    $sql.="couponStatus = '".$_REQUEST['couponStatus'];
    $sql.="'";
    
    $sql.=" where couponNo = '".$_REQUEST['couponNo']."'";
    
    echo $sql;
    $pdo->exec($sql);        
}

header('Location: admin_coupon.php');

?>
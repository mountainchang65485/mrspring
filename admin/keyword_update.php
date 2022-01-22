<?php
require_once("Pancake_connectbooks.php");  

if(isset($_REQUEST["keywordAdd"])){

    // 用''把是字串的欄位包起來!!
    $sql  = "INSERT INTO `keyword` (`keywordNo`, `keywordName`, `keywordStatus`, `keywordTagStatus`) VALUES
              (NULL, '{$_REQUEST['keywordName']}', {$_REQUEST['keywordStatus']}, {$_REQUEST['keywordTagStatus']})";

    echo $sql;

    $pdo->exec($sql);
}else{
    $sql =  "UPDATE keyword set ";

    $sql.="keywordName = '".$_REQUEST['keywordName'];
    $sql.="',";
    $sql.="keywordStatus = ".$_REQUEST['keywordStatus'];
    $sql.=",";
    $sql.="keywordTagStatus = ".$_REQUEST['keywordTagStatus'];
    
    $sql.=" where keywordNo = '".$_REQUEST['keywordNo']."'";
    
    echo $sql;
    $pdo->exec($sql);        
}

header('Location: admin_robot_keyword.php');

?>
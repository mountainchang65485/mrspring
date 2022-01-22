<?php
require_once("Pancake_connectbooks.php");  

if(isset($_REQUEST["replyAdd"])){

    // 用''把是字串的欄位包起來!!
    $sql  = "INSERT INTO `reply` (`replyNo`, `replyText`, `keywordNo`) VALUES
              (NULL, '{$_REQUEST['replyText']}', {$_REQUEST['keywordNo']})";

    echo $sql;
    $pdo->exec($sql);

}elseif(isset($_REQUEST["delete"])){  
    $sql =  "DELETE FROM reply where replyNo = {$_REQUEST['replyNo']} ";
    
    echo $sql;
    $pdo->exec($sql); 
}else{     
    $sql =  "UPDATE reply set ";

    $sql.="replyText = '".$_REQUEST['replyText'];
    $sql.="',";
    $sql.="keywordNo = ".$_REQUEST['keywordNo'];
    
    $sql.=" where replyNo = ".$_REQUEST['replyNo'];
    
    echo $sql;
    $pdo->exec($sql);    
}

header('Location: admin_robot_reply.php');

?>
<?php
require_once("Pancake_connectbooks.php");  

if(isset($_REQUEST["artNo"])){

    // 用''把是字串的欄位包起來!!
    $sql  = "UPDATE article SET artStatus={$_REQUEST['artStatus']}
             where artNo = {$_REQUEST['artNo']}";

    $pdo->exec($sql);
}
header('Location: admin_forum.php');

?>
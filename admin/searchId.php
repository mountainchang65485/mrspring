<?php
    require_once("Pancake_connectbooks.php");  

    $sql = "SELECT * from member where memId like '%{$_REQUEST['memId']}%' order by memNo";

    $memSearchResult = $pdo->query($sql);

    $memSearchResultArr = $memSearchResult->fetchAll();

    echo json_encode($memSearchResultArr);
?>
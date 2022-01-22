<?php
session_start();
$_SESSION['consultantItems'] = array($_REQUEST['item1No'],$_REQUEST['item2No'],$_REQUEST['item3No'],$_REQUEST['item4No']);
// print_r($_SESSION['consultantItems']);
header('location:../custom.php');
?>
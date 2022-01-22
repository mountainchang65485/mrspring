<?php
require_once("Pancake_connectbooks.php");  

$sql =  "UPDATE question set ";

$sql.="quesText = '".$_REQUEST['quesText'];
$sql.="',";
$sql.="ans1Text = '".$_REQUEST['ans1Text'];
$sql.="',";
$sql.="ans1Score = ".$_REQUEST['ans1Score'];
$sql.=",";
$sql.="ans2Text = '".$_REQUEST['ans2Text'];
$sql.="',";
$sql.="ans2Score = ".$_REQUEST['ans2Score'];
$sql.=",";
$sql.="ans3Text = '".$_REQUEST['ans3Text'];
$sql.="',";
$sql.="ans3Score = ".$_REQUEST['ans3Score'];

// where之前不要加逗號
$sql.=" where quesNo = ".$_REQUEST['quesNo'];

echo $sql;
$pdo->exec($sql);        
header('Location: admin_question.php');

?>
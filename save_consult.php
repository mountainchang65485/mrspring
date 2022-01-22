<?php
    ob_start();
    session_start();
    
    $_SESSION["consultantItems"] = array($_REQUEST["medicineNo1"], $_REQUEST["medicineNo2"], $_REQUEST["medicineNo3"]);
    
    header('Location: custom.php');
?>
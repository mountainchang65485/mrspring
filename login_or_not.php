<?php
ob_start();
session_start();

if(isset($_SESSION["memNo"])){
    echo "1";
}else{
    echo "0";
};

?>

<?php
	try{
		require_once("Pancake_connectbooks.php");  
        $date = $_REQUEST['orderResDate'];
        $branch = $_REQUEST['branchNo'];
        $orderNo = $_REQUEST['orderNo'];
        $orderStatus = $_REQUEST['orderStatus'];
        $orderResTime = $_REQUEST['orderResTime'];
        
        if($orderResTime==1){
            $orderResTime = 'Morning';
        }else if($orderResTime==2){
            $orderResTime = 'Afternoon';
        }else{
            $orderResTime = 'Night';
        }
        
        $sql = "
            UPDATE `orders` SET orderStatus={$_REQUEST['orderStatus']}
            WHERE orderNo = {$_REQUEST['orderNo']}
        ";
        $sql2 = "
            select reserNo
            from reservation
            where reserDate = '{$date}' and branchNo = {$branch} and reser{$orderResTime} = 1
            order by reserNo asc
        ";
        echo $date."<br>";
        echo $branch."<br>";
        echo $orderResTime."<br>";
        echo $sql2."<br>";
        $order = $pdo->query($sql);
        $pdo->exec($sql);
        
        if($orderStatus == 3){
            $reserNo = $pdo->query($sql2);
            $reserNoRow = $reserNo->fetch(PDO::FETCH_ASSOC);
            $sql3 = "
                delete 
                from reservation
                where reserNo = '{$reserNoRow['reserNo']}'
            ";
            echo $reserNoRow['reserNo'];
            $pdo->exec($sql3);
        }
        

        header('Location: admin_order.php');
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
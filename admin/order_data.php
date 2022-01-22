<?php
	try{
		require_once("Pancake_connectbooks.php");  
        $date = $_REQUEST['date'];
        $branch = $_REQUEST['branch'];

		
		$sql = "
            SELECT * 
            from `orders` o
            JOIN branch b USING(branchNo)
            join member m using (memNo)
            where branchNo={$branch} and orderResDate='{$date}'
            order by orderResTime Asc";
        $order = $pdo->query($sql);
        $order_data = $pdo->query($sql);

        $orderArr=array();
        while($orderRow = $order->fetch(PDO::FETCH_ASSOC)){
            $orderArr[]=$orderRow;
        }
        echo json_encode($orderArr);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
<?php 
try{
	require_once("/php/connect.php");
	// $cardNo = $_REQUEST['cardNo'];
	$sql = "select *
			from card c 
			natural join (
				select ifnull(a.pointA,0) item1pointA,ifnull(a.pointB,0) item1pointB,ifnull(a.pointC,0) item1pointC,b.cardno
				from carditem1 b
				left outer join item a
				on a.itemno = b.item1no)as a
			natural join (
				select ifnull(a.pointA,0) item2pointA,ifnull(a.pointB,0) item2pointB,ifnull(a.pointC,0) item2pointC,b.cardno
				from carditem2 b
				left outer join item a
				on a.itemno = b.item2no)as b
			natural join (
				select ifnull(a.pointA,0) item3pointA,ifnull(a.pointB,0) item3pointB,ifnull(a.pointC,0) item3pointC,b.cardno
				from carditem3 b
				left outer join item a
				on a.itemno = b.item3no)as c
			natural join (
				select ifnull(a.pointA,0) item4pointA,ifnull(a.pointB,0) item4pointB,ifnull(a.pointC,0) item4pointC,b.cardno
				from carditem4 b
				left outer join item a
				on a.itemno = b.item4no)as d
			where cardNo = 2;"; //mem_card
	$mem_card = $pdo->prepare( $sql );
	$mem_card ->bindValue(":cardNo",$cardNo);
	$mem_card -> execute();
	
	if( $mem_card->rowCount() == 0 ){ //找不到
	 //傳回空的JSON字串
		// echo "{}";
		echo "[]";
	}else{ //找得到
    //取回一筆資料
		$mem_cardRow = $mem_card->fetch(PDO::FETCH_NUM);
    
    //送出json字串
		echo json_encode($mem_cardRow);
	}	
}catch(PDOException $e){
	echo $e->getMessage();
}


?>
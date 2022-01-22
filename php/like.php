<?php 
try{
	require_once("j_connect.php");
	$sql = "Update article set artLikeCount=artLikeCount+1
			where artNo=".$_REQUEST['artNo'].";";

	$sqlInsertLikes = "insert into likes (artNo,memNo)
					   values({$_REQUEST['artNo']},{$_SESSION['memNo']});";
	
	$sql2 = "Update article set artLikeCount=artLikeCount-1
			where artNo=".$_REQUEST['artNo'].";";

	$sqlDeletLikes = "delete from likes 
            WHERE likes.memNo = {$_SESSION['memNo']} and artNo=".$_REQUEST['artNo'].";";
	
	$type = $_REQUEST['type'];

	if ($type==1) {
		$like = $pdo->exec( $sql2 );
		$DeletLikes = $pdo->exec($sqlDeletLikes);
	}else {
		$like = $pdo->exec( $sql );
		$InsertLikes = $pdo->exec($sqlInsertLikes);
		
	}
	
	$sql3 = "select artLikeCount 
			from article 
			where artNo = ".$_REQUEST['artNo'].";";


	$artMesCount = $pdo->query($sql3);
	$artMesCountRow = $artMesCount->fetch(PDO::FETCH_ASSOC);
	echo $artMesCountRow['artLikeCount'];

}catch(PDOException $e){
	echo $e->getMessage();
}


?>
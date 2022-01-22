<?php 

try{
  require_once("php/j_connect.php");
  	$memNo = $_SESSION["memNo"];
  	$sql = "select *
			from card c
			left outer  join (
				select a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
				from carditem1 b
				left outer join item a
				on a.itemno = b.item1no)as a using(cardNo)
			left outer  join (
				select a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
				from carditem2 b
				left outer join item a
				on a.itemno = b.item2no)as b using(cardNo)
			left outer  join (
				select a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
				from carditem3 b
				left outer join item a
				on a.itemno = b.item3no)as c using(cardNo)
			left outer  join (
				select a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
				from carditem4 b
				left outer join item a
				on a.itemno = b.item4no)as d using(cardNo)
			where memNo = ".$_SESSION['memNo'].";";
			//mem_card
	
    $mem_card = $pdo -> query($sql);
    $cardArr = array();
    while ($mem_cardRow = $mem_card->fetch(PDO::FETCH_ASSOC)){
        $cardmArr[] = $mem_cardRow;
    }
    echo json_encode($cardmArr);

}catch(PDOException $e){
	$errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
	$errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}





 ?>
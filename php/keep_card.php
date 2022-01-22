
<?php 
$errMsg = "";
require_once("j_connect.php");
    try{
        $artNo=$_REQUEST['artNo'];
        $sql="
        select memNo,cardNo,artNo
        from member
        natural join card
        where artNo is not null and memNo = {$_SESSION['memNo']};
        ";
        $sql2="
            select cardNo 
            from article
            where artNo='{$artNo}';
        ";
        

        $mem_card = $pdo->query($sql);
        $status = 0;
        while($mem_cardRow = $mem_card->fetch(PDO::FETCH_ASSOC)){
            if ($mem_cardRow['artNo']==$artNo){
                $status = 1;
            }
        }

        if( $status == 0){
            $art_card = $pdo->query($sql2);
            $art_cardRow = $art_card->fetch(PDO::FETCH_ASSOC);

            $sql3="
                select *
                from card
                natural join (
                    select itemNo item1No,a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
                    from carditem1 b
                    left outer join item a
                    on a.itemno = b.item1no)as a
                natural join (
                    select itemNo item2No,a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
                    from carditem2 b
                    left outer join item a
                    on a.itemno = b.item2no)as b
                natural join (
                    select itemNo item3No,a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
                    from carditem3 b
                    left outer join item a
                    on a.itemno = b.item3no)as c
                natural join (
                    select itemNo item4No,a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
                    from carditem4 b
                    left outer join item a
                    on a.itemno = b.item4no)as d
                where cardNo= {$art_cardRow['cardNo']};";
                // exit( $sql3 );
            $card_data = $pdo->query($sql3);
            $card_dataRow = $card_data->fetch(PDO::FETCH_ASSOC);
            $sql4="select count(*) cardNo from card;";
            $newCardNo = $pdo->query($sql4);
            $newCardNoRow = $newCardNo->fetch(PDO::FETCH_ASSOC);
            $cardNo=$newCardNoRow['cardNo']+1;
            


            $sql = "INSERT INTO `card` (`cardNo`, `cardName`, `memNo`, `effectTypeNo`, `cardText`, `cardFont`, `cardTextColor1`, `cardTextColor2`, 
            `cardTextColor3`, `cardTextColor4`, `cardTextColor5`, `cardTextColor6`, `cardPrice`, `artNo`, `cardStatus`) 
            VALUES ('{$cardNo}', '{$card_dataRow['cardName']}', '{$_SESSION['memNo']}', '{$card_dataRow['effectTypeNo']}', '{$card_dataRow['cardText']}', '{$card_dataRow['cardFont']}', '{$card_dataRow['cardTextColor1']}', '{$card_dataRow['cardTextColor2']}', '{$card_dataRow['cardTextColor3']}', 
            '{$card_dataRow['cardTextColor4']}', '{$card_dataRow['cardTextColor5']}', '{$card_dataRow['cardTextColor6']}', '{$card_dataRow['cardPrice']}', 
            '{$artNo}', '1');";
            
            $insert_new_card = $pdo->exec($sql);

            $sql = "INSERT INTO `carditem1` (`cardItem1No`, `cardNo`, `item1No`) VALUES ('{$cardNo}', '{$cardNo}', '{$card_dataRow['item1No']}');";
            $insert_new_item1 = $pdo->exec($sql);
            $sql = "INSERT INTO `carditem2` (`cardItem2No`, `cardNo`, `item2No`) VALUES ('{$cardNo}', '{$cardNo}', '{$card_dataRow['item2No']}');";
            $insert_new_item2 = $pdo->exec($sql);
            $sql = "INSERT INTO `carditem3` (`cardItem3No`, `cardNo`, `item3No`) VALUES ('{$cardNo}', '{$cardNo}', '{$card_dataRow['item3No']}');";
            $insert_new_item3 = $pdo->exec($sql);
            $sql = "INSERT INTO `carditem4` (`cardItem4No`, `cardNo`, `item4No`) VALUES ('{$cardNo}', '{$cardNo}', '{$card_dataRow['item4No']}');";
            $insert_new_item4 = $pdo->exec($sql);
            echo "收藏成功";
        }else{
            echo "已收藏過";
        }
        

        

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}
echo $errMsg;
<?php
$errMsg="";
try{
  require_once("j_connect.php");
    
    if(isset($_REQUEST['filter'])){
        $filterArr = json_decode($_REQUEST['filter']);
        $orderBy =  $filterArr[0];
        $item1 = $filterArr[1];
        $item2 = $filterArr[2];
        $item3 = $filterArr[3];
        $item4 = $filterArr[4];
        $sql = "
        select * from member as m
        natural join effecttype
        natural join (
            select artNo,effecttypeNo,artTitle,artStatus,memNo,artText,date_format(artTime,'%Y-%m-%d') artTime,artTime artTime1,artLikeCount,artMesCount,cardno,cardName,item1name,item1No,item1type,item1pointA,item1pointB,item1pointC,item1Img2Url,item2No,item2name,item2type,item2pointA,item2pointB,item2pointC,item2Img2Url,item3name,item3No,item3type,item3pointA,item3pointB,item3pointC,item3Img2Url,item4name,item4No,item4Img2Url,item4type,item4pointA,item4pointB,item4pointC from article a
            natural join (
                select cardno,effecttypeNo,cardName,item1No,ifnull(item1name,'') item1name,item1type,item1pointA,item1pointB,item1pointC,item1Img2Url,ifnull(item2name,'') item2name,item2No,item2type,item2pointA,item2pointB,item2pointC,item2Img2Url,ifnull(item3name,'') item3name,item3No,item3type,item3pointA,item3pointB,item3pointC,item3Img2Url,ifnull(item4name,'') item4name,item4No,item4Img2Url,item4type,item4pointA,item4pointB,item4pointC
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
                    on a.itemno = b.item4no)as d) as a
        )as a
            where artStatus <> 0  {$item1} {$item2} {$item3} {$item4}
            order by a.{$orderBy} desc;
        ";
        $forumByFilter = $pdo->query($sql);
        $forumArr = array();
        while($forumByFilterRow = $forumByFilter->fetch(PDO::FETCH_ASSOC)){
            $forumArr[] = $forumByFilterRow;
        }
        echo json_encode($forumArr);
    }
    else{
        $sql = "
            select * from member as m
            natural join effecttype
            natural join (
                select artNo,effecttypeNo,artTitle,artStatus,memNo,artText,date_format(artTime,'%Y-%m-%d') artTime,artTime artTime1,artLikeCount,artMesCount,cardno,cardName,item1name,item1No,item1type,item1pointA,item1pointB,item1pointC,item1Img2Url,item2No,item2name,item2type,item2pointA,item2pointB,item2pointC,item2Img2Url,item3name,item3No,item3type,item3pointA,item3pointB,item3pointC,item3Img2Url,item4name,item4No,item4Img2Url,item4type,item4pointA,item4pointB,item4pointC from article a
                natural join (
                    select cardno,effecttypeNo,cardName,item1No,ifnull(item1name,'') item1name,item1type,item1pointA,item1pointB,item1pointC,item1Img2Url,ifnull(item2name,'') item2name,item2No,item2type,item2pointA,item2pointB,item2pointC,item2Img2Url,ifnull(item3name,'') item3name,item3No,item3type,item3pointA,item3pointB,item3pointC,item3Img2Url,ifnull(item4name,'') item4name,item4No,item4Img2Url,item4type,item4pointA,item4pointB,item4pointC
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
                        on a.itemno = b.item4no)as d) as a
            )as a
            where artStatus <>0
            order by a.artTime1 desc;
            
            ";//forum by time
        $forumByTime = $pdo->query($sql);
        $forumArr = array();
        while($forumByTimeRow = $forumByTime->fetch(PDO::FETCH_ASSOC)){
            $forumArr[] = $forumByTimeRow;
        }
        echo json_encode($forumArr);
        // echo json_encode("XXXXXXX");
    }
    
    
    
  
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}
echo $errMsg;

?>
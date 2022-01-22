<?php
    ob_start();
    session_start();
    
    $errMsg="";

    // $_SESSION["memNo"] = 1;
    if($_REQUEST["cardFilter"] == "Choice 1"){
        $sql = "select *
                from article JOIN card c USING (cardNo)
                natural join (
                    select a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
                    from carditem1 b
                    left outer join item a
                    on a.itemno = b.item1no)as a
                natural join (
                    select a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
                    from carditem2 b
                    left outer join item a
                    on a.itemno = b.item2no)as b
                natural join (
                    select a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
                    from carditem3 b
                    left outer join item a
                    on a.itemno = b.item3no)as c
                natural join (
                    select a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
                    from carditem4 b
                    left outer join item a
                    on a.itemno = b.item4no)as d
                    ORDER by artMesCount DESC LIMIT 0,5";
    }elseif($_REQUEST["cardFilter"] == "Choice 2"){
        $sql = "select *
                from card c
                natural join (
                    select a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
                    from carditem1 b
                    left outer join item a
                    on a.itemno = b.item1no)as a
                natural join (
                    select a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
                    from carditem2 b
                    left outer join item a
                    on a.itemno = b.item2no)as b
                natural join (
                    select a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
                    from carditem3 b
                    left outer join item a
                    on a.itemno = b.item3no)as c
                natural join (
                    select a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
                    from carditem4 b
                    left outer join item a
                    on a.itemno = b.item4no)as d
                where memNo = {$_SESSION["memNo"]} and artNo is null and cardStatus <> 0";
    }elseif($_REQUEST["cardFilter"] == "Choice 3"){
        $sql = "select *
                from card c
                natural join (
                    select a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
                    from carditem1 b
                    left outer join item a
                    on a.itemno = b.item1no)as a
                natural join (
                    select a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
                    from carditem2 b
                    left outer join item a
                    on a.itemno = b.item2no)as b
                natural join (
                    select a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
                    from carditem3 b
                    left outer join item a
                    on a.itemno = b.item3no)as c
                natural join (
                    select a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
                    from carditem4 b
                    left outer join item a
                    on a.itemno = b.item4no)as d
                where memNo = {$_SESSION["memNo"]} and artNo is not null";
    }

    try {
        require_once("connectBooks.php");
        $cardResult = $pdo->query($sql);//下指令
        
    } catch (PDOException $e) {
        $errMsg .=  "錯誤原因" . $e->getMessage() . "<br>"; 
        $errMsg .=  "錯誤行號" . $e->getLine() . "<br>";
    }

    // echo $errMsg;  

    $arr = [];
    while($cardResultRow = $cardResult->fetch(PDO::FETCH_ASSOC)){
        $arr[] = $cardResultRow;
    }
    echo json_encode($arr);
?>
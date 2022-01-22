<?php
if(isset($_POST["itemAdd"])){
        try{    
                foreach( $_FILES["itemImgUrl"]["error"] as $i => $error){
                switch($_FILES['itemImgUrl']['error'][$i]){
                    case 0:
                            $dir = "images/itemPics/";
                            if( file_exists($dir) === false){
                                mkdir( $dir ); //make directory
                            }
                            $from = $_FILES['itemImgUrl']['tmp_name'][$i];
                            $to = $dir . $_FILES['itemImgUrl']['name'][$i];
                            copy($from, $to);
                            echo $to;
                            echo "上傳成功<br>";
                            break;	
                    case 1:
                            echo "上傳檔案太大, 不得超過", ini_get("upload_max_filesize") ,"<br>";
                            break;
                    case 2:
                            echo "上傳檔案太大, 不得超過", $_POST["MAX_FILE_SIZE"], "位元組<br>";
                            break;
                    case 3:
                            echo "上傳檔案不完整<br>";
                            break;
                    case 4:
                            echo "没選送圖片".($i+1)."<br>";
                            break;
                    default:
                            echo "請聯絡網站維護人員<br>";
                            echo "error code : ", $_FILES['itemImgUrl']['error'][$i],"<br>";
                }
            };
                if($_POST["itemInterval"] == "default"){
                        $_POST["itemInterval"] = null;
                }

                require_once("Pancake_connectbooks.php");  
            
                $sql =  "INSERT INTO item VALUES ( null, :itemName, :pointA, :pointB, :pointC, :itemText, :itemTime, :itemColor, :itemInterval, :itemPrice, :itemImg1Url, :itemImg2Url, :itemImg3Url, :itemImg4Url, :effectTypeNo, :itemStatus)";
                
                $itemAdd = $pdo->prepare($sql);  

                $itemAdd -> bindValue(":itemName",  $_POST["itemName"]);
                $itemAdd -> bindValue(":pointA",  $_POST["pointA"]);
                $itemAdd -> bindValue(":pointB",  $_POST["pointB"]);
                $itemAdd -> bindValue(":pointC",  $_POST["pointC"]);
                $itemAdd -> bindValue(":itemText",  $_POST["itemText"]);
                $itemAdd -> bindValue(":itemTime",  $_POST["itemTime"]);
                $itemAdd -> bindValue(":itemColor",  $_POST["itemColor"]);
                $itemAdd -> bindValue(":itemInterval",  $_POST["itemInterval"]);
                $itemAdd -> bindValue(":itemPrice",  $_POST["itemPrice"]);
                $itemAdd -> bindValue(":itemImg1Url", 'images/itemPics/'.$_FILES['itemImgUrl']['name'][0]);
                $itemAdd -> bindValue(":itemImg2Url", 'images/itemPics/'.$_FILES['itemImgUrl']['name'][1]);
                $itemAdd -> bindValue(":itemImg3Url", 'images/itemPics/'.$_FILES['itemImgUrl']['name'][2]);
                $itemAdd -> bindValue(":itemImg4Url", 'images/itemPics/'.$_FILES['itemImgUrl']['name'][3]);
                $itemAdd -> bindValue(":effectTypeNo",  $_POST["effectTypeNo"]);
                $itemAdd -> bindValue(":itemStatus", $_POST["itemStatus"]);

                // $itemAdd -> bindValue(":itemName",  $_POST["itemName"]);
                // $itemAdd -> bindValue(":pointA",  $_POST["pointA"]);
                // $itemAdd -> bindValue(":pointB",  $_POST["pointB"]);
                // $itemAdd -> bindValue(":pointC",  $_POST["pointC"]);
                // $itemAdd -> bindValue(":itemText",  $_POST["itemText"]);
                // $itemAdd -> bindValue(":itemColor",  $_POST["itemColor"]);
                // $itemAdd -> bindValue(":itemInterval",  $_POST["itemInterval"]);
                // $itemAdd -> bindValue(":itemPrice",  $_POST["itemPrice"]);
                // $itemAdd -> bindValue(":itemImg1Url",  $dir.$_FILES['itemImgUrl']['name'][0]);
                // $itemAdd -> bindValue(":itemImg2Url",  $dir.$_FILES['itemImgUrl']['name'][1]);
                // $itemAdd -> bindValue(":itemImg3Url",  $dir.$_FILES['itemImgUrl']['name'][2]);
                // $itemAdd -> bindValue(":itemImg4Url",  $dir.$_FILES['itemImgUrl']['name'][3]);
                // $itemAdd -> bindValue(":effectTypeNo",  $_POST["effectTypeNo"]);
                // $itemAdd -> bindValue(":itemStatus",  $_POST["itemStatus"]);
            
                echo($sql);

                $itemAdd -> execute();
                
                header('Location: admin_item.php');
            
                }catch(PDOException $e){
                echo $e->getMessage();            
            }
}else{
        if($_POST['itemStatus']==0){
                require_once("Pancake_connectbooks.php");

                $sql = "update item set itemStatus = 0 where itemNo = {$_POST['itemNo']}";

                $pdo->exec($sql);

                header('Location: admin_item.php');
        }else{
                try{
                        foreach( $_FILES["itemImgUrl"]["error"] as $i => $error){
                            switch($_FILES['itemImgUrl']['error'][$i]){
                                case 0:
                                        $dir = "images/itemPics/";
                                        if( file_exists($dir) === false){
                                            mkdir( $dir ); //make directory
                                        }
                                        $from = $_FILES['itemImgUrl']['tmp_name'][$i];
                                        $to = $dir . $_FILES['itemImgUrl']['name'][$i];
                                        copy($from, $to);
                                        echo $to;
                                        echo "上傳成功<br>";
                                        break;	
                                case 1:
                                        echo "上傳檔案太大, 不得超過", ini_get("upload_max_filesize") ,"<br>";
                                        break;
                                case 2:
                                        echo "上傳檔案太大, 不得超過", $_POST["MAX_FILE_SIZE"], "位元組<br>";
                                        break;
                                case 3:
                                        echo "上傳檔案不完整<br>";
                                        break;
                                case 4:
                                        echo "没選送圖片".($i+1)."<br>";
                                        break;
                                default:
                                        echo "請聯絡網站維護人員<br>";
                                        echo "error code : ", $_FILES['itemImgUrl']['error'][$i],"<br>";
                            }
                        }
                    
                        require_once("Pancake_connectbooks.php");  
                    
                        $sql =  "update item set ";
                        
                        $sql.="itemName = '".$_POST['itemName'];
                        $sql.="',";
                        $sql.="pointA = '".$_POST['pointA'];
                        $sql.="',";
                        $sql.="pointB = '".$_POST['pointB'];
                        $sql.="',";
                        $sql.="pointC = '".$_POST['pointC'];
                        $sql.="',";
                        $sql.="itemText = '".$_POST['itemText'];
                        $sql.="',";
                        $sql.="itemTime = '".$_POST['itemTime'];
                        $sql.="',";
                        $sql.="itemColor = '".$_POST['itemColor'];
                        $sql.="',";
                        $sql.="itemInterval = ".$_POST['itemInterval'];
                        $sql.=",";
                        $sql.="itemPrice = '".$_POST['itemPrice'];
                        $sql.="',";
                        $sql.="itemImg1Url = 'images/itemPics/".$_FILES['itemImgUrl']['name'][0];
                        $sql.="',";
                        $sql.="itemImg2Url = 'images/itemPics/".$_FILES['itemImgUrl']['name'][1];
                        $sql.="',";
                        $sql.="itemImg3Url = 'images/itemPics/".$_FILES['itemImgUrl']['name'][2];
                        $sql.="',";
                        $sql.="itemImg4Url = 'images/itemPics/".$_FILES['itemImgUrl']['name'][3];
                        $sql.="',";
                        $sql.="effectTypeNo = ".$_POST['effectTypeNo'];
                        $sql.=",";
                        $sql.="itemStatus = ".$_POST['itemStatus'];
                        $sql.=" ";
                    
                        $sql.=" where itemNo = ".$_POST['itemNo']."";
                    
                        echo $sql;
                    
                        $itemTime = $pdo->exec($sql);    
                    
                        
                        header('Location: admin_item.php');
                    
                        }catch(PDOException $e){
                        echo $e->getMessage();
                    
                    }
                    
                }
        }

?>
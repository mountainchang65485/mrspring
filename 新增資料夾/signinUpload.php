<?php
ob_start();
session_start();
$errMsg="";

if(isset($_POST['login'])) {
    try{
        $dsn="mysql:host=localhost;port=3306;dbname=mrspringtest;charset=utf8";
        $user="nick8195";
        $password="1234";
        $options= array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
        $pdo = new PDO($dsn, $user, $password, $options);
        $sql="select * from member where memId = :memId and memPsw = :memPsw";

        $memId = $_POST['memId'];
        $memPsw = $_POST['memPsw'];

        $member = $pdo ->prepare($sql);
        $member -> bindValue(":memId",$memId);
        $member -> bindValue(":memPsw",$memPsw);
        $member -> execute();
        
        if($member->rowCount() == 0){
                echo "XXXXXXXX";
        }else{
            $memberRow = $member->fetch(PDO::FETCH_ASSOC);
            $_SESSION["memId"] = $memberRow["memId"];
            $_SESSION["memFirstName"] = $memberRow["memFirstName"];
            $_SESSION["memLastName"] = $memberRow["memLastName"];
            $_SESSION["memNickname"] = $memberRow["memNickname"];
            $_SESSION["twId"] = $memberRow["twId"];
            $_SESSION["memTel"] = $memberRow["memTel"];
            $_SESSION["memEmail"] = $memberRow["memEmail"];
            $_SESSION["memImgUrl"] = $memberRow["memImgUrl"];

            echo $_SESSION["memId"],$_SESSION["memFirstName"],$_SESSION["memTel"];
        }
        
    }catch(PDOException $e){
            $errMsg = "錯誤原因" . $e -> getMessage() . "<br>" ;
            $errMsg .= "錯誤行號" . $e -> getLine() . "<br>" ;

    }
}else{
   if(isset($_POST['sign'])){

    switch($_FILES['memUpFile']['error']){
	case 0:
        $dir = "images/mem_photo/";
        if( file_exists($dir) === false){
            mkdir( $dir ); //make directory
        }
        echo $_FILES['memUpFile']['name'];
        $from = $_FILES['memUpFile']['tmp_name'];
        $to = $dir . $_FILES['memUpFile']['name'];
        copy($from, $to);
        try{    
            $dsn="mysql:host=localhost;port=3306;dbname=mrspringtest;charset=utf8";
            $user="nick8195";
            $password="1234";
            $options= array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
            $pdo = new PDO($dsn, $user, $password, $options);
        
            
            $memId = $_POST['memId_s'];
            $memPsw = $_POST['memPsw_s'];
            $memLastName = $_POST['memLastName'];
            $memFirstName = $_POST['memFirstName'];
            $memNickname = $_POST['memNickname'];
            $twId = $_POST['twId'];
            $memTel = $_POST['memTel'];
            $memEmail = $_POST['memEmail'];
            $memImgUrl = $_FILES['memUpFile']['name'];
            
        
            $sql="INSERT INTO member (memId,memPsw,memLastName,memFirstName,memNickname,twId,memTel,memEmail,memImgUrl)
                    VALUES(:memId_s,:memPsw_s,:memLastName,:memFirstName,:memNickname,:twId,:memTel,:memEmail,:memUpFile)";
            $statement = $pdo -> prepare($sql);
            $statement -> bindValue(':memId_s',$memId);
            $statement -> bindValue(':memPsw_s',$memPsw);
            $statement -> bindValue(':memLastName',$memLastName);
            $statement -> bindValue(':memFirstName',$memFirstName);
            $statement -> bindValue(':memNickname',$memNickname);
            $statement -> bindValue(':twId',$twId);
            $statement -> bindValue(':memTel',$memTel);
            $statement -> bindValue(':memEmail',$memEmail);
            $statement -> bindValue(':memUpFile',$memImgUrl);
            
            $statement -> execute();
        
        } catch (PDOException $e){
            $errMsg = "錯誤原因" . $e -> getMessage() . "<br>" ;
            $errMsg .= "錯誤行號" . $e -> getLine() . "<br>" ;
        }
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
        echo "没選送檔案<br>";
        break;
	default:
        echo "請聯絡網站維護人員<br>";
        echo "error code : ", $_FILES['upFile']['error'],"<br>";
}

    
echo $errMsg;
}

   }    
   




?>
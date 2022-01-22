<?php
$dsn = "mysql:host=localhost;port=3306;dbname=mrspring03;charset=utf8";
$user = "mountain";
$password = "6666";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $user, $password, $options);
?>
<?php
try {
    $sql_quetion = "select * from question";
    $quetion = $pdo->query($sql_quetion);

    $quesRow = $quetion->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($quesRow);
    
    // if ($member->rowCount() == 0) { //找不到
    //     //傳回空的JSON字串
    //     echo json_encode("1");
    // } else { //找得到
    //     //取回一筆資料
    //     $memRow = $member->fetch(PDO::FETCH_NUM);

    //     //送出json字串
    //     echo json_encode($memRow);
    // }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!-- 資料庫連接 -->
<?php
$host = 'localhost';   // 資料庫地址
$dbname = 'cycle';  // 資料庫名稱
$user = 'root';         // 資料庫使用者名稱
$pass = '';         // 資料庫密碼
$port = 3308;  // 資料庫連接端口

$conn = new mysqli($host, $user, $pass, $dbname,$port);



if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}


function close_db() {
    global $conn;
    $conn->close();
}

?>

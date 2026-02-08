
<?php
/* 連接到會員資料庫 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cycle";
$port = 3308;

// 建立連線
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 檢查連線
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

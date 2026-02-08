<?php
$servername = "localhost";
$username = "root";  // 你的資料庫用戶名
$password = "";  // 你的資料庫密碼
$dbname = "cycle";
$port = 3308;  // 資料庫連接端口

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 檢查連接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

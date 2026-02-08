<?php
$servername = "localhost";
$username = "root"; // 您的數據庫用戶名
$password = ""; // 您的數據庫密碼
$dbname = "cycle"; // 您的數據庫名稱
$port = 3308; // 指定端口號

// 創建連接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 檢查連接
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

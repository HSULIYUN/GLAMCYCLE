<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合作門市 | GLAMCYCLE</title>
</head>
<body>
    <style>
        .store-info {
            text-align: center;
            margin: 40px auto; /* 居中顯示 */
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #9BB8CD;
            border-radius: 15px; /* 圓角邊框 */
            padding: 50px;
            width: 70%; /* 調整寬度 */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加陰影 */
            background-color: #fff; 
        }
        .store-info h2 {
            margin-top: -20px;
            font-size: 30px;
            
        }
        .store-info p {
            text-align: left; /* 左對齊文本 */
            margin-left: 20px; /* 添加左邊距 */
            color: #776B5D;
        }
    </style>

<?php
$servername = "localhost"; // 資料庫伺服器
$username = "root"; // 資料庫用戶名
$password = ''; // 資料庫密碼
$dbname = "cycle"; // 資料庫名稱
$port = 3308; // 指定 MySQL 端口

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 如果是通過 POST 提交且 city 字段不為空，則根據城市篩選
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['city'])) {
    $selectedCity = $_POST['city'];
    $sql = "SELECT * FROM store WHERE address LIKE ?";
    $stmt = $conn->prepare($sql);
    $cityPattern = '%' . $selectedCity . '%';
    $stmt->bind_param("s", $cityPattern);
} else {
    // 如果不是通過 POST 提交或者 city 字段為空，則顯示所有門市
    $sql = "SELECT * FROM store";
    $stmt = $conn->prepare($sql);
}

// 執行 SQL 查詢
if ($stmt->execute()) {
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='store-info'>";
            echo "<h2><strong>門市資訊</strong></h2>";
            echo "<p>地址：" . $row["address"]. "</p>";
            echo "<p>電話：" . $row["phone_number"]. "</p>";
            echo "<p>營業時間：" . $row["business_hours"]. "</p>";
            echo "</div>";
        }
    } else {
        echo "沒有找到相關門市";
    }
} else {
    echo "查詢執行失敗";
}


?>

</body>
</html>

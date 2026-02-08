<?php
// 数据库连接设置
$host = 'localhost';
$port = 3308;
$dbname = 'cycle';
$username = 'root';
$password = '';

// 建立PDO连接
$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);



// 检查是否提供了日期范围
if (isset($_GET['start']) && isset($_GET['end'])) {
    // 如果提供了日期范围
    $startDate = $_GET['start'];
    $endDate = $_GET['end'];

    // 输出接收到的日期，用于调试
    error_log("開始日期: " . $startDate);
    error_log("結束日期: " . $endDate);

    // 查询指定时间区间的活动
    $stmt = $conn->prepare("SELECT * FROM events WHERE StartDateTime >= :startDate AND StartDateTime <= :endDate ORDER BY StartDateTime");
    $stmt->execute([':startDate' => $startDate, ':endDate' => $endDate]);
} else {
    // 如果没有提供日期范围，查询所有活动
    $stmt = $conn->prepare("SELECT * FROM events ORDER BY StartDateTime");
    $stmt->execute();
}

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($events);


?>

<?php
include 'db.php'; // 引入数据库配置

// 獲取捐款記錄
$query = "SELECT id, name, mon, email, donation_date, place FROM donations"; // 確保列名與您的資料庫結構相匹配
$result = $conn->query($query);

if ($result === false) {
    // 查詢失敗時的錯誤處理
    echo "Error: " . $conn->error;
    die(); // 停止腳本運行，或進行其他錯誤處理
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>後臺管理 | GLAMCYCLE</title>
    <link rel="icon" type="image/png" href="pic/GClogo.png">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-control:focus {
            border-color: #4a00e0;
            box-shadow: 0 0 8px rgba(74, 0, 224, 0.5);
        }
        .btn-primary, .btn-danger, .btn-success {
            margin-top: 10px;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .top-button {
            position: absolute;
            top: 20px;
            left: 50px;
            color:#496989;
            font-weight: bold;
            font-size:20px;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<a href="index.php" class="btn  top-button">⇐返回首頁</a>
    <div class="container" style="margin-top:100px;">
        <h2>捐款資料查詢</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>金額</th>
                    <th>郵箱</th>
                    <th>備註</th>
                    <th>捐款時間</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo number_format($row['mon'], 0); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['place']); ?></td>
                    <td><?php echo htmlspecialchars($row['donation_date']); ?></td>
                </tr>
                <?php endwhile; ?>
                <?php if ($result->num_rows == 0): ?>
                <tr><td colspan="6" class="text-center">沒有找到捐款記錄</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
$conn->close();
?>

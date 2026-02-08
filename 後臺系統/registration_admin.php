<?php
include 'db.php'; // 引入数据库配置

// 處理標記為已處理的請求
if (isset($_POST['mark_processed'])) {
    $registration_id = $_POST['registration_id'];
    $conn->query("UPDATE registrations SET is_processed = TRUE WHERE id = $registration_id");
}

// 處理刪除報名的請求
if (isset($_POST['delete_registration'])) {
    $registration_id = $_POST['registration_id'];
    $conn->query("DELETE FROM registrations WHERE id = $registration_id");
}

// 獲取所有報名資訊
$registrations = $conn->query("SELECT * FROM registrations ORDER BY registration_date DESC");
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
        <h2>活動報名列表</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>活動名稱</th>
                    <th>全名</th>
                    <th>電話</th>
                    <th>電子郵件</th>
                    <th>報名日期</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($registration = $registrations->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $registration['id']; ?></td>
                    <td><?php echo htmlspecialchars($registration['event_name']); ?></td>
                    <td><?php echo htmlspecialchars($registration['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($registration['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($registration['email']); ?></td>
                    <td><?php echo $registration['registration_date']; ?></td>
                    <td><?php echo $registration['is_processed'] ? '已處理' : '未處理'; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="registration_id" value="<?php echo $registration['id']; ?>">
                            <?php if (!$registration['is_processed']): ?>
                            <button type="submit" name="mark_processed" class="btn btn-success">標記為已處理</button>
                            <?php endif; ?>
                            <button type="submit" name="delete_registration" class="btn btn-danger">刪除</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>

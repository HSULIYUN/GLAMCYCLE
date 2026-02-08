<?php
include 'db.php'; // 引入数据库连接脚本

// 處理刪除報名請求
if (isset($_POST['delete_volunteer'])) {
    $volunteer_id = $_POST['volunteer_id'];
    $conn->query("DELETE FROM volunteers WHERE id = $volunteer_id");
}

// 處理標記為已處理的請求
if (isset($_POST['mark_processed'])) {
    $volunteer_id = $_POST['volunteer_id'];
    $conn->query("UPDATE volunteers SET volunteer_option = 1 WHERE id = $volunteer_id");
}

// 獲取所有志工報名資料
$query = "SELECT id, full_name, email_address, phone_number, volunteer_option, created_at FROM volunteers ORDER BY created_at DESC";
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
    <link rel="icon" type="image/png" href="icon/gc.png">
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
        .processed {
            color: green;
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
<a href="index.php" class="btn top-button">⇐返回首頁</a>
    <div class="container" style="margin-top:100px;">
        <h2>志工報名列表</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>全名</th>
                    <th>電子郵件</th>
                    <th>電話號碼</th>
                    <th>報名日期</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="<?php echo $row['volunteer_option'] ? 'processed' : ''; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td><?php echo $row['volunteer_option'] ? '已處理' : '未處理'; ?></td>
                    <td>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="volunteer_id" value="<?php echo $row['id']; ?>">
                            <?php if (!$row['volunteer_option']): ?>
                            <button type="submit" name="mark_processed" class="btn btn-success">標記為已處理</button>
                            <?php endif; ?>
                            <button type="submit" name="delete_volunteer" class="btn btn-danger">刪除</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if ($result->num_rows == 0): ?>
                <tr><td colspan="7" class="text-center">沒有找到報名記錄</td></tr>
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

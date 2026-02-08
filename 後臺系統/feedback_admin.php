<?php
include 'db.php'; // 引入数据库配置

// 處理刪除回饋請求
if (isset($_POST['delete_feedback'])) {
    $feedback_id = $_POST['feedback_id'];
    $conn->query("DELETE FROM feedback WHERE id = $feedback_id");
}

// 處理標記為已處理的請求
if (isset($_POST['mark_processed'])) {
    $feedback_id = $_POST['feedback_id'];
    $conn->query("UPDATE feedback SET is_processed = TRUE WHERE id = $feedback_id");
}

// 獲取所有回饋
$feedbacks = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
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
        th:nth-child(2), td:nth-child(2) {
            min-width: 150px; /* 調整這個值來設置適合的寬度 */
        }
        .feedback-content {
            max-width: 300px; /* 調整這個值來設置適合的寬度 */
            word-wrap: break-word;
            white-space: normal;
        }
        .feedback-content p {
            margin: 0;
            padding: 0;
        }
        .feedback-row {
            height: auto; /* 自動調整高度 */
        }
    </style>
</head>
<body>
<a href="index.php" class="btn  top-button">⇐返回首頁</a>
    <div class="container" style="margin-top:100px;">
        <h2>意見回饋列表</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>電子郵件</th>
                    <th>回饋內容</th>
                    <th>提交時間</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($feedback = $feedbacks->fetch_assoc()): ?>
                <tr class="<?php echo $feedback['is_processed'] ? 'processed' : ''; ?>">
                    <td><?php echo $feedback['id']; ?></td>
                    <td><?php echo htmlspecialchars($feedback['name']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['email']); ?></td>
                    <td class="feedback-content"><?php echo htmlspecialchars($feedback['feedback']); ?></td>
                    <td><?php echo $feedback['submitted_at']; ?></td>
                    <td><?php echo $feedback['is_processed'] ? '已處理' : '未處理'; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="feedback_id" value="<?php echo $feedback['id']; ?>">
                            <?php if (!$feedback['is_processed']): ?>
                            <button type="submit" name="mark_processed" class="btn btn-success">標記為已處理</button>
                            <?php endif; ?>
                            <button type="submit" name="delete_feedback" class="btn btn-danger">刪除</button>
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

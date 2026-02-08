<!-- 討論串 -->
<?php
include 'db.php'; // 引入数据库配置

$post_id = $_GET['post_id'] ?? 0; // 獲取帖子ID

// 處理刪除留言請求
if (isset($_POST['delete_comment'])) {
    $comment_id = $_POST['comment_id'];
    $conn->query("DELETE FROM comments WHERE id = $comment_id");
}

// 獲取帖子的留言
$comments = $conn->query("SELECT c.id, c.comment, u.username, c.created_at FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = $post_id");

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>後臺管理 | GLAMCYCLE</title>
    <link rel="icon" type="image/png" href="pic/GClogo.png">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
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
        <h2>貼文留言</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>留言者</th>
                    <th>留言內容</th>
                    <th>留言時間</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $comments->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['comment']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_comment" class="btn btn-danger">刪除留言</button>
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

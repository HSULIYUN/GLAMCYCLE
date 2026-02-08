<?php
include 'db.php'; // 引入数据库配置

// 處理刪除請求
if (isset($_POST['delete'])) {
    $post_id = $_POST['post_id'];
    // Ensure to delete dependencies first if foreign key constraints are present
    $conn->query("DELETE FROM likes WHERE post_id = $post_id");
    $conn->query("DELETE FROM comments WHERE post_id = $post_id");
    $conn->query("DELETE FROM posts WHERE id = $post_id");
}

// 獲取所有帖子
$posts = $conn->query("SELECT p.id, p.title, IFNULL(COUNT(DISTINCT c.id), 0) AS comment_count, IFNULL(COUNT(DISTINCT l.id), 0) AS like_count FROM posts p LEFT JOIN comments c ON p.id = c.post_id LEFT JOIN likes l ON p.id = l.post_id GROUP BY p.id");

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
        <h2>討論串管理</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>標題</th>
                    <th>留言數</th>
                    <th>點讚數</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
        <?php while($row = $posts->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><a href="post_details.php?post_id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
            <td><?php echo $row['comment_count']; ?></td>
            <td><?php echo $row['like_count']; ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete" class="btn btn-danger">刪除</button>
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

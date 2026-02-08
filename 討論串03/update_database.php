<?php
include 'db.php'; // 引入您的資料庫連接配置

// 檢查是否已經存在 idx_unique_post_user 索引
$query = "SHOW INDEX FROM likes WHERE Key_name = 'idx_unique_post_user'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    // 如果不存在 idx_unique_post_user 索引，則添加它
    $alterTableQuery = "ALTER TABLE likes ADD UNIQUE INDEX idx_unique_post_user (post_id, user_id);";
    if ($conn->query($alterTableQuery) === TRUE) {
        echo "索引 idx_unique_post_user 已成功添加到 likes 表中。\n";
    } else {
        echo "錯誤：無法添加索引 idx_unique_post_user：" . $conn->error . "\n";
    }
} else {
    echo "索引 idx_unique_post_user 已存在。\n";
}

$conn->close();
?>

<?php
include 'db.php'; // 引入数据库配置

// 處理更新請求
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $button_text = $conn->real_escape_string($_POST['button_text']);
    $button_url = $conn->real_escape_string($_POST['button_url']);

    // 初始化查詢變量
    $query = "";

    // 檢查是否有檔案被上傳
    if ($_FILES['image']['error'] == 0) {
        $imageDir = __DIR__ . '/images/index/'; // 使用相對目錄
        // 確保目錄存在
        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0777, true);
        }
        $imagePath = $imageDir . basename($_FILES['image']['name']);
        $image_url = '/images/index/' . basename($_FILES['image']['name']);

        // 移動檔案到指定目錄
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image_url = $conn->real_escape_string($image_url);
            $query = "UPDATE news SET title='$title', image_url='$image_url', description='$description', button_text='$button_text', button_url='$button_url' WHERE id=$id";
        } else {
            // 檔案移動失敗
            echo "檔案上傳失敗。";
        }
    }

    // 如果沒有上傳圖片或上傳失敗但其他欄位有改變
    if (empty($query)) {
        $query = "UPDATE news SET title='$title', description='$description', button_text='$button_text', button_url='$button_url' WHERE id=$id";
    }

    // 執行查詢
    if (!empty($query)) {
        if ($conn->query($query) === TRUE) {
            echo "記錄更新成功";
        } else {
            echo "錯誤: " . $query . "<br>" . $conn->error;
        }
    }
}

// 獲取所有資料
$result = $conn->query("SELECT * FROM news");
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>後臺管理 | GLAMCYCLE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
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
    <div class="container">
        <h2>最新資訊編輯</h2>
        <?php while($row = $result->fetch_assoc()): ?>
        <form action="news.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="title">標題</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="image">圖片</label>
                <input type="file" class="form-control" id="image" name="image" required>
                <img src="<?php echo $row['image_url']; ?>" height="100" alt="Current Image">
            </div>
            <div class="mb-3">
                <label for="description">描述</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="button_text">按鈕文字</label>
                <input type="text" class="form-control" id="button_text" name="button_text" value="<?php echo htmlspecialchars($row['button_text']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="button_url">按鈕 URL</label>
                <input type="text" class="form-control" id="button_url" name="button_url" value="<?php echo htmlspecialchars($row['button_url']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">更新</button>
        </form>
        <?php endwhile; ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>

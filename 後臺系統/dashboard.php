<?php
include 'db.php'; // 引入数据库配置

// 處理刪除活動請求
if (isset($_POST['delete_event'])) {
    $event_id = $_POST['event_id'];
    $stmt = $conn->prepare("DELETE FROM events WHERE EventID = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->close();
}

// 處理上傳精選圖片請求
if (isset($_POST['upload_featured_image'])) {
    $target_dir = '/images/events/';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // 創建目錄並設置權限
    }
    $featured_image_path = $target_dir . basename($_FILES['featured_image']['name']);
    if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $featured_image_path)) {
        $stmt = $conn->prepare("UPDATE events SET FeaturedImagePath = ? WHERE EventID = 1");
        $stmt->bind_param("s", $featured_image_path);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "文件上傳失敗。";
    }
}

// 獲取所有活動
$result = $conn->query("SELECT * FROM events");
if (!$result) {
    die("SQL Error: " . $conn->error);
}

// 獲取精選圖片
$featured_image_result = $conn->query("SELECT FeaturedImagePath FROM events WHERE EventID = 1");
$featured_image = $featured_image_result->fetch_assoc();
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
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .btn:hover { opacity: 0.8; }
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
        <h2>精選圖片</h2>
        <?php if (!empty($featured_image['FeaturedImagePath'])): ?>
            <img src="<?php echo htmlspecialchars($featured_image['FeaturedImagePath']); ?>" alt="Featured Image" width="200">
        <?php endif; ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="featured_image">上傳精選圖片</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" required>
            </div>
            <button type="submit" name="upload_featured_image" class="btn btn-primary">上傳</button>
        </form>
        <hr>
        <h2>活動列表</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eventModal" onclick="addEvent()">新增活動</button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>EventID</th>
                    <th>EventName</th>
                    <th>活動圖片</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $event['EventID']; ?></td>
                    <td><?php echo htmlspecialchars($event['EventName']); ?></td>
                    <td>
                        <?php if (!empty($event['ImagePath'])): ?>
                            <img src="<?php echo htmlspecialchars($event['ImagePath']); ?>" alt="Event Image" width="100">
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-primary" onclick="editEvent('<?php echo $event['EventID']; ?>', '<?php echo htmlspecialchars($event['EventName']); ?>')">快速編輯</button>
                        <a href="edit_event_details.php?id=<?php echo $event['EventID']; ?>" class="btn btn-info">詳細編輯</a>
                        <form action="" method="post" style="display: inline-block;">
                            <input type="hidden" name="event_id" value="<?php echo $event['EventID']; ?>">
                            <button type="submit" name="delete_event" class="btn btn-danger">刪除</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- 活動新增/編輯模態窗口 -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">活動資訊</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="handle_event.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="event_id" id="event_id">
                        <div class="form-group">
                            <label for="event_name">活動名稱</label>
                            <input type="text" class="form-control" id="event_name" name="event_name" required>
                        </div>
                        <div class="form-group">
                            <label for="event_description">活動描述</label>
                            <textarea class="form-control" id="event_description" name="event_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event_image">活動圖片</label>
                            <input type="file" class="form-control" id="event_image" name="event_image">
                        </div>
                        <div class="form-group">
                            <label for="start_datetime">開始時間</label>
                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
                        </div>
                        <div class="form-group">
                            <label for="end_datetime">結束時間</label>
                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
                        </div>
                        <div class="form-group">
                            <label for="event_type">活動類型(輸入"特展"為綠色.輸入"課程"為橘色.其他則皆為藍色)</label>
                            <input type="text" class="form-control" id="event_type" name="event_type">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" name="save_event" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    function addEvent() {
        document.getElementById('event_id').value = '';
        document.getElementById('event_name').value = '';
        document.getElementById('event_description').value = '';
        document.getElementById('event_image').value = '';
        document.getElementById('start_datetime').value = '';
        document.getElementById('end_datetime').value = '';
        document.getElementById('event_type').value = '';
        document.getElementById('eventModalLabel').textContent = '新增活動';
    }

    function editEvent(eventId, eventName) {
        document.getElementById('event_id').value = eventId;
        document.getElementById('event_name').value = eventName;
        document.getElementById('event_description').value = ''; // Assuming you fetch this data from your server
        document.getElementById('start_datetime').value = ''; // Assuming you fetch this data from your server
        document.getElementById('end_datetime').value = ''; // Assuming you fetch this data from your server
        document.getElementById('event_type').value = ''; // Assuming you fetch this data from your server
        document.getElementById('eventModalLabel').textContent = '編輯活動';
        var myModal = new bootstrap.Modal(document.getElementById('eventModal'), {
            keyboard: false
        });
        myModal.show();
    }
    </script>
</body>
</html>

<?php
include 'db.php'; // 引入数据库配置

$exhibition_id = $_GET['id'] ?? null;
if (!$exhibition_id) {
    header("Location: dashboard.php");
    exit;
}

// 从数据库获取展览详情
$stmt = $conn->prepare("SELECT * FROM exhibition_details WHERE id = ?");
if (!$stmt) {
    die('MySQL prepare error: ' . $conn->error);
}
$stmt->bind_param("i", $exhibition_id);
$stmt->execute();
$exhibition = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$exhibition) {
    echo "No details found for this exhibition.";
    exit;
}

// 处理表单提交更新展览信息
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $small_title = $_POST['small_title'] ?? '';
    $long_title = $_POST['long_title'] ?? '';
    $introduction = $_POST['introduction'] ?? '';
    $information = $_POST['information'] ?? '';
    $author_intro = $_POST['author_intro'] ?? '';
    $feature_1_name = $_POST['feature_1_name'] ?? '';
    $feature_1 = $_POST['feature_1'] ?? '';
    $feature_1_note = $_POST['feature_1_note'] ?? '';
    $feature_2_name = $_POST['feature_2_name'] ?? '';
    $feature_2 = $_POST['feature_2'] ?? '';
    $feature_2_note = $_POST['feature_2_note'] ?? '';
    $feature_3_name = $_POST['feature_3_name'] ?? '';
    $feature_3 = $_POST['feature_3'] ?? '';
    $feature_3_note = $_POST['feature_3_note'] ?? '';
    $feature_4_name = $_POST['feature_4_name'] ?? '';
    $feature_4 = $_POST['feature_4'] ?? '';
    $feature_4_note = $_POST['feature_4_note'] ?? '';
    $notice = $_POST['notice'] ?? '';
    $title = $_POST['title'] ?? '';
    $registration_start = $_POST['registration_start'] ?? '';
    $registration_end = $_POST['registration_end'] ?? '';
    $biography = $_POST['biography'] ?? '';
    $bio = $_POST['bio'] ?? '';

    // 处理文件上传
    $upload_dir = '/images/events/';
    $features_img_url = uploadFile('features_img_url', $upload_dir);
    $event_img_path = uploadFile('event_img_path', $upload_dir);
    $author_img_path = uploadFile('author_img_path', $upload_dir);

    // 如果没有新上传的文件，保持原有的路径
    if (!$features_img_url) $features_img_url = $exhibition['features_img_url'];
    if (!$event_img_path) $event_img_path = $exhibition['event_img_path'];
    if (!$author_img_path) $author_img_path = $exhibition['author_img_path'];

    // Construct the update query
    $update_query = "UPDATE exhibition_details SET 
        small_title=?, 
        long_title=?, 
        introduction=?, 
        information=?, 
        author_intro=?, 
        feature_1_name=?, 
        feature_1=?, 
        feature_1_note=?, 
        feature_2_name=?, 
        feature_2=?, 
        feature_2_note=?, 
        feature_3_name=?, 
        feature_3=?, 
        feature_3_note=?, 
        feature_4_name=?, 
        feature_4=?, 
        feature_4_note=?, 
        features_img_url=?, 
        event_img_path=?, 
        notice=?, 
        author_img_path=?, 
        title=?, 
        registration_start=?, 
        registration_end=?, 
        biography=?, 
        bio=? 
    WHERE id=?";
    $update_stmt = $conn->prepare($update_query);
    if (!$update_stmt) {
        echo "Prepare failed: " . $conn->error;
        exit;
    }
    $update_stmt->bind_param(
        "ssssssssssssssssssssssssssi", 
        $small_title, 
        $long_title, 
        $introduction, 
        $information, 
        $author_intro, 
        $feature_1_name, 
        $feature_1, 
        $feature_1_note, 
        $feature_2_name, 
        $feature_2, 
        $feature_2_note, 
        $feature_3_name, 
        $feature_3, 
        $feature_3_note, 
        $feature_4_name, 
        $feature_4, 
        $feature_4_note, 
        $features_img_url, 
        $event_img_path, 
        $notice, 
        $author_img_path, 
        $title, 
        $registration_start, 
        $registration_end, 
        $biography, 
        $bio, 
        $exhibition_id
    );    
    if (!$update_stmt->execute()) {
        echo "Execute error: " . $update_stmt->error;
    } else {
        echo "Update successful!";
        header("Location: dashboard.php"); // 更新后重定向回展览列表页面
        exit;
    }
    $update_stmt->close();
}

// 文件上传处理函数
function uploadFile($input_name, $upload_dir) {
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES[$input_name]['tmp_name'];
        $file_name = $_FILES[$input_name]['name'];
        $file_size = $_FILES[$input_name]['size'];
        $file_type = $_FILES[$input_name]['type'];
        $file_name_cleansed = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $file_name);
        $dest_path = $upload_dir . $file_name_cleansed;

        if (move_uploaded_file($file_tmp_path, $dest_path)) {
            return $dest_path;
        } else {
            echo 'There was an error moving the uploaded file.';
            return null;
        }
    }
    return null;
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
</head>
<style>
    label{
        font-weight:bold;
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
<body>
<a href="index.php" class="btn  top-button">⇐返回首頁</a>
    <div class="container" style="margin-top:100px;">
    <h1 style="font-weight:bold">編輯展覽詳情</h1>
    <h6 style="font-weight:bold;">注意 * 文字需要換行請打上"&lt;br&gt;"，來進行換行。</h6>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <h3 style="font-weight:bold;color:#7D7C7C;">- 活動報名日期&時間 -</h3>
        <div class="mb-3">
            <label for="registration_start">報名開始時間</label>
            <input type="datetime-local" class="form-control" id="registration_start" name="registration_start" value="<?php echo htmlspecialchars($exhibition['registration_start'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="registration_end">報名結束時間</label>
            <input type="datetime-local" class="form-control" id="registration_end" name="registration_end" value="<?php echo htmlspecialchars($exhibition['registration_end'] ?? ''); ?>">
        </div>
        <!-- 添加更多表單欄位 -->
        <h3 style="font-weight:bold;color:#7D7C7C;">- 活動名稱 -</h3>
        <div class="mb-3">
            <label for="small_title">小標題 例如 : METAL'UP</label>
            <input type="text" class="form-control" id="small_title" name="small_title" value="<?php echo htmlspecialchars($exhibition['small_title'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="long_title">長標題 例如 : METAL'UP 昨日的彩妝魔術化作永恆的顏料藝術</label>
            <textarea class="form-control" id="long_title" name="long_title"><?php echo htmlspecialchars($exhibition['long_title'] ?? ''); ?></textarea>
        </div>
        <h3 style="font-weight:bold;color:#7D7C7C;">- 活動資訊&海報 -</h3>
        <div class="mb-3">
            <label for="information">活動資訊 例如 : 日期.售票價格等等</label>
            <textarea class="form-control" id="information" name="information"><?php echo htmlspecialchars($exhibition['information'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="event_img_path">活動海報圖片 ( 建議使用1400*600 )</label>
            <input type="file" class="form-control" id="event_img_path" name="event_img_path">
        </div>
        <h3 style="font-weight:bold;color:#7D7C7C;">- 活動介紹 -</h3>
        <div class="mb-3">
            <label for="introduction">活動介紹</label>
            <textarea class="form-control" id="introduction" name="introduction"><?php echo htmlspecialchars($exhibition['introduction'] ?? ''); ?></textarea>
        </div>
        <h3 style="font-weight:bold;color:#7D7C7C;">- 作者簡介 -</h3>
        <div class="mb-3">
            <label for="title">作者的title 例如 : 驚喜嘉賓或展覽作者等等</label>
            <textarea class="form-control" id="title" name="title"><?php echo htmlspecialchars($exhibition['title'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="author_img_path">作者圖片</label>
            <input type="file" class="form-control" id="author_img_path" name="author_img_path">
        </div>
        <div class="mb-3">
            <label for="bio">作者名稱以及職業名稱 例如 : Mr.beest 藝術家</label>
            <textarea class="form-control" id="bio" name="bio"><?php echo htmlspecialchars($exhibition['bio'] ?? ''); ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="author_intro">作者簡介</label>
            <textarea class="form-control" id="author_intro" name="author_intro"><?php echo htmlspecialchars($exhibition['author_intro'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="biography">作者生平</label>
            <textarea class="form-control" id="biography" name="biography"><?php echo htmlspecialchars($exhibition['biography'] ?? ''); ?></textarea>
        </div>
        <!-- Repeat for other fields -->
        <!-- Features -->
        
        <!-- 圖片欄位 -->
        <h3 style="font-weight:bold;color:#7D7C7C;">- 活動特色 -</h3>
        <h6 style="font-weight:bold;color:#7D7C7C;">如活動特色不足，可選擇不填寫。</h6>
        <div class="mb-3">
            <label for="features_img_url">活動特色圖片</label>
            <input type="file" class="form-control" id="features_img_url" name="features_img_url">
        </div>
        <div class="mb-3">
            <label for="feature_1_name">活動特色 1 名稱</label>
            <input type="text" class="form-control" id="feature_1_name" name="feature_1_name" value="<?php echo htmlspecialchars($exhibition['feature_1_name'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="feature_1">活動特色 1 內容</label>
            <textarea class="form-control" id="feature_1" name="feature_1"><?php echo htmlspecialchars($exhibition['feature_1'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="feature_1_note">活動特色 1 注意事項</label>
            <textarea class="form-control" id="feature_1_note" name="feature_1_note"><?php echo htmlspecialchars($exhibition['feature_1_note'] ?? ''); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="feature_2_name">活動特色 2 名稱</label>
            <input type="text" class="form-control" id="feature_2_name" name="feature_2_name" value="<?php echo htmlspecialchars($exhibition['feature_2_name'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="feature_2">活動特色 2 內容</label>
            <textarea class="form-control" id="feature_2" name="feature_2"><?php echo htmlspecialchars($exhibition['feature_2'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="feature_2_note">活動特色 3 注意事項</label>
            <textarea class="form-control" id="feature_2_note" name="feature_2_note"><?php echo htmlspecialchars($exhibition['feature_2_note'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="feature_3_name">活動特色 3 名稱</label>
            <input type="text" class="form-control" id="feature_3_name" name="feature_3_name" value="<?php echo htmlspecialchars($exhibition['feature_3_name'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="feature_3">活動特色 3 內容</label>
            <textarea class="form-control" id="feature_3" name="feature_3"><?php echo htmlspecialchars($exhibition['feature_3'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="feature_3_note">活動特色 3 注意事項</label>
            <textarea class="form-control" id="feature_3_note" name="feature_3_note"><?php echo htmlspecialchars($exhibition['feature_3_note'] ?? ''); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="feature_4_name">活動特色 4 名稱</label>
            <input type="text" class="form-control" id="feature_4_name" name="feature_4_name" value="<?php echo htmlspecialchars($exhibition['feature_4_name'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="feature_4">活動特色 4 內容</label>
            <textarea class="form-control" id="feature_4" name="feature_4"><?php echo htmlspecialchars($exhibition['feature_4'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="feature_4_note">活動特色 4 注意事項</label>
            <textarea class="form-control" id="feature_4_note" name="feature_4_note"><?php echo htmlspecialchars($exhibition['feature_4_note'] ?? ''); ?></textarea>
        </div>

        <h3 style="font-weight:bold;color:#7D7C7C;">- 注意事項 -</h3>
        <div class="mb-3">
            <label for="notice">注意事項</label>
            <textarea class="form-control" id="notice" name="notice"><?php echo htmlspecialchars($exhibition['notice'] ?? ''); ?></textarea>
        </div>
        
        <!-- 其他文本欄位 -->
        <!-- Ensure all fields are included -->
        <button type="submit" class="btn btn-primary">保存變更</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

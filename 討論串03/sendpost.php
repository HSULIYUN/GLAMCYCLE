<?php
// 最開始的地方添加 session_start()
session_start();

// 確保用戶已登入
if (!isset($_SESSION['user_id'])) {
    header("Location: article.php");  // 未登入則重定向到登錄頁面
    exit();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = $_POST['image_path'];
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL; // 使用者ID可能是NULL
    $post_user = $_POST['post_user'];
    $recaptchaResponse = $_POST['recaptcha_response'];

    // 檢查 reCAPTCHA
    $secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {
        // 繼續進行數據庫操作
        $conn = new mysqli('localhost', 'root', '', 'cycle', 3308);
        if ($conn->connect_error) {
            die("連接失敗: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO posts (title, content, image_path, user_id, post_user) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $title, $content, $image_path, $user_id, $post_user);

        if ($stmt->execute() === TRUE) {
            header('Location: index.php');
            exit();
        } else {
            echo "錯誤: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "驗證失敗或懷疑是機器人行為";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>發布貼文 | GLAMCYCLE</title>
    <link rel="icon" type="icon" href="icon/gc.png" />
    <link rel="stylesheet" href="post.css">
    <!-- google安全機器人 -->
 <script src="https://www.google.com/recaptcha/api.js?render=6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu', {action: 'submit'}).then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
            });
        });
    </script>

</head>
<style>
    .user-info {
    display: flex;
    align-items: center; /* 垂直居中对齐 */
    font-family: Arial, sans-serif; /* 设置字体 */
}

.user-icon {
    width: 50px; /* 图标宽度 */
    height: 50px; /* 图标高度 */
    border-radius: 50%; /* 圆形 */
    display: flex;
    justify-content: center; /* 水平居中 */
    align-items: center; /* 垂直居中 */
    margin-right: 10px; /* 与用户名标签的间距 */
}

.username {
    color: #4a4a4a; /* 深灰色文字 */
    font-size: 20px; /* 文字大小 */
    font-weight: bold; /* 设置为粗体 */
    color:#7D7C7C;
}

/* 共通按鈕樣式 */
button {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
    outline: none; /* 移除點擊後的輪廓 */
}


/* 發布按鈕樣式 */
.btn-submit {
    color: white;
    background-color: #4a4a4a;
}


.btn00 {
    font-size: 16px; /* 設定字型大小 */
    cursor: pointer; /* 確保鼠標為指針形狀，提示可點擊 */
    font-weight: bold;
}

</style>
<body>
    <div class="totalcontainer"> 
        <div class="laya-please layer-1"></div>
        <div class="laya-please layer-2"></div>
        <div class="container1">
            <div class="laya-please layer-3"></div>
            <div class="laya-please layer-4"></div>
            <div class="laya-please layer-5"></div>
            <div class="laya-please layer-6"></div>
        </div>
        <div class="container2">
            <div class="laya-please layer-7"></div>
            <div class="laya-please layer-8"></div>
        </div>
        <div class="container">
            <h1 style="font-size:40px;">發布貼文</h1>
            <form id="postForm" action="submit_post.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="user-info">
                    <span class="user-icon"><img src="assets/1.png" class="user-icon"></span>
                    <span class="username">發文者：<?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </div>
                <div class="form-group" style="margin-top:30px;">
                    <label for="title" style="font-size: 16px;font-weight: bold;">標題:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content" style="font-size: 16px;font-weight: bold;">內文:</label>
                    <textarea id="content" name="content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="imageUpload" class="upload-label" style="font-size: 16px;font-weight: bold;">上傳圖片:</label>
                    <input type="file" id="imageUpload" name="imageUpload" accept="image/*" class="btn00" >
                    <!-- 圖片預覽容器 -->
                    <div id="imagePreview" class="image-preview"></div>
                </div>

                <div class="submit-container">
                    <button type="submit" class="btn btn-submit" style="font-size: 16px;font-weight: bold;">發布</button>
                </div>

            </form>
            
        </div>
    </div>
    <script src="postScript.js"></script>
</body>
</html>

<?php
include 'db.php'; // 包含您的數據庫連接腳本

$eventName = "未知活動"; // 預設活動名稱

if (isset($_GET['id'])) {
    $eventId = $_GET['id']; // 從URL參數獲取活動ID

    // 預備語句避免SQL注入
    $stmt = $conn->prepare("SELECT EventName FROM events WHERE EventID = ?");
    $stmt->bind_param("i", $eventId); // 'i' 指定 $eventId 是整型
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 輸出數據
        while ($row = $result->fetch_assoc()) {
            $eventName = $row["EventName"];
        }
    } else {
        echo "沒有結果";
    }
    $stmt->close();
} else {
    echo "活動ID未指定";
}

$conn->close();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_name'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $notes = $_POST['notes'];
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

        $stmt = $conn->prepare("INSERT INTO registrations (event_name, full_name, phone_number, email, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $event_name, $full_name, $phone_number, $email, $notes);

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
<html lang="zh-Hant">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <link rel="icon" type="icon" href="icon/gc.png" />
    <meta name="author" content="" />
    <title>活動報名 | GLAMCYCLE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">
    <!-- Font Awesome 圖示（免費版本）-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google 字體-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
    <!-- 核心主題 CSS（包括 Bootstrap）-->
    <link href="css/index.css" rel="stylesheet" />
     <!-- google安全機器人 -->
    <script src="https://www.google.com/recaptcha/api.js?render=6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu', {action: 'submit'}).then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
            });
        });
    </script>
    <style>
        /* Custom Styles for Responsive Design */
        @media (max-width: 768px) {
            .masthead-content {
                padding: 20px;
            }
        }
        /* 自定義樣式 */
input.form-control {
    min-width: 100%; /* 讓 input 寬度滿版 */
    max-width: 100%; /* 限制最大寬度，避免超出父容器 */
}
.grecaptcha-badge {
            z-index: 1000; /* 确保reCAPTCHA图标在最前面 */
        }

    </style>
</head>

<body>
    <!-- 背景影片-->
    <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="assets/mp4/video.mp4" type="video/mp4" />
    </video>
    <!-- 頁首-->
    <div class="masthead">
        <div class="masthead-content text-white">
            <div class="container-fluid px-4 px-lg-0">
                <!-- PHP腳本將活動名稱插入到這裡 -->
                <h1 class="lh-1 mb-4" style="color: rgb(113, 102, 102);"><?php echo $eventName; ?></h1>
                
                <p class="mb-5" style="color: rgb(113, 102, 102);">活動報名表</p>
                <form id="contactForm" data-sb-form-api-token="API_TOKEN" action="submit_form.php" method="post">
                    <!-- 在表單中添加一個隱藏的欄位來存儲活動名稱 -->
                    <input type="hidden" name="event_name" value="<?php echo htmlspecialchars($eventName); ?>">

                    <!-- 下拉式選單 -->

                    <!-- 姓名輸入-->
                    <div class="row input-group-newsletter">
                        <div class="col">
                            <input class="form-control" name="name" id="name" type="text" placeholder="請輸入您的姓名..." aria-label="請輸入您的姓名..." data-sb-validations="required" />
                        </div>
                    </div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="name:required">請輸入姓名。</div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="name:name">姓名無效。</div>

                    <!-- 電話號碼輸入-->
                    <div class="row input-group-newsletter">
                      <div class="col">
                          <input class="form-control" name="num" id="num" type="tel" pattern="\d{10}" placeholder="請輸入您的電話號碼..." aria-label="請輸入您的電話號碼..." data-sb-validations="required" required title="電話號碼需為10位數字" />
                      </div>
                    </div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="num:required">請輸入電話號碼。</div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="num:pattern">電話號碼需為10位數字。</div>

                    <!-- 電子郵件輸入-->
                    <div class="row input-group-newsletter">
                        <div class="col">
                            <input class="form-control" name="email" id="email" type="email" placeholder="請輸入您的電子郵件地址..." aria-label="請輸入您的電子郵件地址..." data-sb-validations="required,email" />
                        </div>
                    </div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="email:required">請輸入電子郵件地址。</div>
                    <div class="invalid-feedback mt-2" data-sb-feedback="email:email">電子郵件地址無效。</div>

                    <!-- 送出按鈕-->
                    <div class="row input-group-newsletter">
                        <div class="col-auto">
                            <button class="btn btn-primary" id="submitButton" type="submit">送出！</button>
                        </div>
                    </div>
                </form>

                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center mb-3 mt-2">
                        <div class="fw-bolder">表單提交成功！</div>
                    </div>
                </div>
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3 mt-2">發送訊息時發生錯誤！</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 核心 JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- 核心主題 JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>

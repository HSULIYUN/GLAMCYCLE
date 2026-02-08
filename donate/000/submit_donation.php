<?php
$host = 'localhost';
$username = 'root';
$password = ''; // 將這裡的值更換為實際的密碼
$database = 'cycle';
$port = 3308; // 添加了新的端口號變量

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 從POST請求中獲取數據
$name = $_POST['name'];
$pas = $_POST['pas']; // 注意: 身份證和信用卡信息需要加密處理以確保安全
$mon = $_POST['mon'];
$email = $_POST['email'];
$eee = $_POST['eee']; // 信用卡帳號
$eeee = $_POST['eeee']; // 到期日
$safe = $_POST['safe']; // 安全碼
$place = $_POST['place']; // 備註
$donation_date = date('Y-m-d H:i:s'); // 獲取當前的日期和時間

// 插入數據到數據庫
$sql = "INSERT INTO donations (name, pas, mon, email, eee, eeee, safe, place, donation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissssss", $name, $pas, $mon, $email, $eee, $eeee, $safe, $place, $donation_date);

if ($stmt->execute()) {
    // 數據插入成功，重定向到送出.html並帶上名稱和捐款金額作為參數
    header("Location: 送出.html?name={$name}&mon={$mon}&email={$email}");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 防止機器人驗證
$secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';
$recaptchaResponse = $_POST['g-recaptcha-response']; // 確保你已經從表單中獲取了 recaptcha 響應

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
$responseKeys = json_decode($response, true);

if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {
    $feedback = $_POST['feedback']; // 確保你已經從表單中獲取了反饋
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        header('Location: thank_you.php');
        exit();
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "驗證失敗或懷疑是機器人行為";
}

// 關閉連接
$stmt->close();
$conn->close();
?>

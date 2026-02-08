<?php
// phpmyadmin基礎設置
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cycle";
$port = 3308; // Specify the port here

// 意見回饋資料回傳
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

$name = $_POST['nameInput'];
$email = $_POST['exampleInputEmail1'];
$feedback = $_POST['feedbackTextarea'];
$recaptchaResponse = $_POST['recaptcha_response'];

$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$feedback = $conn->real_escape_string($feedback);

// 防止機器人驗證
$secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
$responseKeys = json_decode($response, true);

if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        header('Location: thank_you.php');
        exit();
    } else {
        echo "错误: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "驗證失敗或懷疑是機器人行為";
}

$conn->close();
?>

<?php
session_start();
$host = 'localhost';  // 通常是 localhost
$dbname = 'cycle';
$user = 'root';
$pass = '';
$port = 3308;  // 資料庫連接端口
// 建立连接
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.html?error=missing");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// 防范 SQL 注入的基本方式
$username = $conn->real_escape_string($username);

// 搜索数据库看是否有匹配的用户名
$query = "SELECT id, username, password FROM admin_users WHERE username = '$username'";
$result = $conn->query($query);

if ($result === false) {
    echo "SQL错误：" . $conn->error;
    exit;
}

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        // 登录成功
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../index.php"); // 导向至欢迎页面
        exit;
    } else {
        header("Location: login.html?error=invalid"); //密码不正确
        exit;
    }
} else {
    header("Location: login.html?error=invalid"); //用户不存在
    exit;
}

// 防止機器人驗證

$secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
$responseKeys = json_decode($response, true);

if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {
    $sql = "INSERT INTO admin_users (username, full_name, admin_number, password) VALUES ('$name', '$email', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../index.php');
        exit();
    } else {
        echo "错误: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "驗證失敗或懷疑是機器人行為";
}

$conn->close();
?>

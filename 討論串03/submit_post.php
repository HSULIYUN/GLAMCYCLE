<?php

// 确保会话已开始
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cycle";
$port = 3308; // 指定端口号

// 启用错误报告
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 检查数据库连接
if ($conn->connect_error) {
    error_log("连接失败: " . $conn->connect_error);  // 将错误记录到错误日志
    header("Location: error_page.php");  // 可以导向到一个错误页面
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 检查是否已登录
    if (!isset($_SESSION['username'])) {
        header("Location: login_page.php");  // 如果没有 username，重定向到登录页面
        exit();
    }

    $post_user = $_SESSION['username']; // 从会话中获取用户名
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = "";

    // 处理图像上传
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        $original_filename = basename($_FILES["imageUpload"]["name"]);
        $safe_filename = preg_replace("/[^a-zA-Z0-9.]/", "_", $original_filename);
        $target_file = $target_dir . $safe_filename;

        if (!move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
            error_log("上传文件失败，文件名： " . $safe_filename);
            header("Location: error_page.php");
            exit();
        }
        $image_path = $target_file;
    } else {
        if (isset($_FILES['imageUpload']['error']) && $_FILES['imageUpload']['error'] != 0) {
            error_log("文件上传错误码：" . $_FILES['imageUpload']['error']);
        }
    }

    // 准备 SQL 语句插入帖子
    $sql = "INSERT INTO posts (post_user, title, content, image_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        exit();
    }
    $stmt->bind_param("ssss", $post_user, $title, $content, $image_path);

    // 执行 SQL 语句
    if (!$stmt->execute()) {
        error_log("数据库错误: " . $stmt->error);  // 将错误记录到错误日志
    }
    $stmt->close();
    $conn->close();
    header("Location: index.php");  // 重定向到首页
    exit();
}

?>

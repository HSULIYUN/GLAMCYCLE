<?php
/* 登入驗證 */
session_start(); // 开始一个新的会话或者恢复现有会话

include 'config.php';  // 引入连接配置

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "SELECT id, username, password FROM users WHERE username='$username' OR email='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // 登录成功，设置会话变量
        $_SESSION['user_id'] = $row['id']; // 存储用户ID
        $_SESSION['username'] = $row['username']; // 存储用户名

        // 可选择重定向到一个新的页面
        header('Location: /小專檔案/首頁網站/index.php'); // 修改为你的目标页面
        exit; // 确保后续代码不会被执行
    } else {
        echo "<script>alert('密碼錯誤!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('找不到此用戶'); window.history.back();</script>";
}

$conn->close();
?>

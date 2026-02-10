<?php

session_start(); 

include 'config.php';  

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "SELECT id, username, password FROM users WHERE username='$username' OR email='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {

        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['username'] = $row['username'];

        header('Location: /小專檔案/首頁網站/index.php'); 
        exit; 
    } else {
        echo "<script>alert('密碼錯誤!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('找不到此用戶'); window.history.back();</script>";
}

$conn->close();
?>

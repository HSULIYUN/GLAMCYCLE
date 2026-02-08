<?php
/* 更新會員資料傳到資料庫 */
session_start();
include 'config.php';  // 引入连接配置

if (isset($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['user_birthday'], $_POST['user_gender'])) {
    $userId = $_SESSION['user_id'];
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $user_birthday = $conn->real_escape_string($_POST['user_birthday']);
    $user_gender = $conn->real_escape_string($_POST['user_gender']);

    // 构造SQL语句
    $sql = "UPDATE users SET 
            username='$username', 
            email='$email', 
            phone='$phone', 
            user_birthday='$user_birthday', 
            user_gender='$user_gender' 
            WHERE id='$userId'";

    // 执行SQL语句
    if ($conn->query($sql) === TRUE) {
        // 更新会话变量
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['user_birthday'] = $user_birthday;
        $_SESSION['user_gender'] = $user_gender;

        // 弹窗提示并重定向
        echo "<script>alert('資料成功更新!'); window.location.href='edit_profile.php';</script>";
    } else {
        // 如果SQL执行失败，显示错误信息
        echo "Error updating record: " . $conn->error;
    }
} else {
    // 如果必填字段有遗漏，提示错误
    echo "All fields are required!";
}
$conn->close();
?>

<?php
/* 註冊驗證 */
include 'config.php';  // 引入连接配置

if (isset($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm_password'])) {
    echo "All fields are set.<br>";
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Email is valid.<br>";
        if (preg_match('/^\d{10}$/', $_POST['phone'])) {
            echo "Phone is valid.<br>";
            // 檢查密碼長度及包含英文字母
            if (strlen($_POST['password']) >= 8 && preg_match('/[a-zA-Z]/', $_POST['password'])) {
                echo "Password length is valid and contains letters.<br>";
                if ($_POST['password'] === $_POST['confirm_password']) {
                    echo "Passwords match.<br>";

                    $username = $conn->real_escape_string($_POST['username']);
                    $email = $conn->real_escape_string($_POST['email']);
                    $phone = $conn->real_escape_string($_POST['phone']);
                    $password = $conn->real_escape_string($_POST['password']);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // 檢查用戶名是否已存在
                    $checkUsername = "SELECT username FROM users WHERE username='$username'";
                    $usernameResult = $conn->query($checkUsername);
                    if ($usernameResult->num_rows > 0) {
                        echo "<script>alert('用戶名已被註冊，請換一個。'); window.history.back();</script>";
                    } else {
                        // 檢查電子郵件是否已被註冊
                        $checkEmail = "SELECT email FROM users WHERE email='$email'";
                        $emailResult = $conn->query($checkEmail);
                        if ($emailResult->num_rows > 0) {
                            echo "<script>alert('這個電子信箱已被註冊!'); window.history.back();</script>";
                        } else {
                            $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
                            if ($conn->query($sql) === TRUE) {
                                echo "<script>alert('註冊成功！'); window.location.href='sign.php';</script>";
                            } else {
                                echo "<script>alert('註冊失敗，請稍後再試一次'); window.history.back();</script>";
                            }
                        }
                    }
                } else {
                    echo "<script>alert('請重新輸入密碼，確保他們一致性'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('密碼長度必須至少為8位且包含英文字母'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('電話號碼必須為10位數字'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('電子信箱格式不正確'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('請確保所有輸入都有符合規定'); window.history.back();</script>";
}

$conn->close();
?>

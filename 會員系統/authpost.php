<?php
session_start();

// 檢查是否已登入
if (!isset($_SESSION['username'])) {
    // 使用 JavaScript 彈出提示框並重定向到登入頁面
    echo "<script>alert('使用討論串，需要先登入系統'); window.location.href='/小專檔案/會員系統/sign.php';</script>";
    exit; // 終止後續代碼執行
}

function getUserDisplayName() {
    return htmlspecialchars($_SESSION['username']);
}

function getUserProfileLink() {
    return "/小專檔案/會員系統/edit_profile.php";
}
?>

<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>alert('使用討論串，需要先登入系統'); window.location.href='/小專檔案/會員系統/sign.php';</script>";
    exit; 
}

function getUserDisplayName() {
    return htmlspecialchars($_SESSION['username']);
}

function getUserProfileLink() {
    return "/小專檔案/會員系統/edit_profile.php";
}
?>

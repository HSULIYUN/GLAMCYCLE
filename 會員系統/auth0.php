<?php
session_start();

function getUserDisplayName() {
    if (isset($_SESSION['username'])) {
        return htmlspecialchars($_SESSION['username']);
    } else {
        return '點此登入';
    }
}

function getUserProfileLink() {
    return isset($_SESSION['username']) ? "/小專檔案/會員系統/edit_profile.php" : "/小專檔案/會員系統/sign.php";
}
?>

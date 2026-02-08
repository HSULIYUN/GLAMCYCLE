<?php
// logout.php
session_start();
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session

echo "<script>alert('已登出 感謝使用！'); window.location.href='sign.php';</script>";
?>

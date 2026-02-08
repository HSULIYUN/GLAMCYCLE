<?php
/* 確認使用者驗證碼是否輸入正確 */
session_start();
header('Content-Type: application/json');

$user_input = isset($_POST['captcha']) ? $_POST['captcha'] : '';
$response = ['success' => false];

if (isset($_SESSION['captcha']) && strtolower($user_input) == strtolower($_SESSION['captcha'])) {
    $response['success'] = true;
}

echo json_encode($response);
?>

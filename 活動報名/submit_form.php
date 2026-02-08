<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php'; // 包含您的數據庫連接腳本

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單數據
    $name = $_POST['name'];
    $phone = $_POST['num']; // 注意，表單中的名稱是 'num'，非 'phone'
    $email = $_POST['email'];
    $notes = $_POST['notes'];
    $event_name = $_POST['event_name'];  // 添加的行，從表單中獲取活動名稱

     // 預備語句來插入數據
     $stmt = $conn->prepare("INSERT INTO registrations (event_name, full_name, phone_number, email, notes) VALUES (?, ?, ?, ?, ?)");
     $stmt->bind_param("sssss", $event_name, $name, $phone, $email, $notes);
     $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // 注意：這裡在JavaScript語句結束後添加了分號，並且確保PHP代碼使用了正確的語法。
        echo "<script>alert('報名成功');window.history.back();</script>";
    } else {
        echo "報名失敗: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "請通過正確方式提交表單。";
}
?>

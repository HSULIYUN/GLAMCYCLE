<?php
// 檢查是否提交了表單
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 資料庫連接
    $servername = "localhost"; // 資料庫主機名稱
    $username = "root"; // 資料庫使用者名稱
    $password = ""; // 資料庫密碼
    $dbname = "cycle"; // 資料庫名稱
    $port = 3308; // 資料庫端口

    // 建立資料庫連接
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // 檢查連接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 準備並綁定參數
    $stmt = $conn->prepare("INSERT INTO volunteers (full_name, email_address, phone_number, volunteer_option) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $full_name, $email_address, $phone_number, $volunteer_option);

    // 設置參數並執行
    $full_name = $_POST['full_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    // 檢查 volunteer_option 是否被設定，並給予一個預設值（例如：'未選擇'）以防止 null
    $volunteer_option = isset($_POST['volunteer_option']) ? $_POST['volunteer_option'] : '未選擇';

    if ($stmt->execute() === TRUE) {
        // 成功執行後重定向到指定頁面
        header("Location: 送出/index.html");
        exit;
    } else {
        // 如果執行不成功，則顯示錯誤
        die("錯誤: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>

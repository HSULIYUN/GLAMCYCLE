<?php
include 'db.php'; // 引入数据库配置

// 處理刪除請求
if (isset($_POST['delete'])) {
    $store_code = $_POST['store_code'];
    $conn->query("DELETE FROM store WHERE store_code = '$store_code'");
}

// 處理新增或更新請求
if (isset($_POST['save'])) {
    $store_code = $conn->real_escape_string($_POST['store_code']);
    $address = $conn->real_escape_string($_POST['address']);
    $business_hours = $conn->real_escape_string($_POST['business_hours']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    if ($_POST['original_code']) {
        // 更新現有店鋪
        $conn->query("UPDATE store SET address='$address', business_hours='$business_hours', phone_number='$phone_number' WHERE store_code='$_POST[original_code]'");
    } else {
        // 新增店鋪
        $conn->query("INSERT INTO store (store_code, address, business_hours, phone_number) VALUES ('$store_code', '$address', '$business_hours', '$phone_number')");
    }
}

// 獲取所有店鋪
$result = $conn->query("SELECT * FROM store");

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>後臺管理 | GLAMCYCLE</title>
    <link rel="icon" type="image/png" href="pic/GClogo.png">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-control:focus {
            border-color: #4a00e0;
            box-shadow: 0 0 8px rgba(74, 0, 224, 0.5);
        }
        .btn-primary, .btn-danger, .btn-success {
            margin-top: 10px;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .top-button {
            position: absolute;
            top: 20px;
            left: 50px;
            color:#496989;
            font-weight: bold;
            font-size:20px;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<a href="index.php" class="btn  top-button">⇐返回首頁</a>
    <div class="container" style="margin-top:100px;">
        <h2>店鋪管理</h2>        
        <form action="store_admin.php" method="post">
            <input type="hidden" name="original_code" value="">
            <div class="mb-3">
                <label for="store_code" class="form-label">店鋪代碼</label>
                <input type="text" class="form-control" id="store_code" name="store_code" value="" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">地址</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="business_hours" class="form-label">營業時間</label>
                <input type="text" class="form-control" id="business_hours" name="business_hours" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">電話號碼</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <button type="submit" name="save" class="btn btn-success">保存</button>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>店鋪代碼</th>
                    <th>地址</th>
                    <th>營業時間</th>
                    <th>電話號碼</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['store_code']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['business_hours']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td>
                        <button onclick="editStore('<?php echo $row['store_code']; ?>', '<?php echo addslashes($row['address']); ?>', '<?php echo addslashes($row['business_hours']); ?>', '<?php echo addslashes($row['phone_number']); ?>')" class="btn btn-primary">編輯</button>
                        <form action="store_admin.php" method="post" style="display:inline;">
                            <input type="hidden" name="store_code" value="<?php echo $row['store_code']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">刪除</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    function editStore(code, address, business_hours, phone_number) {
        document.querySelector('input[name="original_code"]').value = code;
        document.querySelector('input[name="store_code"]').value = code;
        document.querySelector('input[name="address"]').value = address;
        document.querySelector('input[name="business_hours"]').value = business_hours;
        document.querySelector('input[name="phone_number"]').value = phone_number;
    }
    </script>
</body>
</html>
<?php
$conn->close();
?>

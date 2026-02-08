<?php
include 'db.php'; // 引入数据库配置

// 處理刪除請求
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM admin_users WHERE id = $id");
}

// 處理新增或更新請求
if (isset($_POST['save'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $admin_number = $conn->real_escape_string($_POST['admin_number']);
    $id = $_POST['id'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 密碼加密
        $updatePwd = ", password='$password'";
    } else {
        $updatePwd = "";
    }
    if ($id) {
        // 更新現有帳號
        $conn->query("UPDATE admin_users SET username='$username', full_name='$full_name', admin_number='$admin_number' $updatePwd WHERE id=$id");
    } else {
        // 新增帳號
        $conn->query("INSERT INTO admin_users (username, full_name, admin_number, password) VALUES ('$username', '$full_name', '$admin_number', '$password')");
    }
}

// 獲取所有帳號
$result = $conn->query("SELECT * FROM admin_users");

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
        <h2>管理員帳號管理</h2>        
        <form action="admin.php" method="post">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="username" class="form-label">用戶名</label>
                <input type="text" class="form-control" id="username" name="username" value="" required>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">全名</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="admin_number" class="form-label">編號</label>
                <input type="text" class="form-control" id="admin_number" name="admin_number" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">密碼 (留空保持不變)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name="save" class="btn btn-success">保存</button>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>編號</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['admin_number']); ?></td>
                    <td>
                        <button onclick="editAccount('<?php echo $row['id']; ?>', '<?php echo $row['username']; ?>', '<?php echo $row['full_name']; ?>', '<?php echo $row['admin_number']; ?>')" class="btn btn-primary">編輯</button>
                        <form action="admin.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">刪除</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    function editAccount(id, username, full_name, admin_number) {
        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="username"]').value = username;
        document.querySelector('input[name="full_name"]').value = full_name;
        document.querySelector('input[name="admin_number"]').value = admin_number;
        // 將密碼欄位清空
        document.querySelector('input[name="password"]').value = '';
    }
    </script>
</body>
</html>
<?php
$conn->close();
?>

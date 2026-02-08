<?php
include 'db.php'; // 引入数据库配置

// 處理刪除請求
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM users WHERE id = $id");
}

// 處理新增或更新請求
if (isset($_POST['save'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']); // 添加电子邮件处理
    $phone = $conn->real_escape_string($_POST['phone']); // 添加电话处理
    $user_birthday = $conn->real_escape_string($_POST['user_birthday']); // 添加生日处理
    $user_gender = $conn->real_escape_string($_POST['user_gender']); // 添加性别处理
    $id = $_POST['id'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 密碼加密
        $updatePwd = ", password='$password'";
    } else {
        $updatePwd = "";
    }
    if ($id) {
        // 更新現有帳號
        $conn->query("UPDATE users SET username='$username', email='$email', phone='$phone', user_birthday='$user_birthday', user_gender='$user_gender' $updatePwd WHERE id=$id");
    } else {
        // 新增帳號
        $conn->query("INSERT INTO users (username, email, phone, password, user_birthday, user_gender) VALUES ('$username', '$email', '$phone', '$password', '$user_birthday', '$user_gender')");
    }
}

// 獲取所有帳號
$result = $conn->query("SELECT * FROM users");
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
        <h2>會員資料管理</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="username" class="form-label">用戶名</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">電子郵件</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">電話</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="user_birthday" class="form-label">生日</label>
                <input type="date" class="form-control" id="user_birthday" name="user_birthday">
            </div>
            <div class="mb-3">
                <label for="user_gender" class="form-label">性別</label>
                <select class="form-control" id="user_gender" name="user_gender">
                    <option value="">請選擇</option>
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
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
                    <th>ID</th>
                    <th>用戶名</th>
                    <th>郵件</th>
                    <th>電話</th>
                    <th>生日</th>
                    <th>性別</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo empty($row['user_birthday']) ? '未填寫' : htmlspecialchars($row['user_birthday']); ?></td>
                    <td><?php echo empty($row['user_gender']) ? '未填寫' : htmlspecialchars($row['user_gender']); ?></td>
                    <td>
                        <button onclick="editAccount('<?php echo $row['id']; ?>', '<?php echo addslashes($row['username']); ?>', '<?php echo addslashes($row['email']); ?>', '<?php echo addslashes($row['phone']); ?>', '<?php echo addslashes($row['user_birthday']); ?>', '<?php echo addslashes($row['user_gender']); ?>')" class="btn btn-primary">編輯</button>
                        <!-- 移除刪除按鈕 -->
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    function editAccount(id, username, email, phone, user_birthday, user_gender) {
        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="username"]').value = username;
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="phone"]').value = phone;
        document.querySelector('input[name="user_birthday"]').value = user_birthday;
        document.querySelector('select[name="user_gender"]').value = user_gender;
        document.querySelector('input[name="password"]').value = ''; // 將密碼欄位清空
    }
    </script>
</body>
</html>
<?php
$conn->close();
?>

<?php include 'auth0.php'; ?>

<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>編輯會員資料 | GLAMCYCLE</title>
<link rel="icon" type="icon" href="icon/gc.png" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        max-width: 600px;
        margin: auto;
        margin-top: 60px  !important;
    }
    .form-label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #8E7AB5 !important;
        border: none !important;
        width: 100%;
        height: 80px;
        padding: 10px;
        border-radius: 5px;
        font-size:20px !important;
        font-weight: bold !important;
        margin-top: 10px  !important;
        margin-bottom: 10px  !important;
        
    }
    .navbar {
            position: -webkit-sticky; 
    position: sticky;
    top: 0;
    z-index: 1000;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.6); 
    box-shadow: 0 2px 5px rgba(0,0,0,0.2); 
    font-weight: bold;
    
}


        .navbar-nav .nav-link {
            color: #7D7C7C;
            font-size:20px; 
            margin-right: 25px;
            
        }
        .user-name {
          color: #7D7C7C;
            font-size:20px;
            margin-right: 25px;
        }
        .user-avatar {
            width: 60px; 
            height: 60px; 
        }
        .navbar-brand img {
            width: 80px; 
            height: 52px; 
        }
        body {
        background-image: url('會員註冊_登入/back1.png');
        background-size: cover;
        background-attachment: fixed;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <!-- 導航欄 -->
     <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
       
        <a class="navbar-brand" href="../首頁網站/index.php">
            <img src="下拉式選單圖片/logo.png" alt="Company Logo" width="30" height="24" class="d-inline-block align-text-top">
        </a>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="../活動首頁/event.php">最新活動</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../討論串03/index.php">討論串</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../donate/000/捐款.php">捐款</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        過期化妝品專區
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../關於過期化妝品/index.php">怎麼回收?</a></li>
                        <li><a class="dropdown-item" href="../門市/store.php">回收門市查詢</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../志工報名/a.php">成為志工</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../意見回饋/feedback.php">意見回饋</a>
                </li>
            </ul>
                  
                  <div class="d-flex">
               <img src="圖片/1.png" alt="User Avatar" class="rounded-circle user-avatar me-2">
               <a href="<?php echo getUserProfileLink(); ?>" class="align-self-center user-name" style="text-decoration: none;">
                  <?php echo getUserDisplayName(); ?>
               </a>
            </div>
        <!-- Existing user display code -->
        <!-- Logout Button -->
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-warning" style="margin-left: 10px;margin-right: 10px;background-color:black;border: none;color:white;height:50px;width: 100px;">登出</button>
        </form>
    </div>
              </div>
          </div>
      </nav>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center mb-4" style="color:#8E7AB5;font-weight: bold;">編輯會員資料</h2>
        <form action="update_profile.php" method="post" >
            <div class="mb-3">
                <label for="username" class="form-label" >用戶名稱</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">電子信箱</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">電話</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_birthday" class="form-label">使用者生日</label>
                <input type="date" id="user_birthday" name="user_birthday" class="form-control" value="<?php echo isset($_SESSION['user_birthday']) ? htmlspecialchars($_SESSION['user_birthday']) : ''; ?>" required>
            </div>

           <div class="mb-3">
                <label for="user_gender" class="form-label">使用者性別</label>
                <select id="user_gender" name="user_gender" class="form-control">
                   <option value="男">男</option>
                   <option value="女">女</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">更新資料</button>
        </form>
    </div>
</div>
</body>
</html>


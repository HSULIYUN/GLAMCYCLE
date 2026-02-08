<?php include '../會員系統/authpost.php'; ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Glamcycle 討論串 - 環保回收和化妝品討論社區" />
    <meta name="author" content="" />
    <title>討論串 | GLAMCYCLE</title>
    <!-- Favicon-->
    <link rel="icon" type="icon" href="icon/gc.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        background-image: url('assets/cc.png');
        background-size: cover;
        background-attachment: fixed;
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
    .card-img-top {
        width: 100%; /* Make the image fully responsive */
        height: auto;
        max-height: 200px;
        object-fit: cover;
    }
    .btn btn-primary{
        background-color: #4a4a4a;
    }
    
</style>
<body>
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
               <img src="下拉式選單圖片/1.png" alt="User Avatar" class="rounded-circle user-avatar me-2">
               <a href="<?php echo getUserProfileLink(); ?>" class="align-self-center user-name" style="text-decoration: none;">
                  <?php echo getUserDisplayName(); ?>
               </a>
            </div>
        </div>
    </div>
</nav>


<header class="text-center my-5"><img src="assets/PP.png" alt="Glamcycle 討論串" id="header-image" style="width: 300px;"></header>
<div class="container">
    <div class="row">
    <div class="col-lg-8">
    <?php
    $conn = new mysqli("localhost", "root", "", "cycle", 3308);
    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
    }

    $sql = "SELECT *, DATE_FORMAT(date_posted, '%Y-%m-%d') as date_posted FROM posts ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "SQL 錯誤: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $date_posted = isset($row['date_posted']) ? $row['date_posted'] : 'No date provided';
                $preview = mb_substr($row["content"], 0, 20) . '...'; // 文章预览
                echo '<div class="card mb-4" style="border-color: #4a4a4a;">';
                echo '<a href="#!"><img class="card-img-top" src="' . $row["image_path"] . '" alt="Post Image"></a>';
                echo '<div class="card-body">';
                echo '<div class="small text-muted">' . $date_posted . '</div>';
                echo '<h2 class="card-title h4">' . $row["title"] . '</h2>';
                echo '<p class="card-text">' . $preview . '</p>';
                echo '<a class="btn btn-primary" target="_blank" style="background-color: #4a4a4a;border-color: #4a4a4a;" href="article.php?id=' . $row["id"] . '" >查看詳細貼文 →</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '沒有文章。';
        }
    }
    $conn->close();
    ?>
</div>

        <div class="col-lg-4">
            <!-- 發文按鈕 -->
            <div class="button_container">
                <a href="sendpost.php" class="PostBTN" target="_blank"><span>發文點我</span></a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>

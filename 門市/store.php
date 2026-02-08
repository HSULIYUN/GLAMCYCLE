<?php include '../會員系統/auth0.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="icon" href="icon/gc.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
// Define the title image and echo it out.
$imagePath = 'logo.png';
$image1Path = 'logo.png';
$imageSizeStyle = 'style="width: 200px;"'; // Set only the width
$title = "<img src='$imagePath' alt='Logo' $imageSizeStyle> ";

?>


<form action="store.php" method="post">



    <style>
        body {
            background-color:white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .p1 {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            margin-top:10px;
            color:#607274;
        }
        .search-container {
            position: relative; /* 修改成 relative 以避免覆蓋 */
            max-width: 1000px;
            margin: auto; /* 使搜尋框居中 */
            display: flex;
            justify-content: center; /* 居中 Flex 子元素 */
            padding-top: 20px;
        }
        #search {
            padding: 10px;
            border: 2px solid #9BB8CD;
            border-radius: 5px;
            width: 50%; /* 調整寬度以適應不同屏幕 */
            font-size: 20px;
            font-weight: bold;
           
        }
        button {
            padding: 10px;
            border: 2px solid #9BB8CD;
            background-color: #fff; /* 背景設為白色 */
            color: #9BB8CD;
            border-radius: 5px;
            margin-left: 8px;
            font-size: 20px;
            font-weight: bold;
            background-image: url(favicon.ico);
            background-repeat: no-repeat;
        }
        .sc1 {
            display: flex;
            justify-content: center; /* 居中 Flex 子元素 */
            margin-top: 20px;
        }
        .sc1 select {
            height: 50px;
            width: 50%; /* 調整寬度 */
            border: 2px solid #9BB8CD;
            color: #757575;
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
        }
        .store-info {
            text-align: center;
            margin: 40px auto; /* 居中顯示 */
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #9BB8CD;
            border-radius: 15px; /* 圓角邊框 */
            padding: 50px;
            width: 70%; /* 調整寬度 */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* 添加陰影 */
            background-color: #fff; 
        }
        .store-info h2 {
            margin-top:-20px;
            font-size: 30px;
        }
        .store-info p {
            text-align: left; /* 左對齊文本 */
            margin-left: 20px; /* 添加左邊距 */
            color: #776B5D;
        }
        .image1{
            margin-top:20px;
            width: 200px;
            display: block;
            margin-left: auto;
            margin-right: auto;
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
    </style>
</head>
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

<div class="bk1">
<?php echo "<img src='$image1Path' alt='活動圖片'class='image1'>"; ?>
    <p class="p1">過期化妝品合作門市</p>
       

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="sc1">
            <select id="select-box" name="city">
                <option value="">點此查看全台合作門市</option>
                <option value="基隆市">基隆市</option>
                <option value="南投縣">南投縣</option>
                <option value="台中市">台中市</option>
                <option value="台北市">台北市</option>
                <option value="台南市">台南市</option>
                <option value="台東市">台東市</option>
                <option value="澎湖縣">澎湖縣</option>
                <option value="嘉義市">嘉義市</option>
                <option value="宜蘭縣">宜蘭縣</option>
                <option value="屏東縣">屏東縣</option>
                <option value="彰化縣">彰化縣</option>
                <option value="新北市">新北市</option>
                <option value="新竹市">新竹市</option>
                <option value="桃園市">桃園市</option>
                <option value="花蓮縣">花蓮縣</option>
                <option value="苗栗縣">苗栗縣</option>
                <option value="金門縣">金門縣</option>
                <option value="雲林縣">雲林縣</option>
                <option value="高雄市">高雄市</option>
            </select>
            <button type="submit">⠀⠀</button>
        </div>
    </form>
</div>

<!-- 門市資訊部分，現在位於搜尋框下方 -->
<?php include 'store-1.php'; ?> <!-- 引入門市資料庫 -->

<?php
$sql = "SELECT address, phone_number, business_hours FROM store"; // 根據您的資料表結構調整

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['city'])) {
    $selectedCity = $_POST['city'];

    // 準備 SQL 查詢以選擇特定城市的門市
    $sql = "SELECT address, phone_number, business_hours FROM store WHERE address LIKE CONCAT('%', ?, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedCity);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // 執行預設的 SQL 查詢
    $result = $conn->query($sql);
}


?>

</body>
</html>
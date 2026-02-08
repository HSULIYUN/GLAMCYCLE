<?php
$servername = "localhost";
$username = "root"; // 你的数据库用户名
$password = ""; // 你的数据库密码
$dbname = "cycle"; // 你的数据库名称
$port = 3308; // 指定端口号

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 检测连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取URL参数id
$eventId = isset($_GET['id']) ? intval($_GET['id']) : 0; // 如果没有提供id或id不是整数，将返回0

// 使用参数绑定来防止SQL注入
if ($eventId > 0) { // 确保ID有效
    $stmt = $conn->prepare("SELECT small_title, title, biography, bio, long_title, introduction, information, author_intro, feature_1, feature_1_note, feature_1_name, feature_2, feature_2_note, feature_2_name, feature_3, feature_3_note, feature_3_name, feature_4, feature_4_note, feature_4_name, features_img_url, event_img_path, author_img_path, registration_start, registration_end, notice FROM exhibition_details WHERE id = ?");
    $stmt->bind_param("i", $eventId); // 绑定参数
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $small_title = $row["small_title"];
        $title = $row["title"];
        $biography = $row["biography"];
        $bio = $row["bio"];
        $long_title = $row["long_title"];
        $introduction = $row["introduction"];
        $information = $row["information"];
        $author_intro = $row["author_intro"];
        $event_img_path = $row["event_img_path"];
        $feature_1 = $row["feature_1"];
        $feature_1_note = $row["feature_1_note"];
        $feature_2_name = $row["feature_2_name"];
        $feature_1_name = $row["feature_1_name"];
        $feature_2 = $row["feature_2"];
        $feature_2_note = $row["feature_2_note"];
        $feature_3_name = $row["feature_3_name"];
        $feature_3 = $row["feature_3"];
        $feature_3_note = $row["feature_3_note"];
        $feature_4_name = $row["feature_4_name"];
        $feature_4 = $row["feature_4"];
        $feature_4_note = $row["feature_4_note"];
        $notice = $row["notice"];
        $features_img_url = $row["features_img_url"];
        $author_img_path = $row["author_img_path"];
        $registration_start = $row["registration_start"];
        $registration_end = $row["registration_end"];
    } else {
        echo "No event found with the given ID."; // 根据实际情况调整错误处理
    }
    $stmt->close();
} else {
    echo "Invalid event ID."; // 根据实际情况调整错误处理
}
// 确定正确的时区
date_default_timezone_set('Asia/Taipei');

// 创建 DateTime 对象
if (isset($registration_start) && isset($registration_end)) {
    $registration_start_dt = new DateTime($registration_start);
    $registration_end_dt = new DateTime($registration_end);

    // 获取当前时间
    $now = new DateTime();

    // 比较时间
    $registration_open = ($now >= $registration_start_dt && $now <= $registration_end_dt);
} else {
    $registration_open = false;
}

$conn->close();

include '../../會員系統/auth0.php'; 
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $small_title; ?> | GLAMCYCLE</title>
    <link rel="stylesheet" href="metal.css">
    <link rel="icon" type="icon" href="icon/gc.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">

    
    
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>

</style>
<body style="font-family: 'Noto Serif TC', serif;font-family: 'Times New Roman', serif;">
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
       
        <a class="navbar-brand" href="../../首頁網站/index.php">
            <img src="下拉式選單圖片/logo.png" alt="Company Logo" width="30" height="24" class="d-inline-block align-text-top">
        </a>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="../../活動首頁/event.php">最新活動</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../討論串03/index.php">討論串</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../donate/000/捐款.php">捐款</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        過期化妝品專區
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../關於過期化妝品/index.php">怎麼回收?</a></li>
                        <li><a class="dropdown-item" href="../../門市/store.php">回收門市查詢</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../志工報名/a.php">成為志工</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../意見回饋/feedback.php">意見回饋</a>
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
    <div class="title-container">
        <div class="title-container1">
            <div class="container">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>⠀&gt;⠀</span>
                <span ><a href="../event.php">最新活動</a></span>
                <span>⠀&gt;⠀</span>
                <span><a  style="text-decoration:none;color: black;"><?php echo $small_title; ?></a></span>
            </div>
            <h1 class="event-title slide-in"><span style="font-family: 'Noto Serif TC', serif;"><?php echo $small_title; ?></h1></span>

        </div>
        <div class="block">
    <?php if ($registration_open): ?>
        <div class="hovicon effect-1 sub-a" onclick="register()">點我<br>報名</div>
    <?php else: ?>
        <div class="hovicon effect-1 sub-a" style="opacity: 0.5; cursor: not-allowed;">報名<br>未開放</div>
    <?php endif; ?>
</div>



    </div>
    <div class="div02">
        <h1 class="event-title float-up" style="font-family: 'Noto Serif TC', serif;"><?php echo $long_title; ?></h1>
    </div>

    

    <div class="div03" style="margin-top:100px;">
        <div class="centered-content">
            <h2 style="font-family: 'Noto Serif TC', serif;">活動資訊</h2>
            <hr style="border-top: 1px solid #4B527E;width: 30%;opacity: 100%;"> <!-- 這裡添加了一條直線 --></hr>
        </div>
    </div>

    
    <div class="div06">
        <p class="float-up" style="font-family: 'Noto Serif TC', serif;color: black;"><?php echo $information; ?></p>  
    </div>
    
    <div class="co1">
        <!-- 再新增一個空div用於額外的線 -->
        <img src="<?php echo htmlspecialchars($event_img_path); ?>" alt="Event Images" >
    </div>
    <div class="div01" style="margin-top:-100px"></div>

    <div class="div03">
        <div class="centered-content">
            <h2 style="font-family: 'Noto Serif TC', serif;">活動介紹</h2>
            <hr style="border-top: 1px solid #4B527E;width: 30%;opacity: 100%;"> <!-- 這裡添加了一條直線 --></hr>
        </div>
    </div>
    
    
    <div class="div04">
       <p class="float-up" style="font-family: 'Noto Serif TC', serif;"><?php echo $introduction; ?></p>
    </div>

    


    
    <div class="div03">
    <div class="centered-content" style="margin-top:-50px;">
        <h2 style="font-family: 'Noto Serif TC', serif;"><?php echo $title; ?></h2>
        <hr style="border-top: 1px solid #4B527E;width: 30%;opacity: 100%;">
    </div>
</div>
<div class="div08">
    <img  src="<?php echo $author_img_path; ?>" >
    <span class="float-up" style="font-size: 40px; font-family: 'Noto Serif TC', serif;"><?php echo $bio; ?></span>
    <p class="float-up" style="font-family: 'Noto Serif TC', serif;"><?php echo $author_intro; ?></p>
    <span class="float-up" style="font-size: 20px; color: #4B527E; font-family: 'Noto Serif TC', serif;"><?php echo $biography; ?></span>
</div>

    

<div class="div03" style="margin-top:200px;">
    <div class="centered-content">
        <h2 style="font-family: 'Noto Serif TC', serif;" >活動特色</h2>
        <hr style="border-top: 1px solid #4B527E;width: 30%;opacity: 100%;" class="float-up">
    </div>
</div>

<div class="div05" style="margin-top:50px;">
    <img class="float-up" src="<?php echo $features_img_url; ?>" >
</div>

<div class="div06">
    <p class="float-up" style="font-family: 'Noto Serif TC', serif;color:black;">
        <span style="font-size: 24px;color: #4B527E;"><?php echo $feature_1_name; ?><br><br></span>
        <?php echo $feature_1; ?><br><br>
        <span style="font-size: 16px;color: #4B527E;"><?php echo $feature_1_note; ?><br><br></span>
        <br>⠀<br>

        <span style="font-size: 24px;color: #4B527E;"><?php echo $feature_2_name; ?><br><br></span>
        <?php echo $feature_2; ?><br><br>
        <span style="font-size: 16px;color: #4B527E;"><?php echo $feature_2_note; ?><br><br></span>
        <br>⠀<br>

        <span style="font-size: 24px;color: #4B527E;"><?php echo $feature_3_name; ?><br><br></span>
        <?php echo $feature_3; ?><br><br>
        <span style="font-size: 16px;color: #4B527E;"><?php echo $feature_3_note; ?><br><br></span>
        <br>⠀<br>

        <span style="font-size: 24px;color: #4B527E;"><?php echo $feature_4_name; ?><br><br></span>
        <?php echo $feature_4; ?><br><br>
        <span style="font-size: 16px;color: #4B527E;"><?php echo $feature_4_note; ?><br><br></span>
        <br>⠀<br>
    </p>
</div>



    

    <div class="div03">
        <div class="centered-content" style="margin-top:-50px;">
            <h2 style="font-family: 'Noto Serif TC', serif;">注意事項</h2>
            <hr style="border-top: 1px solid #4B527E;width: 30%;opacity: 100%;"> <!-- 這裡添加了一條直線 --></hr>
        </div>
    </div>


    <div class="div10">
        <div class="centered-content">
            <p style="font-family: 'Noto Serif TC', serif; color: black;"><?php echo $notice; ?></p>
        </div>
    </div>
    
    
    

    
</body>
<script src="metal0.js"></script>
<script>
function register() {
    // 使用 PHP 變量來構造 URL
    var url = 'http://localhost:8080/小專檔案/活動報名/index.php?id=<?php echo $eventId; ?>';

    // 在新標籤中打開 URL
    window.open(url, '_blank');
}


    function fadeIn(element, duration = 500, delay = 0) {
    setTimeout(() => {
        let opacity = 0;
        element.style.opacity = opacity;
        element.style.visibility = 'visible'; // 使用visibility

        const step = duration / 60; // 假设每秒60帧
        const fade = function() {
            opacity += 1 / (duration / step);
            element.style.opacity = opacity;

            if (opacity < 1) {
                requestAnimationFrame(fade);
            }
        };

        fade();
    }, delay); // 等待延迟时间后开始执行动画
}

document.addEventListener("DOMContentLoaded", function() {
    var options = {
        threshold: 0.1
    };

    var observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // 应用淡入动画至目标元素，设置不同的持续时间和延迟
                fadeIn(document.querySelector('.additional-line0'), 1000, 0);
                fadeIn(document.querySelector('.co1 img'), 1000, 500); // 持续时间1000ms, 无延迟
                fadeIn(document.querySelector('.additional-line'), 1000, 500); // 持续时间1000ms, 延迟500ms
                fadeIn(document.querySelector('.additional-line1'), 1000, 1000); // 持续时间1000ms, 延迟1000ms

                observer.unobserve(entry.target);
            }
        });
    }, options);

    // 选择实际的元素进行观察
    observer.observe(document.querySelector('.div01'));
});



</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

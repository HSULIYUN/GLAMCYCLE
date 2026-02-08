<?php include '../../會員系統/auth0.php'; ?>
<?php
$host = 'localhost';
$username = 'root';
$password = ''; // 將這裡的值更換為實際的密碼
$database = 'cycle';
$port = 3308; // 添加了新的端口號變量

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 查詢總捐款金額
$totalQuery = "SELECT SUM(mon) AS total FROM donations";
$result = $conn->query($totalQuery);
$totalDonations = $result->fetch_assoc()['total'];

if ($totalDonations === null) {
    $totalDonations = 0;
}

$conn->close();
?>
<!doctype html>
<html lang="zh-tw">
<!-- 資料庫連接 -->
<form name="info" method="post" action="submit_donation.php">
<head>
    <link rel="icon" type="icon" href="icon/gc.png" />
    <meta charset="utf-8">
    
    <meta name="viewport" contentl="width=device-width, initial-scale=1">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    
    

    <title>捐款 | GLAMCYCLE</title>
    <style>
        /* 導覽欄樣式 */
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

        .carousel-item-next.carousel-item-left, .carousel-item-prev.carousel-item-right {
            transform: scale(0.95); /* 縮小效果（可選） */
            opacity: 0.5; /* 淡化到的目標不透明度 */
        }
        /* 輪播圖容器樣式 */
        .carousel {
            margin-top: 0px; /* 顶部间距 */
        }
        
         /* 輪播圖圖像樣式 */
         .carousel-item img {
            width: 50%; /* 圖片寬度減半 */
            height: 50%; /* 圖片高度減半 */
            object-fit: cover; /* 圖片填充方式 */

        }
        .carousel-item {
            position: relative;
            width: 50%; 
            height: 50%; 
            transition: transform 0.05s ease, opacity 0.05s ease;
        }

        /* 表單樣式 */

        .container {
            display: flex;
            width: 100%;
        }
        .c1 {
            width: 500px;
            flex: 0 0 auto;
        }
      
        .content {
            text-align: center;
            margin-top: 20px;
        }
        
        /* 初始动画效果 */
@keyframes fadeInScale {
  0% {
    transform: scale(0.5);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}




        .welcome-section {
          font-family: Arial, sans-serif;
          
          padding: 20px;
          margin: 20px 0;
          position: relative;
          top: 50px;
          width: 100%; 
          left: 50%;
          transform: translateX(-50%);
        }
.statistics {
    display: flex; /* 添加这行 */
    flex-wrap: wrap; /* 如果你希望在容器不够宽时，项目能够换行显示 */
    margin-top: 20px;
}

.volunteers {
    display: flex;
    justify-content: center; /* 水平居中 */
    align-items: center;
    width: 100%; /* 让它占满整个容器宽度 */
}

.text-content {
    display: block;
    margin-left: 20px;
}

.number {
    font-size: 2em;
    font-weight: bold;
}
.number1 {
    font-size: 2em;
    font-weight: bold;
}
.label {
    font-size: 1em;
    font-weight: bold;
}
.statistics .volunteers:nth-child(2) {
    margin-left: 200px;
}
.statistics .volunteers:nth-child(1) {
    margin-left: 300px;
}
/* 新增的 CSS 類別 */
.donation-intro {
    text-align: center; /* 使文字置中 */
    padding: 20px; /* 添加一些內邊距 */
    margin: 20px 0; /* 上下各添加一些外邊距，左右為自動(auto) */

}


.info {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 950px;
    width: 70%;
    background-color: #fff;
    border: #86B6F6 3px solid;
    margin: 0 auto;
    margin-top: 150px;
    margin-bottom: 150px;
    border-radius: 50px;
    flex-direction: column; /* 将内容排列方式改为垂直方向 */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); 
}

.info form {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%; /* 让表单占满.info容器的宽度 */
}

.left-side, .right-side {
    display: flex;
    flex-direction: column;
    transform: translateY(-100px); /* 往上移动 */
}


.input-field {
    position: relative;
    width: 250px;
    height: 44px;
    line-height: 44px;
    margin-bottom: 60px; /* 间距调整 */

}

input[type="text"],
input[type="password"],
input[type="number"],
input[type="email"],
textarea {
    width: 400px;
    border: 0;
    outline: 0;
    padding: 0.5rem 0;
    border-bottom: 2px solid #4B527E;
    box-shadow: none;
    color: #111;
    background-color: transparent;
}
.right-side {
    
    margin-left: 350px;
    margin-top: -400px;
}
.left-side {
    margin-right: 650px; 
    margin-top: -400px;
}

input:focus,
input:valid,
textarea:focus,
textarea:valid {
    border-color: black;
}

label {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    color: #4B527E;
    transition: 0.2s all;
    cursor: text;
}

input:focus ~ label,
input:valid ~ label,
textarea:focus ~ label,
textarea:valid ~ label {
    font-size: 14px;
    top: -24px;
    color: black;
}
.input-field input::placeholder {
    color: #4B527E; /* 设置占位符文本的颜色 */
    opacity: 1; /* 确保占位符文本始终可见 */
}

.input-field input:focus::placeholder,
.input-field input:valid::placeholder {
    color: transparent; /* 聚焦时或输入有效时隐藏占位符文本 */
}

.input-field input:focus ~ label[for="eeee"]::after,
.input-field input:valid ~ label[for="eeee"]::after {
    content: "MM/YY"; /* 在输入框下方添加内容 */
    color: #4B527E; /* 设置颜色 */
    margin-left: 5px; /* 调整与输入框之间的距离 */
}

/* 定义默认样式 */
#submitBtn {
    align-self: center; /* 居中 */
    margin-top: 120px;
    margin-bottom: 50px;
    height: 90px; /* 调整距离上方的间距 */
    width: 400px;
    border:#4B527E 2px solid ;
    background-color: #86B6F6;
    color: #4B527E;
    font-size: 30px;
    font-weight: bold;
    border-radius: 50px;
    transition: background-color 0.3s, transform 0.3s;
}

/* 定义悬停时的样式 */
#submitBtn.hover-effect {
    background-color: #7C93C3;
    transform: scale(1.1);
}

.info .line-container {
    display: flex;
    align-items: center;
}

.info .line {
    flex-grow: 1; /* 让直线占据剩余的空间 */ /* 可选：调整直线与标题之间的间距 */
    border: none;
    border: #86B6F6 3px solid;
    border-bottom:none ;
    width: 100%;
    opacity: 100%;
    border-left:none ;
    border-right: none;
    margin-top: 10px;
}
body {
    background-image: url('圖片/背1-1.png'); /* 替换 'image.jpg' 为您实际图片的路径 */
    background-size: cover; /* 背景图片大小自适应 */
    background-position: center; /* 背景图片居中显示 */
    background-repeat: no-repeat; /* 防止背景图片重复 */
    
}
.button1 {
  display: inline-block;
  margin-left: 400px;
  margin-top: 10px;
  border: 2px #4B527E solid;
  width: 200px;
  height: 50px;
  border-radius: 50px;
  background-color: #fff;
  text-decoration: none;
  color: #4B527E;
  font-weight: bold;
  text-align: center;
  line-height: 50px; /* 使文本垂直居中 */
  cursor: pointer;
}

.button1:hover {
  background-color: #4B527E;
  color: #fff;
}
@media (max-width: 1300px) { /* 斷點設為768px，常用於平板裝置 */
    .container {
        flex-direction: column; /* 在較小螢幕上將容器改為垂直佈局 */
    }
    
    .info {
        width: 90%; /* 調整寬度以適應較小螢幕 */
        height: auto; /* 高度自適應 */
        margin-top: 50px; /* 調整邊距以適應較小螢幕 */
        margin-bottom: 50px;
    }
    
    .left-side, .right-side {
        flex-direction: column; /* 在較小螢幕上改為垂直佈局 */
        margin-top: 120px; /* 減少上邊距 */
        margin-left: 0; /* 去除左邊距 */
        margin-right: 0; /* 去除右邊距 */
    }
    
    .input-field input, .input-field textarea {
        width: 90%; /* 調整輸入框寬度以適應較小螢幕 */
    }
    
    #submitBtn {
        width: 90%; /* 調整按鈕寬度以適應較小螢幕 */
    }
}

@media (max-width: 480px) { /* 斷點設為480px，常用於手機裝置 */
    .navbar-nav .nav-link, .user-name {
        font-size: 18px; /* 在手機上減小字體大小 */
    }
    
    .carousel-item img {
        width: 100%; /* 在手機上調整輪播圖寬度 */
        height: auto; /* 高度自適應 */
    }
}

/* 原始樣式 */
.container {
    display: flex;
    width: 100%;
    flex-direction: row; /* 保持水平佈局 */
    flex-wrap: wrap; /* 允許子元素換行 */
}

/* 響應式斷點 */
@media (max-width: 768px) {
    .container {
        flex-direction: column; /* 在較小螢幕上將容器改為垂直佈局 */
        align-items: center; /* 中心對齊子元素 */
        padding: 20px; /* 添加一些內邊距 */
    }
}

@media (max-width: 480px) {
    .container {
        width: 100%; /* 在更小的螢幕上使用全寬 */
    }
}

/* 响应式调整 */

/* 响应式调整 */
@media (max-width: 1300px) {
    .statistics .volunteers:nth-child(2) {
        margin-left: 200px; /* 调整第二个子元素的左边距 */
        margin-top: 30px;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .statistics .volunteers:nth-child(1) {
        margin-left: -300px; /* 调整第一个子元素的左边距 */
        flex: 1 0 100%;
        justify-content: center;
        margin-right: 0;
    }
    .button1 {
        margin-top: -1000px; 
        margin-left: 500px;/* 调整按钮的左边距 */
    }
}


@media (max-width: 300px) {
    .statistics {
        width: 50%;
    }
}







/* 移除.volunteers的margin-top样式，因为已经在.statistics上统一设置了 */



/* 你可能需要根据实际情况调整这些样式 */




    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
   
</head>
<body>
    


<!-- 導航欄 -->
<!-- 下拉式選單 -->
<!-- 下拉式選單 -->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- 下拉式選單結束 -->


<!-- 下拉式選單結束 -->
<!-- 輪播圖 -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" >
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="圖片/捐款-1.png" class="d-block w-100" alt="png1">
           
        </div>
        <div class="carousel-item">
            <img src="圖片/捐款-2.png" class="d-block w-100" alt="png2">
        </div>
        <div class="carousel-item">
            <img src="圖片/捐款-3.png" class="d-block w-100" alt="png3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

<!-- 捐款表單 -->
<div class="container">
    <div class="welcome-section" >
        <h2 class="donation-intro" style="color:#4B527E;font-size: 50px;"><strong>立即捐款，讓您的愛心與我們一起發光發亮！</strong></h2>
        <div class="donation-intro" style="color: #7C93C3;font-size: 20px;font-weight: bold;" >
            <p>歡迎來到我們的捐款網站！我們致力於將這些不再使用的美麗工具轉化為有益於社會和環境的資源。我們的使命需要您的支持。</p>

            <p>您的每一筆捐款都將直接用於改善我們的回收流程、擴大我們的影響範圍，並支持我們與環保及社會福利組織的合作。</p>
            <p>您的慷慨將助我們一臂之力，讓過期化妝品獲得新生，並對抗浪費文化。</p>
        
            <p>無論捐款大小，我們都衷心感謝您的支持。您的參與不僅僅是對環境的貢獻，更是對可持續美麗新未來的投資。</p>
            <p>現在就行動吧！點擊下方的捐款按鈕，加入我們的行列，共同創造更美好的世界。</p>
        
        </div>
        
        <div class="statistics">
                
            </div>   

            <div class="volunteers">
                <img src="圖片/捐款金額.png" alt="png3" style="width: 100px;">
                <div class="text-content"> <!-- 新增加的容器 -->
                    <div class="number1" data-target="<?php echo $totalDonations; ?>" style="color: #4B527E;">0</div>
                    <div class="label"style="color: #4B527E;">已募款金額</div>
                </div>
            </div> 
                        
        </div>

    </div>
    




</div>

<div class="info">
    <h1 style=" font-weight: bold;margin-top: 20px;">捐款基本資料填寫</h1>
    <hr class="line">
    <form name="info" method="post" action="">

        <div class="left-side">
            <div class="input-field">
                <input type="text" id="name" name="name" required>
                <label for="name">姓名:</label>
            </div>
            <div class="input-field">
                <input type="password" id="pas" name="pas" required>
                <label for="pas">身份證:</label>
            </div>
            <div class="input-field">
                <input type="number" id="mon" name="mon" required>
                <label for="mon">捐款金額:(TWD)</label>
            </div>
            <div class="input-field">
                <input type="text" id="email" name="email" required>
                <label for="email">Email:</label>
            </div>
        </div>
        <div class="right-side">
            <div class="input-field">
                <input type="text" id="eee" name="eee" required>
                <label for="eee">信用卡帳號:</label>
            </div>
            <div class="input-field">
                <input type="text" id="eeee" name="eeee" required >
                <label for="eeee">信用卡到期日:</label>
            </div>
            
           <div class="input-field">
              <input type="password" id="safe" name="safe" required>
              <label for="safe">信用卡安全碼:</label>
              <p id="security-code-error" style="color: red;"></p>
            </div>
            <div class="input-field">
                <textarea id="place" name="place" rows="5" cols="40" required></textarea>
                <label for="place">備註:</label>
            </div>
        </div>

    </form>
    <input type="submit" id="submitBtn" value="確認捐款">

</div>

<!-- 安全機器人 -->
<script src="https://www.google.com/recaptcha/api.js?render=6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaResponse').value = token;
        });
    });
    // 当文档加载完毕后执行初始化操作


</script>

</body>


<!-- 使用者輸入檢查 -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 驗證姓名格式
        document.getElementById("name").addEventListener("input", function() {
            const namePattern = /^[\u4e00-\u9fa5\s·]+$/; // 只允許中文字符、空格及·
            if (!namePattern.test(this.value)) {
                this.setCustomValidity("姓名只能包含中文字符、空格及·");
            } else {
                this.setCustomValidity("");
            }
        });
    
        // 驗證電子信箱格式
        document.getElementById("email").addEventListener("input", function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(this.value)) {
                this.setCustomValidity("請輸入一個有效的電子郵件地址");
            } else {
                this.setCustomValidity("");
            }
        });
    
        // 確保捐款金額是正值
        document.getElementById("mon").addEventListener("input", function() {
            if (parseInt(this.value, 10) <= 0) {
                this.setCustomValidity("捐款金額必須大於0");
            } else {
                this.setCustomValidity("");
            }
        });
    
        // 驗證信用卡安全碼
        document.getElementById("safe").addEventListener("input", function() {
            const securityCodePattern = /^\d{3}$/;
            const securityCodeError = document.getElementById("security-code-error");
            if (!securityCodePattern.test(this.value)) {
                securityCodeError.textContent = "安全碼必須是三位數字";
                this.setCustomValidity("安全碼必須是三位數字");
            } else {
                securityCodeError.textContent = "";
                this.setCustomValidity("");
            }
        });
        
        // 信用卡號碼驗證
    document.getElementById("eee").addEventListener("input", function() {
        const creditCardPattern = /^\d{16}$/;
        if (!creditCardPattern.test(this.value.replace(/\s+/g, ''))) { // 移除空格後檢查
            this.setCustomValidity("信用卡號碼必須是16位數字");
        } else {
            this.setCustomValidity("");
        }
    });

    // 信用卡到期日格式化（MMYY）
    document.getElementById("eeee").addEventListener("input", function() {
        var input = this.value;
        if (input.length === 2 && !input.includes('/')) {
            this.value = input + "/"; // 在兩位數後自動添加斜線
        }
    });

    // 身份證號碼格式驗證
    document.getElementById("pas").addEventListener("input", function() {
        const idPattern = /^[A-Z][0-9]{9}$/;
        if (!idPattern.test(this.value)) {
            this.setCustomValidity("身份證號碼格式錯誤，應為一個大寫字母後接九個數字");
        } else {
            this.setCustomValidity("");
        }
    });

    });
    </script>
    
    
<!-- 美化 -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
  var carouselElement = document.querySelector('#carouselExampleControls');
  var carouselInstance = new bootstrap.Carousel(carouselElement, {
    interval: 3000
  });

  carouselElement.addEventListener('slide.bs.carousel', function (e) {
    // 重置即將離開的項目
    var activeItem = carouselElement.querySelector('.carousel-item.active');
    activeItem.style.opacity = 0.1;
    activeItem.style.transform = 'scale(0.95)';
    
    // 設定即將顯示的項目
    var nextItem = e.relatedTarget;
    nextItem.style.opacity = 0.1;
    nextItem.style.transform = 'scale(0.95)';
  });

  carouselElement.addEventListener('slid.bs.carousel', function () {
    // 確保所有項目都被重置
    var items = carouselElement.querySelectorAll('.carousel-item');
    items.forEach(function (item) {
      item.style.opacity = 1;
      item.style.transform = 'scale(1)';
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
    const welcomeSection = document.querySelector('.info');
    let animated = false;

    // 初始化h2和p為不可見
    const h2 = document.querySelector('.welcome-section h2');
    const ps = document.querySelectorAll('.welcome-section p');
    h2.style.opacity = 0;
    h2.style.transform = 'translateY(20px)'; // 初始轉換設置
    ps.forEach(p => {
        p.style.opacity = 0;
        p.style.transform = 'translateY(20px)'; // 初始轉換設置
    });

    const fadeIn = (element, delay = 0) => {
        setTimeout(() => {
            element.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            element.style.opacity = 1;
            element.style.transform = 'translateY(0)';
        }, delay);
    };

    const animateContent = () => {
        if (animated) return;
        animated = true;

        // 觸發h2淡入動畫，無需延遲
        fadeIn(h2);

        // 觸發p的淡入動畫，每個p元素延遲增加
        ps.forEach((p, index) => {
            fadeIn(p, 100 * (index + 1)); // 延遲以確保順序淡入
        });

        // 觸發數字動畫
        animateNumbers();
    };

    const animateNumbers = () => {
        const target = parseInt(document.querySelector('.number1').getAttribute('data-target'));
        if (!isNaN(target)) {
            animateNumber('.number1', 0, target, 3000);
        }
    };

    const animateNumber = (selector, start, end, duration) => {
                const element = document.querySelector(selector);
                let current = start;
                const step = 200; // 每次增加的步數

                const interval = setInterval(() => {
                    current += step;
                    element.textContent = Math.min(Math.floor(current), end);
                    if (current >= end) {
                        clearInterval(interval);
                    }
                }, 10);
    };

    const checkScroll = () => {
        const rect = welcomeSection.getBoundingClientRect();
        if (rect.top < window.innerHeight && !animated) {
            animateContent();
        }
    };

    window.addEventListener('scroll', checkScroll);
    checkScroll();
});





document.getElementById('safe').addEventListener('input', function() {
    const securityCode = this.value;
    const securityCodeError = document.getElementById('security-code-error');
    if (securityCode.length > 3) {
        securityCodeError.textContent = "安全碼只有三碼!";
    } else {
        securityCodeError.textContent = "";
    }
});
// 获取按钮元素
const submitBtn = document.getElementById('submitBtn');

// 添加鼠标悬停事件监听器
submitBtn.addEventListener('mouseenter', function() {
    // 添加悬停效果的类
    this.classList.add('hover-effect');
});

// 添加鼠标离开事件监听器
submitBtn.addEventListener('mouseleave', function() {
    // 移除悬停效果的类
    this.classList.remove('hover-effect');
});

document.addEventListener('DOMContentLoaded', function () {
    const myButton = document.getElementById('myButton');

    // 悬停进入
    myButton.addEventListener('mouseenter', function() {
        this.classList.add('hover-effect');
    });

    // 悬停离开
    myButton.addEventListener('mouseleave', function() {
        this.classList.remove('hover-effect');
    });
});



</script>


</html>
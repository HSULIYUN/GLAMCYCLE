<?php include '../../會員系統/auth0.php'; ?>
<?php
$host = 'localhost';
$username = 'root';
$password = ''; 
$database = 'cycle';
$port = 3308; 

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


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
            transform: scale(0.95); 
            opacity: 0.5; 
        }

        .carousel {
            margin-top: 0px;
        }
        
   
         .carousel-item img {
            width: 50%;
            height: 50%; 
            object-fit: cover;

        }
        .carousel-item {
            position: relative;
            width: 50%; 
            height: 50%; 
            transition: transform 0.05s ease, opacity 0.05s ease;
        }

        

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
    display: flex; 
    flex-wrap: wrap; 
    margin-top: 20px;
}

.volunteers {
    display: flex;
    justify-content: center; 
    align-items: center;
    width: 100%; 
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

.donation-intro {
    text-align: center; 
    padding: 20px; 
    margin: 20px 0; 

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
    flex-direction: column; 
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); 
}

.info form {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%; 
}

.left-side, .right-side {
    display: flex;
    flex-direction: column;
    transform: translateY(-100px); 
}


.input-field {
    position: relative;
    width: 250px;
    height: 44px;
    line-height: 44px;
    margin-bottom: 60px; 

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
    color: #4B527E; 
    opacity: 1; 
}

.input-field input:focus::placeholder,
.input-field input:valid::placeholder {
    color: transparent; 
}

.input-field input:focus ~ label[for="eeee"]::after,
.input-field input:valid ~ label[for="eeee"]::after {
    content: "MM/YY"; 
    color: #4B527E; 
    margin-left: 5px; 
}


#submitBtn {
    align-self: center; 
    margin-top: 120px;
    margin-bottom: 50px;
    height: 90px;
    width: 400px;
    border:#4B527E 2px solid ;
    background-color: #86B6F6;
    color: #4B527E;
    font-size: 30px;
    font-weight: bold;
    border-radius: 50px;
    transition: background-color 0.3s, transform 0.3s;
}


#submitBtn.hover-effect {
    background-color: #7C93C3;
    transform: scale(1.1);
}

.info .line-container {
    display: flex;
    align-items: center;
}

.info .line {
    flex-grow: 1; 
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
    background-image: url('圖片/背1-1.png'); 
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    
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
  line-height: 50px; 
  cursor: pointer;
}

.button1:hover {
  background-color: #4B527E;
  color: #fff;
}
@media (max-width: 1300px) { 
    .container {
        flex-direction: column; 
    }
    
    .info {
        width: 90%; 
        height: auto; 
        margin-top: 50px; 
        margin-bottom: 50px;
    }
    
    .left-side, .right-side {
        flex-direction: column; 
        margin-top: 120px; 
        margin-left: 0; 
        margin-right: 0; 
    }
    
    .input-field input, .input-field textarea {
        width: 90%; 
    }
    
    #submitBtn {
        width: 90%; 
    }
}

@media (max-width: 480px) { 
    .navbar-nav .nav-link, .user-name {
        font-size: 18px; 
    }
    
    .carousel-item img {
        width: 100%;
        height: auto;
    }
}


.container {
    display: flex;
    width: 100%;
    flex-direction: row; 
    flex-wrap: wrap; 
}


@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
        padding: 20px; 
    }
}

@media (max-width: 480px) {
    .container {
        width: 100%; 
    }
}


@media (max-width: 1300px) {
    .statistics .volunteers:nth-child(2) {
        margin-left: 200px;
        margin-top: 30px;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .statistics .volunteers:nth-child(1) {
        margin-left: -300px; 
        flex: 1 0 100%;
        justify-content: center;
        margin-right: 0;
    }
    .button1 {
        margin-top: -1000px; 
        margin-left: 500px;
    }
}


@media (max-width: 300px) {
    .statistics {
        width: 50%;
    }
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
   
</head>
<body>
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


<script src="https://www.google.com/recaptcha/api.js?render=6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaResponse').value = token;
        });
    });



</script>

</body>



<script>
    document.addEventListener("DOMContentLoaded", function() {
     
        document.getElementById("name").addEventListener("input", function() {
            const namePattern = /^[\u4e00-\u9fa5\s·]+$/; 
            if (!namePattern.test(this.value)) {
                this.setCustomValidity("姓名只能包含中文字符、空格及·");
            } else {
                this.setCustomValidity("");
            }
        });
    

        document.getElementById("email").addEventListener("input", function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(this.value)) {
                this.setCustomValidity("請輸入一個有效的電子郵件地址");
            } else {
                this.setCustomValidity("");
            }
        });
    

        document.getElementById("mon").addEventListener("input", function() {
            if (parseInt(this.value, 10) <= 0) {
                this.setCustomValidity("捐款金額必須大於0");
            } else {
                this.setCustomValidity("");
            }
        });
    
        
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
        

    document.getElementById("eee").addEventListener("input", function() {
        const creditCardPattern = /^\d{16}$/;
        if (!creditCardPattern.test(this.value.replace(/\s+/g, ''))) { 
            this.setCustomValidity("信用卡號碼必須是16位數字");
        } else {
            this.setCustomValidity("");
        }
    });


    document.getElementById("eeee").addEventListener("input", function() {
        var input = this.value;
        if (input.length === 2 && !input.includes('/')) {
            this.value = input + "/";
        }
    });


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
    
    

<script>
  document.addEventListener('DOMContentLoaded', function () {
  var carouselElement = document.querySelector('#carouselExampleControls');
  var carouselInstance = new bootstrap.Carousel(carouselElement, {
    interval: 3000
  });

  carouselElement.addEventListener('slide.bs.carousel', function (e) {

    var activeItem = carouselElement.querySelector('.carousel-item.active');
    activeItem.style.opacity = 0.1;
    activeItem.style.transform = 'scale(0.95)';
    

    var nextItem = e.relatedTarget;
    nextItem.style.opacity = 0.1;
    nextItem.style.transform = 'scale(0.95)';
  });

  carouselElement.addEventListener('slid.bs.carousel', function () {

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


    const h2 = document.querySelector('.welcome-section h2');
    const ps = document.querySelectorAll('.welcome-section p');
    h2.style.opacity = 0;
    h2.style.transform = 'translateY(20px)'; 
    ps.forEach(p => {
        p.style.opacity = 0;
        p.style.transform = 'translateY(20px)'; 
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

        fadeIn(h2);

  
        ps.forEach((p, index) => {
            fadeIn(p, 100 * (index + 1)); 
        });

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
                const step = 200; 

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

const submitBtn = document.getElementById('submitBtn');


submitBtn.addEventListener('mouseenter', function() {

    this.classList.add('hover-effect');
});

submitBtn.addEventListener('mouseleave', function() {

    this.classList.remove('hover-effect');
});

document.addEventListener('DOMContentLoaded', function () {
    const myButton = document.getElementById('myButton');

    myButton.addEventListener('mouseenter', function() {
        this.classList.add('hover-effect');
    });

    myButton.addEventListener('mouseleave', function() {
        this.classList.remove('hover-effect');
    });
});



</script>


</html>

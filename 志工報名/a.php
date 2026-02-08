<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $volunteer_option = isset($_POST['volunteer_option']) ? $_POST['volunteer_option'] : '未選擇';
    $recaptchaResponse = $_POST['recaptcha_response'];

    // 檢查 reCAPTCHA
    $secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {
        // 繼續進行數據庫操作
        $conn = new mysqli('localhost', 'root', '', 'cycle', 3308);
        if ($conn->connect_error) {
            die("連接失敗: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO volunteers (full_name, email_address, phone_number, volunteer_option) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $full_name, $email_address, $phone_number, $volunteer_option);

        if ($stmt->execute() === TRUE) {
            header('Location: 送出/index.html');
            exit();
        } else {
            echo "錯誤: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "驗證失敗或懷疑是機器人行為";
    }
}
?>


<?php include '../會員系統/auth0.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="icon" href="icon/gc.png" />

<meta content="" name="keywords">
<meta content="" name="description">

<link rel="stylesheet" type="text/css" href="ddd.css">

<title>志工報名 | GLAMCYCLE</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <!-- google安全機器人 -->
 <script src="https://www.google.com/recaptcha/api.js?render=6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu', {action: 'submit'}).then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
            });
        });
    </script>

</head>
<body >
 
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
  <!--最上面下拉是選單結束-->

  <section class="home">
    <div class="description">
      <h1 class="title">
        <span class="gradient-text">志工報名</span><br> with the Best
      </h1>
      <p class="paragraph">
        熱烈招募熱心志工一同參與。<br>
        加入我們，讓您的美麗助力地球的健康。<br>
        透過回收與創新再利用，我們一起為環境盡一份力！<br>
        有興趣的朋友，請積極加入我們的志工行列。
      </p>
<form id="form" autocomplete="off" method="post" action="e.php">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name-id">姓名：</label>
            <input type="text" id="name-id" name="full_name" required>
        </div>
        <div class="form-group col-md-6">
            <label for="phone-id">電話號碼：</label>
            <input type="tel" id="phone-id" name="phone_number" required>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="email-id">電子郵件地址：</label>
        <input type="email" id="email-id" name="email_address" required>
    </div>
    <button type="submit" class="btn">
        <span>報名</span>
        <ion-icon name="arrow-forward-outline"></ion-icon>
    </button>
</form>
    </div>
  

    <div class="users-color-container">
      <span class="item" style="--i: 1"></span>
      <img
        class="item"
        src="圖片/1.png" 
        style="--i: 2"
        alt="" />

      <span class="item" style="--i: 3"></span>
      <img
        class="item"
        src="圖片/2.png"
        style="--i: 4"
        alt="" />

      <img
        class="item"
        src="圖片/3.png"
        style="--i: 10"
        alt="" />
      <span class="item" style="--i: 11"></span>
      <img class="item" src="圖片/4.png" style="--i: 12" alt="" />
      <span class="item" style="--i: 5"></span>

      <span class="item" style="--i: 9"></span>
      <img class="item" src="圖片/5.png" style="--i: 8" alt="" />
      <span class="item" style="--i: 7"></span>
      <img class="item" src="圖片/6.png" style="--i: 6" alt="" />
    </div>
  </section>

  <section class="card-container" id="card-container">
    <div class="slider">
      <div class="content-wrapper">
        <div class="card" data-tilt>
          <div class="content">
            <img src="圖片/01.gif" alt="" />
            <h1>志工在做什麼?</h1>
            <p>
            <strong>1. 處理過期化妝品的清潔：</strong><br>
            志工們負責對過期的化妝品進行清潔和處理，確保這些產品不會對環境造成污染。<br>
            <strong>2. 將過期化妝品製成其他物品：</strong><br>
            創造力在這裡得到了充分的發揮。志工們將過期的化妝品轉化為新的有用物品。<br>
            <strong>3. 活動現場支援與協助：</strong><br>
            在各種公益活動中，志工們協助進行路徑指引、設施搭建、秩序維護等工作，確保活動順利進行。
            </p>
          </div>
        </div>
        <div class="card" data-tilt>
          <div class="content">
            <img src="圖片/02.gif" alt="" />
            <h1>參與志願服務的好處</h1>
            <p>
            提升技能：<br>
  參與志願服務可以提供機會，讓人學習新技能或加強現有技能。<br>
  增強自信心：<br>
  透過參與志願服務，人們可以在實踐中建立自信心。<br>
  建立人際關係：<br>
  志願服務提供了與不同背景和興趣的人們互動的機會，從而擴展社交圈子並建立有意義的人際關係。<br>
              
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="card-container" id="card-container">
    <div class="slider">
      <div class="content-wrapper">
        <div class="card" data-tilt>
          <div class="content">
            <img src="圖片/04.gif" alt="" />
            <h1>GLAMCYCLE特有福利</h1>
            <p>
            <strong>1. 專屬培訓和工作坊：</strong><br>
            我們定期舉辦專屬的志工培訓和工作坊，涵蓋環保知識、手工製作技能、活動管理技巧等多方面內容，幫助您提升個人能力。<br>
            <strong>2. 職業發展支持：</strong><br>
            我們為志工提供職業發展支持，包括職業諮詢、實習機會和推薦信，幫助您在職場上更好地發展。<br>
            <strong>3. 獨家活動參與機會：</strong><br>
            志工將有機會優先參加品牌舉辦的各類獨家活動，如環保創意展覽等，與品牌創始人和名人嘉賓近距離接觸。
          </p>
          </div>
        </div>
        <div class="card" data-tilt>
          <div class="content">
            <img src="圖片/03.gif" alt="" />
            <h1>志願者支持和培訓</h1>
            <p>
            <strong>1. 全面導引培訓：</strong><br>
            新加入的志願者將參加全面的導引培訓，熟悉各項工作流程和安全規範，確保您在開始服務前已做好充分準備。<br>
            <strong>3. 團隊合作訓練：</strong><br>
            志願者將參加團隊合作訓練等等，這些訓練不僅有助於志願服務，也對個人的職業發展大有裨益。<br>
            成為我們的志願者，您將獲得全面的支持和培訓，讓您在服務過程中感受到充實和成就。<br>
            我們致力於為您提供最佳的志願者體驗，期待您的加入，共同創造美好的未來！<br>
             


          </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="c.js"></script>
</body>

<?php include '../會員系統/auth0.php';
include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="icon" href="icon/gc.png" />

<meta content="" name="keywords">
<meta content="" name="description">

<link rel="stylesheet" href="index.css";>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>


<title>官方首頁 | GLAMCYCLE</title>
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



<div class="image-container">
  <img src="首頁/背1.png" alt="Image 1" class="object image1 group1" data-value="5" data-opacity="0.5">
  <img src="首頁/背3.png" alt="Image 2" class="object image2 group2" data-value="10">
  <img src="首頁/背4.png" alt="Image 2" class="object image3 group1" data-value="15">
  <img src="首頁/背5.png" alt="Image 2" class="object image4 group2" data-value="20">
  <img src="首頁/背6.jpg" alt="Image 2" class="object image5 group1" data-value="25">
  <img src="首頁/背6.gif" alt="Image 2" class="image6 group2" data-value="30">
  <img src="首頁/背7.png" alt="Image 2" class="object image7 group1" data-value="35" data-opacity="0.5">
  <img src="首頁/背15.jpg" alt="Image 2" class="object image8 group2" data-value="40">
  <img src="首頁/背9.png" alt="Image 2" class="object image9 group1" data-value="45" data-opacity="0.5">
  <img src="首頁/背14.png" alt="Image 2" class="object image10 group2" data-value="50">
  <img src="首頁/背11.png" alt="Image 2" class="object image11 group1" data-value="55" data-opacity="0.5">
  <img src="首頁/背12.png" alt="Image 2" class="object image12 group2" data-value="60">
  <img src="首頁/背13.png" alt="Image 2" class="object image13 group1" data-value="65" data-opacity="0.7">
  <img src="首頁/背10.png" alt="Image 2" class="object image14 group2" data-value="70" data-opacity="0.7">
  <img src="首頁/背8.png" alt="Image 2" class="object image15 group1" data-value="75">
  <img src="首頁/背15.png" alt="Image 2" class="object image16 group2" data-value="80" data-opacity="0.7">
  <div class="centered-text">Welcome to GLAMCYCLE</div>
  <div class="centered-text1">分享化妝品、以及過期回收的小天地</div>
  <div class="container">
    <?php
    if (isset($_SESSION['username'])) {
        echo '<a href="' . getUserProfileLink() . '" style="text-decoration: none; color: inherit;"><button class="my-button"><strong>歡迎，' . htmlspecialchars($_SESSION['username']) . '</strong></button></a>';
    } else {
        echo '<a href="../會員系統/sign.php" target="_blank" style="text-decoration: none; color: inherit;"><button class="my-button"><strong>登入/註冊</strong></button></a>';
    }
    ?>
  </div>
  <img src="首頁/箭頭1.gif" alt="Image 2" class="image00"  >
</div>




<div>
   <h1><span class="h11"style="text-align: left; margin-left: 50px; font-size: 60px; color: black; font-weight: 900;">最新資訊</span><span style="font-size:100px;font-family: 'Playfair Display', serif;font-weight: none;color: #7D7C7C !important;">NEWS</span></h1>
</div>





<div id="cards-container" class="d-flex justify-content-center align-items-center">


  <a href="javascript:void(0);" class="arrow left-arrow" onclick="showPrevCard()">&#10094;</a>
  
  <?php
  $sql = "SELECT title, image_url, description, button_text, button_url FROM News WHERE id = 1";  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
          echo '<div class="card1">';
          echo '<img src="' . $row["image_url"] . '" class="card-img-top1" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title1" style="color:#6895D2;">' . $row["title"] . '</h5>';
          echo '<p class="card-text" style="color:#7D7C7C;"><strong>' . nl2br($row["description"]) . '</strong></p>';
          echo '<div class="container">';
          echo '<a href="' . $row["button_url"] . '" class="btn btn-primary" style="background-color:#6895D2; border: none;font-weight: bold; width: 300px; height: 50px; text-decoration: none; color: white; display: inline-flex; justify-content: center; align-items: center;">' . $row["button_text"] . '</a>';
          echo '</div></div></div>';
      }
  } else {
      echo "0 results";
  }
  ?>

  <a href="javascript:void(0);" class="arrow right-arrow" onclick="showNextCard()">&#10095;</a>

  
  <a href="javascript:void(0);" class="arrow left-arrow" onclick="showPrevCard()">&#10094;</a>
  
  <?php
  $sql = "SELECT title, image_url, description, button_text, button_url FROM News WHERE id = 2";  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
          echo '<div class="card2">';
          echo '<img src="' . $row["image_url"] . '" class="card-img-top1" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title1" style="color:#E1AFD1;">' . $row["title"] . '</h5>';
          echo '<p class="card-text" style="color:#7D7C7C;"><strong>' . nl2br($row["description"]) . '</strong></p>';
          echo '<div class="container">';
          echo '<a href="' . $row["button_url"] . '" class="btn btn-primary" style="background-color:#E1AFD1; border: none;font-weight: bold; width: 300px; height: 50px; text-decoration: none; color: white; display: inline-flex; justify-content: center; align-items: center;">' . $row["button_text"] . '</a>';
          echo '</div></div></div>';
      }
  } else {
      echo "0 results";
  }
  ?>

  <a href="javascript:void(0);" class="arrow right-arrow" onclick="showNextCard()">&#10095;</a>

  <a href="javascript:void(0);" class="arrow left-arrow" onclick="showPrevCard()">&#10094;</a>
  
  <?php
  $sql = "SELECT title, image_url, description, button_text, button_url FROM News WHERE id = 3";  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      
      while($row = $result->fetch_assoc()) {
          echo '<div class="card3">';
          echo '<img src="' . $row["image_url"] . '" class="card-img-top1" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title1" style="color:#DBA979;">' . $row["title"] . '</h5>';
          echo '<p class="card-text" style="color:#7D7C7C;"><strong>' . nl2br($row["description"]) . '</strong></p>';
          echo '<div class="container">';
          echo '<a href="' . $row["button_url"] . '" class="btn btn-primary" style="background-color:#DBA979; border: none;font-weight: bold; width: 300px; height: 50px; text-decoration: none; color: white; display: inline-flex; justify-content: center; align-items: center;">' . $row["button_text"] . '</a>';
          echo '</div></div></div>';
      }
  } else {
      echo "0 results";
  }
  ?>

  <a href="javascript:void(0);" class="arrow right-arrow" onclick="showNextCard()">&#10095;</a>


  <a href="javascript:void(0);" class="arrow left-arrow" onclick="showPrevCard()">&#10094;</a>
  
  <?php
  $sql = "SELECT title, image_url, description, button_text, button_url FROM News WHERE id = 4";  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      
      while($row = $result->fetch_assoc()) {
          echo '<div class="card4">';
          echo '<img src="' . $row["image_url"] . '" class="card-img-top1" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title1" style="color:#F3CA52;">' . $row["title"] . '</h5>';
          echo '<p class="card-text" style="color:#7D7C7C;"><strong>' . nl2br($row["description"]) . '</strong></p>';
          echo '<div class="container">';
          echo '<a href="' . $row["button_url"] . '" class="btn btn-primary" style="background-color:#F3CA52; border: none;font-weight: bold; width: 300px; height: 50px; text-decoration: none; color: white; display: inline-flex; justify-content: center; align-items: center;">' . $row["button_text"] . '</a>';
          echo '</div></div></div>';
      }
  } else {
      echo "0 results";
  }
  ?>

  <a href="javascript:void(0);" class="arrow right-arrow" onclick="showNextCard()">&#10095;</a>

  <a href="javascript:void(0);" class="arrow left-arrow" onclick="showPrevCard()">&#10094;</a>
  
  <?php
  $sql = "SELECT title, image_url, description, button_text, button_url FROM News WHERE id = 5";  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      
      while($row = $result->fetch_assoc()) {
          echo '<div class="card5">';
          echo '<img src="' . $row["image_url"] . '" class="card-img-top1" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title1" style="color:#B5C18E;">' . $row["title"] . '</h5>';
          echo '<p class="card-text" style="color:#7D7C7C;"><strong>' . nl2br($row["description"]) . '</strong></p>';
          echo '<div class="container">';
          echo '<a href="' . $row["button_url"] . '" class="btn btn-primary" style="background-color:#B5C18E; border: none;font-weight: bold; width: 300px; height: 50px; text-decoration: none; color: white; display: inline-flex; justify-content: center; align-items: center;">' . $row["button_text"] . '</a>';
          echo '</div></div></div>';
      }
  } else {
      echo "0 results";
  }
  ?>

  <a href="javascript:void(0);" class="arrow right-arrow" onclick="showNextCard()">&#10095;</a>

</div>

<div>
   <h1 class="h11"style="text-align: left; margin-left: 140px; font-size: 60px; color: black; margin-top: 250px;margin-bottom:50px;font-family: 'Playfair Display', serif;">GLAMCYCLE⠀6<span style="font-size:60px;font-family: 'Microsoft JhengHei', sans-serif;font-weight: 900;">大特點</span>
</div>
<div class="cont s--inactive">
        <div class="cont__inner">
            <!-- Section 1 -->
            
            <div class="el">
            <a href="../活動首頁/event.php" style="text-decoration: none; color: inherit;">
                <div class="el__overflow">
                    <div class="el__inner">
                        <div class="el__bg"></div>
                        <div class="el__preview-cont">
                            <div class="el__image"></div>
                            <h1 class="el__heading">最新活動</h1>
                            <p class="el__description">
                            探索化妝品再生。我們提供各式各樣的活動。
                            <br>參與中你可擴展知識，結交志同道合的朋友。
                            <br>豐富的工作坊和講座，助你深入了解再生之美。
                            <br>一起實踐永續，期待你的參加！
                            </p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            <!-- Section 2 -->
            
            <div class="el">
            <a href="../討論串03/index.php" style="text-decoration: none; color: inherit;">
                <div class="el__overflow">
                    <div class="el__inner">
                        <div class="el__bg"></div>
                        <div class="el__preview-cont">
                            <div class="el__image2"></div>
                            <h1 class="el__heading">討論串</h1>
                            <p class="el__description">
                            探索化妝品再生話題，加入我們的討論。
                            <br>分享經驗、交流想法，這裡歡迎各種聲音。
                            <br>心得、疑問或新發現，我們期待您的參與。
                            <br>快來互動，創造樂趣！</p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            <!-- Section 3 -->
            <div class="el">
            <a href="../donate/000/捐款.php" style="text-decoration: none; color: inherit;">
                <div class="el__overflow">
                    <div class="el__inner">
                        <div class="el__bg"></div>
                        <div class="el__preview-cont">
                            <div class="el__image3"></div>
                            <h1 class="el__heading">捐款</h1>
                            <p class="el__description">
                            您的捐款支持化妝品再生與環保教育。
                            <br>捐款助我們舉辦更多公益活動。
                            <br>我們承諾資金透明使用，展現實際效果。
                            <br>您的愛心，助力永續發展。</p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            <!-- Section 4 -->
            <div class="el">
            <a href="../關於過期化妝品/index.php" style="text-decoration: none; color: inherit;">
                <div class="el__overflow">
                    <div class="el__inner">
                        <div class="el__bg"></div>
                        <div class="el__preview-cont">
                        <div class="el__image4"></div>
                            <h1 class="el__heading">過期化妝品</h1>
                            <p class="el__description">
                            重新利用過期化妝品，貢獻環保。
                            <br>我們的永續發展計劃，目的是減少浪費。
                            <br>每件產品都經過專業處理，確保安全。
                            <br>回收再利用，共創環保新未來。</p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            
            <!-- Section 5 -->
            
            <div class="el">
              <a href="../志工報名/a.php" style="text-decoration: none; color: inherit;">
                <div class="el__overflow">
                    <div class="el__inner">
                        <div class="el__bg"></div>
                        <div class="el__preview-cont">
                        <div class="el__image5"></div>
                            <h1 class="el__heading">成為志工</h1>
                            <p class="el__description">
                                加入我們的志工團隊，實踐社會責任。
                                <br>參與多元化的志工活動，豐富您的經驗。
                                <br>我們提供培訓和支持，讓志工發揮潛力。
                                <br>一起工作，一起成長，共創美好未來。
                                </p>
                        </div>
                    </div>
                </div>
              </a>
            </div>
            </a>
            <!-- Section 6 -->
            <div class="el">
            <a href="../意見回饋/feedback.php" style="text-decoration: none; color: inherit;">
                <div class="el__overflow">
                    <div class="el__inner">
                        <div class="el__bg"></div>
                        <div class="el__preview-cont">
                        <div class="el__image6"></div>
                            <h1 class="el__heading">意見回饋</h1>
                            <p class="el__description">
                            我們重視您的聲音，鼓勵您提供寶貴的意見。
                            <br>您的反饋幫助我們不斷改進與創新。
                            <br>填寫簡單的回饋表，讓我們知道您的感受。
                            <br>每條意見都將認真考慮，以期提供最佳服務。
                            </p>
                        </div>
                    </div>
                </div>
               </a>
            </div>
        </div>
    </div>


<div class="con">
  <div class="text">
    <h1 style="font-weight: bold;font-size:50px;margin-top:-70px;color: #7D7C7C !important;">關於 <span style="font-family: 'Playfair Display', serif;font-size:50px;">GLAMCYCLE</span></h1>
    <h2 style="font-weight: bold;margin-top:30px;">品牌故事</h2>
    <p style="margin-top:30px;">GLAMCYCLE，一個由三位女性創立於2024年2月的創新品牌，源<br>
    於她們家中堆積如山的未使用化妝品。在一次深夜的對話中，她們<br>
    發現這些過期化妝品雖然不能再用，但充滿再利用的潛力。於是，<br>
    她們決心創建一個專注於過期化妝品的回收與再利用的品牌，這就<br>
    是GLAMCYCLE的起點。<br><br>
    GLAMCYCLE不僅僅停留在回收計劃上，到了2024年4月，這個概<br>
    念進化成為一個化妝品複合式網站。這個網站不只是一個回收中心<br>
    ，它整合了討論串、活動等更多功能，創造一個全方位的美妝社群<br>
    在這裡，用戶不僅可以學習如何環保地處理過期化妝品，還能參與<br>
    到各種由GLAMCYCLE主辦的活動中，增強對美妝環保的認識。<br><br>

    這個網站的每一個功能都旨在鼓勵用戶積極參與和分享，從而不僅<br>
    提升個人美妝技巧，也貢獻於地球的可持續發展。GLAMCYCLE相<br>
    信，每一小步的環保行動，都是向著更美好世界的一大步。加入我<br>
    們的旅程，讓舊化妝品焕發新生，共同締造環保與美麗並重的未來。</p>
  </div>
  <div class="image-con">
    <div class="img0001" id="primaryImage" style="background-image: url('images/1.jpg');"></div>
    <div class="image secondary" id="secondaryImage" style="background-image: url('images/2.jpg');"></div>
    <div class="dots">
      <span class="dot active" onclick="currentSlide(0)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
  </div>
</div>

<footer class="site-footer">
  <div class="footer-content">
    <img src="icon/gc.png" style="width: 50px;height: 50px;">
    <p>Copyright © 2024 GLAMCYCLE. All rights reserved.</p>
  </div>
</footer>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script>
  $(document).ready(function(){
  $("#common-content").load("common.html");
});
  window.addEventListener('scroll', function() {
  var scrollDistance = window.scrollY;
  var imageContainer = document.querySelector('.image-container');
  var gradientDiv = document.querySelector('.gradient-div'); 

  
  var scaleValue = 1;
  var opacityValue = 1;
  var translateYValue = 0; 

  if (scrollDistance > 10) {
 
    scaleValue = Math.max(0.5, 1 - (scrollDistance - 10) / 2000);
    opacityValue = Math.max(0, 1 - (scrollDistance - 10) / 2000);
    translateYValue = Math.max(-899, -(scrollDistance - 1) / 1); 
  }


  imageContainer.style.transform = `scale(${scaleValue})`;
  imageContainer.style.opacity = opacityValue;


  gradientDiv.style.transform = `translateY(${translateYValue}px)`;
});

let slideIndex = 0;
const primaryImages = ['品牌/第一章.jpg', '品牌/第二章.jpg', '品牌/第三章.jpg', '品牌/第四章.jpg'];
const slideShowInterval = 3000; 

function showSlides() {
  let primaryImg = document.getElementById('primaryImage');
  fadeOutImage(primaryImg, () => {
    primaryImg.style.backgroundImage = `url('${primaryImages[slideIndex]}')`;
    fadeInImage(primaryImg);
  });

  updateDots();
  slideIndex = (slideIndex + 1) % primaryImages.length; 
  setTimeout(showSlides, slideShowInterval); 
}

function fadeOutImage(imageElement, callback) {
  let opacity = 1; 
  let interval = setInterval(() => {
    opacity -= 0.1; 
    imageElement.style.opacity = opacity;
    if (opacity <= 0) {
      clearInterval(interval);
      callback(); 
    }
  }, 25);
}

function fadeInImage(imageElement) {
  let opacity = 0; 
  let interval = setInterval(() => {
    opacity += 0.1; 
    imageElement.style.opacity = opacity;
    if (opacity >= 1) clearInterval(interval); 
  }, 25); 
}

function updateDots() {
  let dots = document.getElementsByClassName("dot");
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  dots[slideIndex % primaryImages.length].className += " active";
}

function currentSlide(n) {
  slideIndex = n - 1; 
  showSlides();
}

showSlides(); 




</script>
<script src="index0.js">
</script>

</body>
</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
</html>

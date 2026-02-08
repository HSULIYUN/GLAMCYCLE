<?php include '../會員系統/auth0.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" type="icon" href="icon/gc.png" />
        <title>意見回饋 | GLAMCYCLE</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <style>
        body {
                  background-color: #f8f9fa;
                  color: #495057;
              }
              .container {
                  padding-top: 50px;
                  
              }

              .container:nth-child(1), .container:nth-child(2) {
                  border-radius: 0;
              }

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


 /* 響應式設計 */
/* 在大屏幕上不改变 .parent-container 的布局 */
.parent-container {
    width: 100%; /* 保持容器宽度为100% */
    position: relative; /* 设置相对定位，为子绝对定位元素提供参考 */
}
@media (max-width: 768px) {
  .py-5 {
        height: 300px;
    }
}

@media (max-width: 480px) {
  .py-5 {
        height: 200px;
    }
}
@media (max-width: 1300px) {
    .parent-container {
        display: flex !important; 
        flex-direction: column !important; /* 设置为垂直排列 */
        align-items: center !important; /* 中央对齐 */
    }
    .py-5 {
    position: static !important;
    width: 100% !important;
    height: auto !important; /* 使用全寬以適應螢幕寬度 */
    max-width: 100% !important; /* 確保不超過螢幕寬度 */
    }





    .container{
        position: static !important; /* 取消绝对定位，让元素自然流动 */
        width: 90% !important; /* 全宽显示，留出一些边距 */
        margin-left: auto !important; /* 水平居中 */
        margin-right: auto !important; /* 水平居中 */
        margin-top: 20px !important; /* 给予上边距 */
    }

    .container2{
        position: static !important; /* 取消绝对定位，让元素自然流动 */
        width: 50% !important; 
        margin-left: auto !important; /* 水平居中 */
        margin-right: auto !important; /* 水平居中 */
        margin-top: 100px !important; /* 给予上边距 */
    }
    iframe{
      position: static !important; /* 取消绝对定位，让元素自然流动 */
        width: 100% !important; /* 全宽显示，留出一些边距 */
        margin-left: auto !important; /* 水平居中 */
        margin-right: auto !important; /* 水平居中 */
        margin-top: 20px !important; /* 给予上边距 */
    }

    .container {
        order: 1 !important; /* 确保.container在.container2之前 */
    }

    .container2 {
        order: 2 !important; /* 确保.container2在.container之后 */
        margin-top: 100px !important; /* 调整上边距，与.container一致 */
    }
}


header.py-5.bg-image-full {
    width: 100% !important;
    height: 70vh; /* 使用視窗高度的百分比 */
    position: relative;
    background-image: url('圖片/1.png');
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
}

 /* 響應式設計結束 */
  /* 網頁動畫 */
  @keyframes slideDown {
    from {
      transform: translateY(-100%);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  @keyframes slideUp {
    from {
      transform: translateY(100%);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  header.py-5.bg-image-full, .container, .container2 {
    opacity: 0; /* 初始透明度設為0 */
    will-change: transform, opacity; /* 優化性能，提前告知瀏覽器這兩個屬性會變化 */
  }

  header.py-5.bg-image-full {
    animation: slideDown 1s ease-out forwards;
  }

  .container {
    animation: slideUp 1s ease-out forwards;
    animation-delay: 0.5s; /* 延遲開始時間讓header動畫先進行 */
  }

  .container2 {
    animation: slideUp 1s ease-out forwards;
    animation-delay: 1s; /* 等待.container動畫到一半 */
  }
  /* 網頁動畫結束 */

      </style>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <body>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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

        <!-- Header - set the background image for the header in the line below-->
        <header class="py-5 bg-image-full" >
          <div >
              
          </div>
          
      </header>
      
       <!--<hr style="width: 100%; margin: 0 auto; border-top: 3px solid #66719D; margin-top: 20px;opacity: 100%;">-->
    
       <div class="parent-container">
            <!-- 意見回饋 made by kimmo -->
            <div class="container" style="position: sticky; margin-top: 0%; margin-bottom: 10%;margin-left: -10px;">
              <div class="row justify-content-start">
                  <div class="col-md-6">
                    <p style="margin-left: 100px;margin-top: -10px;font-size: 40px;font-weight: bold;color: #66719D;">聯絡我們</p>
                    <img src="圖片/phone.png" style="height: 50px;margin-left: 100px;margin-top: 10px;">
                    <p style="margin-left: 160px;margin-top: -50px;font-weight: bold;font-size: 15px;">致電給我們</p>
                    <p style="margin-left: 160px;margin-top: -10px;font-weight: bold;font-size: 15px;color: #495057;">04-22195678</p>
                    <hr style="width: 70%; margin: 0 auto; border-top: 1px solid #DDDDDD; margin-top: 20px;opacity: 100%;">
                    <img src="圖片/email.png" style="height: 50px;margin-left: 100px;margin-top: 30px;">
                    <p style="margin-left: 160px;margin-top: -50px;font-weight: bold;font-size: 15px;">寄信給我們</p>
                    <p style="margin-left: 160px;margin-top: -10px;font-weight: bold;font-size: 15px;color: #495057;">eportal@qmail.nutc.edu.tw</p>
                    <hr style="width: 70%; margin: 0 auto; border-top: 1px solid #DDDDDD; margin-top: 20px;opacity: 100%;">
                    <img src="圖片/location.png" style="height: 50px;margin-left: 100px;margin-top: 30px;">
                    <p style="margin-left: 160px;margin-top: -50px;font-weight: bold;font-size: 15px;">GLAMCYCLE 辦公室</p>
                    <p style="margin-left: 160px;margin-top: -10px;font-weight: bold;font-size: 15px;color: #495057;">404台中市北區三民路三段129號</p>
                   
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29125.881620099317!2d120.62655709099127!3d24.145935778732955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693d68cf62e061%3A0x7091dd73273f6236!2z5ZyL56uL6Ie65Lit56eR5oqA5aSn5a24!5e0!3m2!1szh-TW!2stw!4v1712679082180!5m2!1szh-TW!2stw" width="600" height="300" style="border:0;margin-left: 100px;margin-bottom: 20px;margin-top: 30px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
              </div>
          </div>
          
          <div class="container2" style="position: sticky; margin-top: -46%; margin-bottom: 10%;margin-left: 800px;width: 500px;">
              <div class="row justify-content">
                  <div class="col-md-6">
                    <h1 style="margin-bottom: 30px;margin-top: -150px;font-size: 40px;font-weight: bold;color: #66719D;">意見回饋</h1>
                    <hr style="width: 150%; margin: 0 auto; border-top: 1px solid #DDDDDD; margin-top: 20px;opacity: 100%;margin-bottom: 30px;">
                      <form action="submit.php" method="post" class="needs-validation" novalidate>  
                  <div class="mb-3" style="margin-top: 50px;">
                    <label for="nameInput" class="form-label">姓名</label>
                    <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="請輸入您的姓名" pattern="[\u4e00-\u9fa5\s·]+" required title="姓名只能包含中文字符、空格及·"style="width: 600px;">
                    <div class="invalid-feedback">
                      請輸入您的姓名。
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">電子信箱</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" required style="width: 600px;">
                    <div class="invalid-feedback">
                      請輸入一個有效的電子郵件地址。
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <label for="feedbackTextarea" class="form-label">意見或建議</label>
                    <textarea class="form-control" id="feedbackTextarea" name="feedbackTextarea" rows="3" placeholder="請在此處輸入您的意見或建議" required style="width: 600px;height: 150px;"></textarea>
                    <div class="invalid-feedback">
                      請輸入您的意見或建議。
                    </div>
                  </div>
                  
                
                    <!-- 驗證機器人 -->
                        <!-- 你的表单内容 -->
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                        <button type="submit" class="btn btn-primary"style="margin-bottom:-50px;width: 600px;height: 50px;">提交</button>
                    </form>
                </form>
              </div>
            </div>
          </div>
       </div>
          <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
          <script src="https://www.google.com/recaptcha/api.js?render=6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu"></script>
          <script>
              grecaptcha.ready(function() {
                  grecaptcha.execute('6Lew6pMpAAAAACtHg6401eggdpStQxrvAP8T1SPu', {action: 'submit'}).then(function(token) {
                      document.getElementById('recaptchaResponse').value = token;
                  });
              });
          </script>
          </body>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
       
    </body>
</html>

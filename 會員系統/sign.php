<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>登入 / 註冊 | GLAMCYCLE</title>
    <link rel="icon" type="icon" href="icon/gc.png" />
    <link rel="stylesheet" href="sign0.css">
<body>
<style>
        .grecaptcha-badge {
            z-index: 1000; 
        }
    </style>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $recaptchaResponse = $_POST['recaptcha_response'];


    $secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {

        if ($password === $confirm_password) {
 
            $conn = new mysqli('localhost', 'root', '', 'cycle');
            if ($conn->connect_error) {
                die("連接失敗: " . $conn->connect_error);
            }
            $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')";
            if ($conn->query($sql) === TRUE) {
                header('Location: /小專檔案/首頁網站/index.php');
                exit();
            } else {
                echo "錯誤: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        } else {
            echo "密碼不正確，請重新輸入。";
        }
    } else {
        echo "驗證失敗或懷疑是機器人行為";
    }
}
?>


<div class="abc">
<div style="margin-top: 40px; text-align: center;">
    <img src="會員註冊_登入/logo.png" id="logo" style="width: 120px;border-radius:25px; ">
    <p><strong style='color:#637A9F'>登入 LOG IN / 註冊 SIGN UP</strong></p>
</div>

  <div style="background-color:#fff;height:600px;width: 80%;margin: -8px auto 0 ;border: 1px solid #fff;border-radius:25px;box-shadow: 10px 10px 10px  rgba(0, 0, 0, 0.1);">
    <div class="container">
        <div class="login-section">
            <h2>登入 LOG IN</h2>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="電子郵件" required>
                <input type="password" name="password" placeholder="密碼" required>
                <button type="submit">登入</button>
                <a>沒有會員，請先點擊右側的會員註冊喔 !<br>
                <br><br><br><br><br><br><br><br><br><br><br>忘記密碼?請聯絡客服專線。電話:04-2219-5678
                <br>( 週一至週五早上9:00-17:00，非服務時間請勿直接撥打 )
                </a>
            </form>
        </div>

    <hr size="1" style="height:500px;" ></hr>
        <div class="signup-section">
            <h2>註冊 SIGN UP</h2>
            
            <form id="signupForm" action="signup.php" method="post">
                <input type="text" name="username" placeholder="用戶名稱" required>
                <input type="email" name="email" placeholder="電子郵件" required>
                <input type="text" name="phone" placeholder="手機號碼" pattern="\d{10}" title="請輸入10位數字的手機號碼" required>
                <input type="password" name="password" placeholder="密碼（至少8位元，須包含英文字母）" minlength="8" required>
                <input type="password" name="confirm_password" placeholder="再次確認密碼" minlength="8" required>
                <div class="captcha-container">
                   <img src="captcha.php" alt="CAPTCHA Image" id="imgcode" style="vertical-align: middle;border: 1px solid #DDDDDD;border-radius: 4px;">
                </div>
                <div class="captcha-container">
                   <button type="button" onclick="refresh_code()" style="vertical-align: middle;background-image:url('會員註冊_登入/換圖片.png');color: #B3C8CF;">⠀⠀⠀⠀⠀⠀</button>
                </div>
                <input type="text" name="captcha" id="captchaInput" placeholder="請輸入上方驗證碼" required onblur="validateCaptcha()">
                <div id="captchaStatus"></div>
                <button type="submit">註冊</button>
            </form>

        </div>
    </div>
</div>
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
function refresh_code(){ 
    document.getElementById("imgcode").src = "captcha.php?" + Math.random();
} 
function validateCaptcha() {
    var captcha = document.getElementById("captchaInput").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_captcha.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            var statusContainer = document.getElementById("captchaStatus");
            if (response.success) {
                statusContainer.innerHTML = "<span style='color: green;'>✔</span>";
            } else {
                statusContainer.innerHTML = "<span style='color: red;'>✘ 驗證失敗，請再次輸入驗證碼，或更換驗證碼</span>";
                refresh_code(); 
            }
        }
    };
    xhr.send("captcha=" + encodeURIComponent(captcha));
}


document.getElementById("signupForm").onsubmit = function(event) {
    var captchaInput = document.getElementById("captchaInput").value;
    var statusContainer = document.getElementById("captchaStatus");

    if (captchaInput.trim() === "" || !statusContainer.innerHTML.includes("✔")) {
        alert("請先輸入並通過驗證碼驗證！");
        event.preventDefault(); 
        return false;
    }
};




</script>

</html>

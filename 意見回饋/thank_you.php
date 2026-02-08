<!-- 感謝意見回饋頁面 -->
<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>意見回饋 | GLAMCYCLE</title>
<link rel="icon" type="icon" href="icon/gc.png" />
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
        text-align: center;
        padding: 50px;
    }

    h1 {
        color: #333;
        animation: slideIn 1s ease-out;
    }

    p {
        color: #666;
        font-size: 18px;
        margin-top: 20px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .button:hover {
        background-color: #000000;
        transform: scale(1.05);
    }
</style>
</head>
<body>
    <h1>感謝您的回饋！</h1>
    <p>我們非常重視您的意見，將會進行仔細評估。</p>
    <a href="feedback.php" class="button">返回首頁</a>
</body>
</html>

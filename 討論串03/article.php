<?php

include '../會員系統/auth0.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "cycle", 3308);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 增加輸入檢查
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die('無效的文章ID');
}

// 檢查是否登錄
if (!isset($_SESSION['user_id'])) {
    die('請先登錄再進行操作');
}

// 檢查評論是否為空
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    $comment = trim($_POST['comment']);
    if (!empty($comment)) {
        $userId = $_SESSION['user_id'];
        $query = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $query->bind_param("iis", $id, $userId, $comment);
        if (!$query->execute()) {
            error_log('留言失敗: ' . $conn->error);  // 錯誤記錄
        }
    }
}
$user_id = $_SESSION['user_id']; // 從會話中獲取用戶ID
$sql = "INSERT INTO posts (user_id, title, content, image_path) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $title, $content, $image_path);

$commentsQuery = $conn->prepare("SELECT comments.comment, users.username AS name FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ?");
$commentsQuery->bind_param("i", $id);
$commentsQuery->execute();
$commentsResult = $commentsQuery->get_result();


$postQuery = $conn->prepare("SELECT posts.*, users.username AS username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$postQuery->bind_param("i", $id);
$postQuery->execute();
$result = $postQuery->get_result();



$postQuery = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$postQuery->bind_param("i", $id);
$postQuery->execute();
$result = $postQuery->get_result();

$likesQuery = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?");
$likesQuery->bind_param("i", $id);
$likesQuery->execute();
$likesResult = $likesQuery->get_result();
$likesCount = $likesResult->fetch_assoc()['like_count'];

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>貼文 | GLAMCYCLE</title>
    <link rel="icon" type="icon" href="icon/gc.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {

    background-color: #f0f2f5;
    
}


.col-md-8 {
    width: 100%; /* 适应父容器宽度 */
    max-width: 66.66667%; /* 基于 Bootstrap 的栅格系统 */
}

.article-image, .comments-section, .user-info, .paw-button {
    width: 100%; /* 确保子元素宽度适应其容器 */
}

        .article-image {
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .comments-section {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .comment {
            border-top: 1px solid #eeeeee;
            padding: 10px 0;
        }
        .paw-button {
    --background: #fff;
    --background-active: #FEE8F4;
    --border: #F1ECEB;
    --border-active: #EEC2DB;
    --text: #000;
    --number: #9C9496;
    --number-active: #000;
    --heart-background: #fff;
    --heart-background-active: #FEA5D7;
    --heart-border: #C3C2C0;
    --heart-border-active: #2B2926;
    --heart-shadow-light: #FEE0F2;
    --heart-shadow-dark: #EA5DAF;
    --paw-background: #fff;
    --paw-border: #201E1B;
    --paw-shadow: #EEEDED;
    --paw-inner: var(--heart-background-active);
    --paw-shadow-light: var(--heart-shadow-light);
    --paw-shadow-dark: var(--heart-shadow-dark);
    --paw-clap-background: #FEF0A5;
    --paw-clap-border: var(--paw-border);
    --paw-clap-shadow: #FED75C;
    --circle: #df3dce;
    --circle-line: #000;
    display: inline-flex;
    text-decoration: none;
    font-weight: bold;
    position: relative;
    line-height: 19px;
    padding: 12px 16px;
    &:before {
        content: '';
        position: absolute;
        display: block;
        left: -2px;
        top: -2px;
        bottom: -2px;
        right: -2px;
        z-index: 1;
        border-radius: 5px;
        transition: background .45s, border-color .45s;
        background: var(--background);
        border: 2px solid var(--border);
    }
    svg {
        display: block;
    }
    .text {
        position: relative;
        backface-visibility: hidden;
        transform: translateZ(0);
        z-index: 3;
        margin-right: 8px;
        transition: width .25s;
        width: var(--w, 60px);
        span,
        svg {
            transition: transform .15s ease-out, opacity .2s;
            opacity: var(--o, 1);
        }
        span {
            display: block;
            position: absolute;
            left: 30px;
            top: 0;
            transform: translateY(var(--y, 0));
            color: var(--text);
        }
        svg {
            --background: var(--heart-background);
            --border: var(--heart-border);
            --shadow-light: transparent;
            --shadow-dark: transparent;
            width: 21px;
            height: 19px;
            transform: translateX(var(--x));
        }
    }
    & > span {
        display: block;
        position: relative;
        backface-visibility: hidden;
        transform: translateZ(0);
        z-index: 2;
        color: var(--number);
    }
    .paws {
        overflow: hidden;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 60px;
        z-index: 2;
        svg {
            position: absolute;
            bottom: 0;
            transition: transform .3s ease-out, opacity .2s;
            opacity: var(--o, 0);
            transform: translate(var(--x, 0), var(--y, 0));
            &.paw {
                --x: -24px;
                width: 30px;
                height: 37px;
                left: 32px;
            }
            &.paw-clap {
                --x: 16px;
                --y: 34px;
                --o: 1;
                width: 29px;
                height: 34px;
                left: 34px;
            }
        }
        .paw-effect {
            left: 26px;
            top: 12px;
            width: 44px;
            height: 44px;
            position: absolute;
            &:before {
                content: '';
                display: block;
                width: 100%;
                height: 100%;
                border-radius: 50%;
                background: var(--circle);
                transform: scale(var(--s, 0));
                opacity: var(--o, 1);
                transition: transform .15s ease .16s, opacity .2s linear .25s;
            }
            div {
                width: 2px;
                height: 6px;
                border-radius: 1px;
                left: 50%;
                bottom: 50%;
                margin-left: -1px;
                position: absolute;
                background: var(--circle-line);
                transform: translateY(-24px) scaleX(.7) scaleY(var(--s, 0));
                &:before,
                &:after {
                    content: '';
                    display: block;
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background: inherit;
                    border-radius: inherit;
                    transform: translate(var(--x, -22px), var(--y, 4px)) rotate(var(--r, -45deg)) scaleX(.8) scaleY(var(--s, 0));
                }
                &:after {
                    --x: 22px;
                    --r: 45deg;
                }
            }
            div,
            div:before,
            div:after {
                opacity: var(--o, 1);
                transform-origin: 50% 100%;
                transition: transform .12s ease .17s, opacity .18s linear .21s;
            }
        }
    }
    i {
        position: absolute;
        display: block;
        width: 4px;
        height: 4px;
        top: 50%;
        left: 50%;
        margin: -2px 0 0 -2px;
        opacity: var(--o, 0);
        background: var(--b);
        transform: translate(var(--x), var(--y)) scale(var(--s, 1));
    }
    &:not(.confetti) {
        &:hover {
            .text {
                --o: 0;
                --x: 12px;
                --y: 8px;
            }
            .paws {
                svg {
                    &.paw {
                        --o: 1;
                        --x: 0;
                    }
                }
            }
        }
    }
    &.animation {
        .text {
            --o: 0;
            svg {
                --background: var(--heart-background-active);
                --border: var(--heart-border-active);
                --shadow-light: var(--heart-shadow-light);
                --shadow-dark: var(--heart-shadow-dark);
            }
        }
        .paws {
            svg {
                &.paw {
                    --x: 0;
                    --o: 1;
                    transition-delay: 0s;
                    animation: paw .45s ease forwards;
                }
                &.paw-clap {
                    animation: paw-clap .5s ease-in forwards;
                }
            }
            .paw-effect {
                --s: 1;
                --o: 0;
            }
        }
    }
    &.confetti {
        i {
            animation: confetti .6s ease-out forwards;
        }
        .paws {
            svg {
                &.paw {
                    --o: 0;
                    transition: opacity .15s linear .2s;
                }
            }
        }
    }
    &.liked {
        --background: var(--background-active);
        --border: var(--border-active);
        .text {
            --w: 21px;
            svg {
                --o: 1;
            }
        }
        & > span {
            --number: var(--number-active);
        }
    }
}

@keyframes confetti {
    from {
        transform: translate(0, 0);
        opacity: 1;
    }
}

@keyframes paw {
    0% {
        transform: translateX(var(--x));
    }
    35% {
        transform: translateX(-16px);
    }
    55%,
    70% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-12px);
    }
}

@keyframes paw-clap {
    50%,
    70% {
        transform: translate(0, 0);
    }
}

html {
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

* {
    box-sizing: inherit;
    &:before,
    &:after {
        box-sizing: inherit;
    }
}

// Center & dribbble
body {
    min-height: 100vh;
    display: flex;
    font-family: 'Roboto', Arial;
    justify-content: center;
    align-items: center;
    background: #fff;
    .dribbble {
        position: fixed;
        display: block;
        right: 20px;
        bottom: 20px;
        img {
            display: block;
            height: 28px;
        }
    }
}
.user-info {
    display: flex;
    align-items: center; /* 垂直居中对齐 */
    font-family: Arial, sans-serif; /* 设置字体 */
}

.user-icon {
    width: 50px; /* 图标宽度 */
    height: 50px; /* 图标高度 */
    border-radius: 50%; /* 圆形 */
    display: flex;
    justify-content: center; /* 水平居中 */
    align-items: center; /* 垂直居中 */
    margin-right: 10px; /* 与用户名标签的间距 */
}

.username {
    color: #4a4a4a; /* 深灰色文字 */
    font-size: 20px; /* 文字大小 */
    font-weight: bold; /* 设置为粗体 */
}

    </style>
</head>
        

<body>

<div clqss="c1">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <?php if ($result->num_rows > 0) : $row = $result->fetch_assoc(); ?>
                <div class="user-info">
                    <span class="user-icon"><img src="assets/1.png" class="user-icon"></span>
                    <span class="username">發文者：<?=htmlspecialchars($row['post_user'])?></span>
                </div>
                <h1 style="margin-top:30px;"><?= htmlspecialchars($row["title"]) ?></h1>
                <p><?= nl2br(htmlspecialchars($row["content"])) ?></p>
                <img src="<?= htmlspecialchars($row["image_path"]) ?>" class="img-fluid article-image mb-3">
                <br>
                
                <button class="btn btn-primary paw-button" style="width: 80px; /* 图标宽度 */" onclick="handleLike(<?= $id ?>)" >
                    <span>Like</span> <span id="like-count" > <?= $likesCount ?>  </span>
                </button>
                <br><br>


            

                <div class="comments-section">
                    <h5>留言:</h5>
                    <form action="" method="POST">
                        <textarea class="form-control" name="comment" rows="3"></textarea>
                        <button class="btn btn-secondary mt-2" type="submit">送出</button>
                    </form>
                    <?php while ($commentRow = $commentsResult->fetch_assoc()): ?>
                    <div class="comment">
                        <strong><?= htmlspecialchars($commentRow['name']) ?></strong>: <?= htmlspecialchars($commentRow['comment']) ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php else: ?>
                <p>文章不存在</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function handleLike(postId) {
        fetch('like_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + postId
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'ok') {
                document.getElementById('like-count').textContent = data.likes;
            } else {
                alert('Error liking the post.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    let confettiAmount = 60,
    confettiColors = [
        '#7d32f5',
        '#f6e434',
        '#63fdf1',
        '#e672da',
        '#295dfe',
        '#6e57ff'
    ],
    random = (min, max) => {
        return Math.floor(Math.random() * (max - min + 1) + min);
    },
    createConfetti = to => {
        let elem = document.createElement('i'),
            set = Math.random() < 0.5 ? -1 : 1;
        elem.style.setProperty('--x', random(-260, 260) + 'px');
        elem.style.setProperty('--y', random(-160, 160) + 'px');
        elem.style.setProperty('--r', random(0, 360) + 'deg');
        elem.style.setProperty('--s', random(.6, 1));
        elem.style.setProperty('--b', confettiColors[random(0, 5)]);
        to.appendChild(elem);
    };

document.querySelectorAll('.paw-button').forEach(elem => {
    elem.addEventListener('click', e => {
        let number = elem.children[1].textContent;
        if(!elem.classList.contains('animation')) {
            elem.classList.add('animation');
            for(let i = 0; i < confettiAmount; i++) {
                createConfetti(elem);
            }
            setTimeout(() => {
                elem.classList.add('confetti');
                setTimeout(() => {
                    elem.classList.add('liked');
                    elem.children[1].textContent = parseInt(number) + 1;
                }, 400);
                setTimeout(() => {
                    elem.querySelectorAll('i').forEach(i => i.remove());
                }, 600);
            }, 260);
        } else {
            elem.classList.remove('animation', 'liked', 'confetti');
            elem.children[1].textContent = parseInt(number) - 1;
        }
        e.preventDefault();
    });
});

    </script>
</body>
</html>

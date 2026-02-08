<?php
session_start();

// 检查用户是否登录，如果未登录，则重定向到登录页面
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.html');
    exit;
}

// 获取登录用户的全名
$fullName = isset($_SESSION['admin_full_name']) ? $_SESSION['admin_full_name'] : '未知用户';

// 可以选择保留这行，如果你在其他地方需要用户名
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title>後臺管理 | GLAMCYCLE</title>
    <link rel="icon" type="image/png" href="pic/GClogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">GlamCycle</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar Dropdown-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="登入頁面/login.html">登出</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                            管理員帳號管理
                        </a>
                        <a class="nav-link" href="member.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            會員管理
                        </a>
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                            活動管理
                        </a>
                        
                        <a class="nav-link" href="feedback_admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                            意見回饋紀錄
                        </a>
                        <a class="nav-link" href="donate.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-donate"></i></div>
                            捐款紀錄
                        </a>
                        <a class="nav-link" href="thread.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                            討論串管理
                        </a>
                        <a class="nav-link" href="registration_admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                            活動報名紀錄
                        </a>
                        <a class="nav-link" href="volunteers.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-hands-helping"></i></div>
                            志工報名紀錄
                        </a>
                        
                        <a class="nav-link" href="store_admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                            店鋪管理
                            <a class="nav-link" href="news.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                            最新消息管理
                        </a>

                      
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">GlamCycle</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">後臺管理系統</li>
                    </ol>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">管理員帳號管理</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="admin.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">會員管理</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="member.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                            <div class="card-body">活動管理</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-white stretched-link" href="dashboard.php">進入管理頁面</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">意見回饋紀錄</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="feedback_admin.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">捐款紀錄</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="donate.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">討論串管理</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="thread.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">活動報名紀錄</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="registration_admin.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">志工報名紀錄</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="volunteers.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">店鋪管理</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="store_admin.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" style="background-color: #7D7C7C;">
                                <div class="card-body">最新消息管理</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="news.php">進入管理頁面</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;  GlamCycle 2024</div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

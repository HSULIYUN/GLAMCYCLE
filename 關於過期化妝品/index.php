<?php include '../會員系統/auth0.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
	    <title>過期化妝品 | GLAMCYCLE</title>
		<link rel="icon" type="icon" href="icon/gc.png" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>

	
	<body class="is-preload">
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

	

		

		

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-gem"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>過期化妝品</h1>
								<p>關於過期化妝品能做什麼</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#lipstick">⠀⠀過期口紅⠀⠀</a></li>
								<li><a href="#eyeshadow">⠀⠀過期眼影⠀⠀</a></li>
								<li><a href="#perfume">⠀⠀過期香水⠀⠀</a></li>
								<li><a href="#expired">關於過期這件事</a></li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- lipstick -->
							<article id="lipstick">
								<h2 class="major">過期口紅</h2>
								<span class="image main"><img src="images/口紅.png" alt="" /></span>
								<p> 過期口紅不僅可能會影響質地和顏色，還可能導致皮膚敏感或感染。一般來說，口紅的保質期通常為1到2年。
									如果口紅出現異味、顏色變化、質地變硬或變軟等情況，那就是它已經過期的明顯跡象。為了確保安全，
									最好遵循產品標籤上的建議使用期限，並定期檢查口紅是否仍然適合使用。 <a href="#eyeshadow">過期眼影</a>也是如此</p>
								<p>不過，我們仍然可以考慮將過期口紅作為一些創意和藝術性的用途，比如：<br>
									藝術創作：可以將過期口紅用於繪畫、手工藝品或者其他藝術作品中，這樣既能夠發揮口紅的色彩效果，又能夠做到環保再利用。<br>
									DIY項目：將過期口紅與其他材料結合，製作自製護唇膏、護手霜或者潤唇膏等護膚產品，但是請注意，使用過期口紅製作的產品可能不夠衛生或者效果不佳，所以最好僅限於個人使用。<br>
									總的來說，過期口紅的用途有限，最好還是妥善處理，避免直接接觸皮膚以免引起不良反應。</p>
							</article>

						<!-- eyeshadow -->
							<article id="eyeshadow">
								<h2 class="major">過期眼影</h2>
								<span class="image main"><img src="images/眼影.png" alt="" /></span>
								<p>過期的眼影同樣不建議再用在眼睛上，因為它可能已經失去了原有的質地，且可能含有細菌或其他有害物質，這可能導致眼部敏感或感染。</p>
								<p>過期的眼影跟口紅一樣其實都不適合在使用，但是丟掉又很可惜。<br>
									因為口紅的顏色較為單一，所以我們想將過期的眼影也當作顏料來使用。<br>
									這樣不僅豐富了色彩還讓過期的眼影可以發揮它最大的用處。</p>
							</article>

						<!-- perfume -->
							<article id="perfume">
								<h2 class="major">過期香水</h2>
								<span class="image main"><img src="images/香水.png" alt="" /></span>
								<p>過期的香水可能已經失去了原有的香氣，但你仍然可以考慮將它用於以下方式：<br>
									家居用途：你可以將過期的香水用作室內空氣清新劑。將一些香水噴灑在室內布置或傢俱上，或者添加到水中用作噴霧。這可以讓空氣充滿淡淡的香氣，使室內更加愉悅。<br>
									衣物和布料：如果香水的味道並未完全消失，你可以將它輕輕地噴灑在衣物或布料上，以為它們增添一絲淡淡的香味。但要小心，避免使用過多，以免香水損壞衣物或留下油漬。<br>
									DIY項目：你還可以將過期的香水用於手工藝品或DIY項目中，比如製作香氛蠟燭或者香水固體蠟燭等。</p>
							</article>

						<!-- expired -->
						<article id="expired">
							<h2 class="major">關於過期這件事</h2>
							<span class="image main"><img src="images/關於過期化妝品.png" alt="" /></span>
							<p>在我們的日常生活中，使用化妝品已經成為許多人不可或缺的一部分。<br>
								然而，當這些化妝品過期後，許多人往往會直接將它們丟棄，而不知道其實還有許多方式可以再利用這些過期的產品。<br>
								藝術與創作：過期的化妝品可以成為藝術創作的素材。比如，過期的眼影和口紅可以用來繪畫畫作，或者製作手工藝品。這樣不僅能夠發揮化妝品獨特的色彩和質地，還能夠實現對化妝品的再利用，同時也鼓勵了藝術創作的發展。<br>
								DIY美妝產品：你可以將過期的化妝品用於製作自製的美妝產品。例如，將過期的眼影粉碎後加入無香礦物油，製作成唇彩或腮紅。這樣既可以充分利用化妝品的色彩效果，又可以自製符合個人需求的美妝產品。<br>
								教育和示範：將過期的化妝品用於化妝課程或示範中，讓學生了解化妝品的保質期和使用方法。這不僅可以增加學生的知識，還能夠提高對化妝品資源的利用率，避免浪費。<br>
								家居和個人護理：過期的化妝品可以用於家居清潔或個人護理中。例如，過期的香水可以用作室內空氣清新劑，過期的面膜可以用於護膚或者美容浴。這樣不僅可以為家居營造愉悅的氛圍，還能夠實現對化妝品資源的充分利用。<br>
								總的來說，過期化妝品雖然不能再用於皮膚上，但仍然有許多其他的用途。通過創意和想象力，我們可以將這些過期的產品轉化為有價值的資源，實現對化妝品資源的充分利用，同時也促進了可持續發展的理念。</p>
						</article>
				</div>

				<!-- Footer -->
				<footer id="footer">
					<p class="copyright">前往過期化妝品捐贈 <a href="../門市/store.php">門市查詢</a>.</p>
				</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
		   
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	</body>
</html>

window.addEventListener('load', function () {
    var loadingScreen = document.getElementById('loading');
    var content = document.querySelector('.content');
    setTimeout(function () {
        loadingScreen.style.display = 'none';
        content.style.display = 'block';
    }, 3000); // 延遲 3 秒後隱藏載入畫面並顯示主內容
});

document.querySelector('.event-title').addEventListener('click', function() {
    this.style.color = this.style.color === 'blue' ? '#333' : 'blue';
});


document.addEventListener("DOMContentLoaded", function() {
    const title = document.querySelector('.slide-in');
    title.classList.add('slide-active');
});

document.addEventListener("DOMContentLoaded", function() {
    // 首先處理標題
    const titles = document.querySelectorAll('.float-up');
    titles.forEach(title => {
        if (title.tagName === 'H1') {
            title.classList.add('float-active');
        }
    });

    // 然後處理段落，延遲0.5秒
    setTimeout(() => {
        const paragraphs = document.querySelectorAll('.div06 .float-up');
        paragraphs.forEach(p => {
            p.classList.add('float-active');
        });
    }, 200); // 500毫秒的延遲
});

document.addEventListener("DOMContentLoaded", function() {
    // 創建 observer 實例
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // 當元素進入視口時添加 float-active 類別來觸發動畫
                entry.target.classList.add('float-active');
                observer.unobserve(entry.target); // 一旦動畫觸發，停止觀察
            }
        });
    }, {
        threshold: 0.1  // 配置元素至少有10%可見時觸發
    });

    // 用 observer 觀察所有帶有 float-up 類別的元素
    document.querySelectorAll('.float-up').forEach(el => {
        observer.observe(el);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // 為圖像添加 fade-active 來觸發淡入效果
                const img = entry.target.closest('.div08').querySelector('img.fade-in');
                if (img) {
                    img.classList.add('fade-active');
                }

                // 同時處理原來的 float-up 元素
                const elementsToAnimateFirst = entry.target.closest('.div08').querySelectorAll('span:nth-of-type(1)');
                elementsToAnimateFirst.forEach(el => {
                    el.classList.add('float-active');
                });

                // 200毫秒後為其餘文本添加 float-active
                setTimeout(() => {
                    const elementsToAnimateLater = entry.target.closest('.div08').querySelectorAll('p, span:nth-of-type(2)');
                    elementsToAnimateLater.forEach(el => {
                        el.classList.add('float-active');
                    });
                }, 200);

                observer.unobserve(entry.target); // 動畫觸發後取消觀察
            }
        });
    }, {
        threshold: 0.1
    });

    // 觀察所有需要觸發動畫的 h2 標籤
    document.querySelectorAll('.div03 h2').forEach(h2 => {
        observer.observe(h2);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const container = entry.target.closest('.div03').nextElementSibling;
                const elementsToAnimate = container.querySelectorAll('.float-up');
                elementsToAnimate.forEach(el => {
                    el.classList.add('float-active');
                });

                observer.unobserve(entry.target); // 動畫觸發後取消觀察
            }
        });
    }, {
        threshold: 0.1
    });

    // 觀察活動特色的 h2 標籤
    document.querySelector('.div03 .centered-content h2').forEach(h2 => {
        observer.observe(h2);
    });
});
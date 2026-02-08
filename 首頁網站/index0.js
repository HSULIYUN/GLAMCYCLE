document.addEventListener("mousemove", parallax);
function parallax(e) {
  document.querySelectorAll(".object").forEach(function(move) {
    var moving_value = move.getAttribute("data-value");
    var x = (e.clientX * moving_value) / 600; // 修改此處的分母可調整移動的幅度
    var y = (e.clientY * moving_value) / 600; // 修改此處的分母可調整移動的幅度
    move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
  });
}
window.onload = function() {
// 淡入 group1 圖片
fadeInImages('.group1', () => {
  // 在 group1 圖片淡入後，延遲一段時間後淡入 group2 圖片
  setTimeout(() => {
    fadeInImages('.group2');
  }, 50); // 這裡的 2000 是延遲時間，可以根據需要調整
});
};

function fadeInImages(selector, callback) {
const images = document.querySelectorAll(selector);
let imagesShown = 0;
Array.from(images).forEach((img, index) => {
  setTimeout(() => {
    img.style.opacity = 1; // 先將透明度設為1以進行淡入動畫

    // 淡入動畫結束後，設定圖片的最終透明度
    setTimeout(() => {
      const finalOpacity = img.getAttribute('data-opacity') || 1; // 如果沒有設定 data-opacity，則預設透明度為1
      img.style.opacity = finalOpacity;
      imagesShown++;
      if(imagesShown === images.length && callback) {
        callback();
      }
    }, 500); // 調整此處的 2000 為動畫持續時間
  }, index * 50); // 每張圖片淡入的間隔時間
});
}

document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0; 

    function updateCards() {
        const cards = document.querySelectorAll('#cards-container > div');
        
        cards.forEach((card, index) => {
           
            let newPosition = (index - currentIndex + 5) % 5;
            
            switch (newPosition) {
                case 0: 
                    card.style.transform = 'translateX(0%) scale(1)';
                    card.style.zIndex = 4; // 确保中间的卡片在最上面
                    break;
                case 1: 
                    card.style.transform = 'translateX(100%) scale(0.8)';
                    card.style.zIndex = 3;
                    break;
                case 2: 
                    card.style.transform = 'translateX(190%) scale(0.8)';
                    card.style.zIndex = 2;
                    break;
                case 3: 
                    card.style.transform = 'translateX(-100%) scale(0.8)';
                    card.style.zIndex = 1;
                    break;
                case 4: 
                    card.style.transform = 'translateX(-190%) scale(0.8)';
                    card.style.zIndex = 0;
                    break;
            }
        });
    }

    
    window.showNextCard = function() {
        currentIndex = (currentIndex + 1) % 5; 
        updateCards(); 
    };

   
    window.showPrevCard = function() {
        currentIndex = (currentIndex - 1 + 5) % 5; 
        updateCards(); 
    };

    updateCards(); 
});

// 用于存储每个.object元素的位移
// 存储每个.object元素的位移
const objectDisplacements = new Map();

document.addEventListener("mousemove", parallax);
function parallax(e) {
    document.querySelectorAll(".object").forEach(function(move, index) {
        var moving_value = move.getAttribute("data-value");
        var x = (e.clientX * moving_value) / 600; // 调整此处的分母可调整移动的幅度
        var y = (e.clientY * moving_value) / 600; // 调整此处的分母可调整移动的幅度

        // 保存最新的位移值
        objectDisplacements.set(move, { x, y });

        // 更新位移，此时不包括缩放
        updateTransform(move);
    });
}

document.addEventListener("mousemove", parallax);
function parallax(e) {
  document.querySelectorAll(".object").forEach(function(move) {
    var moving_value = move.getAttribute("data-value");
    var x = (e.clientX * moving_value) / 600; // 修改此處的分母可調整移動的幅度
    var y = (e.clientY * moving_value) / 600; // 修改此處的分母可調整移動的幅度
    move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
  });
}
window.onload = function() {
// 淡入 group1 圖片
fadeInImages('.group1', () => {
  // 在 group1 圖片淡入後，延遲一段時間後淡入 group2 圖片
  setTimeout(() => {
    fadeInImages('.group2');
  }, 50); // 這裡的 2000 是延遲時間，可以根據需要調整
});
};

function fadeInImages(selector, callback) {
const images = document.querySelectorAll(selector);
let imagesShown = 0;
Array.from(images).forEach((img, index) => {
  setTimeout(() => {
    img.style.opacity = 1; // 先將透明度設為1以進行淡入動畫

    // 淡入動畫結束後，設定圖片的最終透明度
    setTimeout(() => {
      const finalOpacity = img.getAttribute('data-opacity') || 1; // 如果沒有設定 data-opacity，則預設透明度為1
      img.style.opacity = finalOpacity;
      imagesShown++;
      if(imagesShown === images.length && callback) {
        callback();
      }
    }, 500); // 調整此處的 2000 為動畫持續時間
  }, index * 50); // 每張圖片淡入的間隔時間
});
}

document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0; 

    function updateCards() {
        const cards = document.querySelectorAll('#cards-container > div');
        
        cards.forEach((card, index) => {
           
            let newPosition = (index - currentIndex + 5) % 5;
            
            switch (newPosition) {
                case 0: 
                    card.style.transform = 'translateX(0%) scale(1)';
                    card.style.zIndex = 4; // 确保中间的卡片在最上面
                    break;
                case 1: 
                    card.style.transform = 'translateX(100%) scale(0.8)';
                    card.style.zIndex = 3;
                    break;
                case 2: 
                    card.style.transform = 'translateX(190%) scale(0.8)';
                    card.style.zIndex = 2;
                    break;
                case 3: 
                    card.style.transform = 'translateX(-100%) scale(0.8)';
                    card.style.zIndex = 1;
                    break;
                case 4: 
                    card.style.transform = 'translateX(-190%) scale(0.8)';
                    card.style.zIndex = 0;
                    break;
            }
        });
    }

    
    window.showNextCard = function() {
        currentIndex = (currentIndex + 1) % 5; 
        updateCards(); 
    };

   
    window.showPrevCard = function() {
        currentIndex = (currentIndex - 1 + 5) % 5; 
        updateCards(); 
    };

    updateCards(); 
});











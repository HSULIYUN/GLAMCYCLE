document.addEventListener("mousemove", parallax);
function parallax(e) {
  document.querySelectorAll(".object").forEach(function(move) {
    var moving_value = move.getAttribute("data-value");
    var x = (e.clientX * moving_value) / 600; 
    var y = (e.clientY * moving_value) / 600; 
    move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
  });
}
window.onload = function() {

fadeInImages('.group1', () => {

  setTimeout(() => {
    fadeInImages('.group2');
  }, 50); 
});
};

function fadeInImages(selector, callback) {
const images = document.querySelectorAll(selector);
let imagesShown = 0;
Array.from(images).forEach((img, index) => {
  setTimeout(() => {
    img.style.opacity = 1; 

    
    setTimeout(() => {
      const finalOpacity = img.getAttribute('data-opacity') || 1; 
      img.style.opacity = finalOpacity;
      imagesShown++;
      if(imagesShown === images.length && callback) {
        callback();
      }
    }, 500); 
  }, index * 50); 
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
                    card.style.zIndex = 4; 
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


const objectDisplacements = new Map();

document.addEventListener("mousemove", parallax);
function parallax(e) {
    document.querySelectorAll(".object").forEach(function(move, index) {
        var moving_value = move.getAttribute("data-value");
        var x = (e.clientX * moving_value) / 600; 
        var y = (e.clientY * moving_value) / 600;

  
        objectDisplacements.set(move, { x, y });

   
        updateTransform(move);
    });
}

document.addEventListener("mousemove", parallax);
function parallax(e) {
  document.querySelectorAll(".object").forEach(function(move) {
    var moving_value = move.getAttribute("data-value");
    var x = (e.clientX * moving_value) / 600; 
    var y = (e.clientY * moving_value) / 600; 
    move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
  });
}
window.onload = function() {

fadeInImages('.group1', () => {

  setTimeout(() => {
    fadeInImages('.group2');
  }, 50);
});
};

function fadeInImages(selector, callback) {
const images = document.querySelectorAll(selector);
let imagesShown = 0;
Array.from(images).forEach((img, index) => {
  setTimeout(() => {
    img.style.opacity = 1; 


    setTimeout(() => {
      const finalOpacity = img.getAttribute('data-opacity') || 1; 
      img.style.opacity = finalOpacity;
      imagesShown++;
      if(imagesShown === images.length && callback) {
        callback();
      }
    }, 500); 
  }, index * 50); 
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
                    card.style.zIndex = 4; 
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











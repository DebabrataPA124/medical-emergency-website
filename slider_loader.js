  // Loading Animation
  window.addEventListener('load', () => {
    const loader = document.querySelector('.loader-wrapper');
    loader.style.opacity = '0';
    setTimeout(() => {
        loader.style.display = 'none';
    }, 500);
});
// Get references to slider elements
let slider = document.querySelector('.slider');
let sliderList = slider.querySelector('.slider .list');
let thumbnail = document.querySelector('.slider .thumbnail');
let thumbnailItems = thumbnail.querySelectorAll('.item');

let nextBtn = document.querySelector('.nextPrevArrows .next');
let prevBtn = document.querySelector('.nextPrevArrows .prev');

// Initially mark the first slide and thumbnail as active
sliderList.querySelector('.item').classList.add('active');
thumbnailItems[0].classList.add('active');

// Move first thumbnail to the end to loop seamlessly
thumbnail.appendChild(thumbnailItems[0]);

// Function to move the slider
function moveSlider(direction) {
let sliderItems = sliderList.querySelectorAll('.item');
let thumbnailItems = document.querySelectorAll('.thumbnail .item');

// Remove active class from all items
sliderItems.forEach(item => item.classList.remove('active'));
thumbnailItems.forEach(item => item.classList.remove('active'));

if (direction === 'next') {
sliderList.appendChild(sliderItems[0]);
thumbnail.appendChild(thumbnailItems[0]);
slider.classList.add('next');
} else {
sliderList.prepend(sliderItems[sliderItems.length - 1]);
thumbnail.prepend(thumbnailItems[thumbnailItems.length - 1]);
slider.classList.add('prev');
}

// Add active class after DOM updates
setTimeout(() => {
sliderList.querySelector('.item').classList.add('active');
thumbnail.querySelector('.item').classList.add('active');
}, 50);

// Remove animation classes after animation ends
slider.addEventListener('animationend', () => {
slider.classList.remove('next');
slider.classList.remove('prev');
}, { once: true });
}

// Button click event listeners
nextBtn.addEventListener("click", () => {
moveSlider('next');
resetAutoplay();
});
prevBtn.addEventListener("click", () => {
moveSlider('prev');
resetAutoplay();
});

// Autoplay functionality
let autoplayInterval = setInterval(() => {
moveSlider('next');
}, 3000);

function resetAutoplay() {
clearInterval(autoplayInterval);
autoplayInterval = setInterval(() => {
moveSlider('next');
}, 3000);
}

// Pause on mouse hover
slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
slider.addEventListener('mouseleave', resetAutoplay);


// Create a new div element for the preload animation
var preloadDiv = document.createElement('div');
preloadDiv.className = 'preloader';
document.body.appendChild(preloadDiv);

// Define your preload animation CSS here
// For example, using a background image with a GIF animation
var preloadCSS = document.createElement('style');
preloadCSS.textContent = `
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #ffffff;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.preloader img {
    width: 100px;
    height: 100px;
    
}

@keyframes spinner {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
`;
document.head.appendChild(preloadCSS);

// Set the source of the GIF animation
var preloadGIF = document.createElement('img');
preloadGIF.src = 'images/loading.gif';
preloadDiv.appendChild(preloadGIF);

// Hide the preload animation when the window finishes loading
window.addEventListener('load', function() {
    preloadDiv.style.display = 'none';
});

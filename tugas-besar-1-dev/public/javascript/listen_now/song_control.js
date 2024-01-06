const audio = document.getElementById("song");
const playPauseButton = document.getElementById("playPause");
const seekSlider = document.getElementById("seek");
const currentTime = document.getElementById("currentTime");
const duration = document.getElementById("duration");
const playPauseImage = playPauseButton.querySelector("img");
const overlayLine = document.getElementById("overlay");
const songName = document.getElementById("dot");


// Play/Pause button click event
playPauseButton.addEventListener("click", function () {
    if (audio.paused || audio.ended) {
        audio.play();
        playPauseImage.src = "../../../public/img/pause.svg";
    } else {
        audio.pause();
        playPauseImage.src = "../../../public/img/play.svg";
    }
});

// Update seek bar as audio plays
audio.addEventListener("timeupdate", function () {
    let currentDuration = audio.currentTime;
    currentTime.innerHTML = formatTime(currentDuration);
    
    let restDuration = audio.duration;
    duration.innerHTML = formatTime(restDuration - currentDuration);
    
    let progress = (audio.currentTime / audio.duration) * 100;
    seekSlider.value = progress;
    
    let seekPos = seekSlider.value;
    overlayLine.style.width = seekPos + "%";
    dot.style.left = seekPos + "%";
});

// Update duration text when audio metadata is loaded
audio.addEventListener("loadedmetadata", function () {
    duration.innerHTML = formatTime(audio.duration);
    // Set the max attribute of the seekSlider to the duration of the audio in seconds
});

seekSlider.addEventListener("change", function () {
    audio.currentTime = seekSlider.value * audio.duration / 100;
});

const volumeSlider = document.getElementById("volumeSlider");
const volumeLine = document.getElementById("volume-line");
const volumeDot = document.getElementById("volume-dot");
// Volume slider change event
volumeSlider.addEventListener("change", function () {
    volumeLine.style.width = volumeSlider.value + "%";
    volumeDot.style.left = volumeSlider.value + "%";
    audio.volume = volumeSlider.value / 100;
});

// Function to format time as mm:ss
function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

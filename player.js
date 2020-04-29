const playButton = document.getElementById('play-icon');
const previousButton = document.getElementById('previous-icon');
const nextButton = document.getElementById('next-icon');
const slider = document.getElementById('slider');
const seekSlider = document.getElementById('seek-slider');

var audio = document.getElementById('audio');

var isSeeking = false;

playButton.onmouseover =  function() {
    this.style.height = "36px";
};

playButton.onmouseout = function() {
    this.style.height = "35px";
};

playButton.onclick = function() {
    if(audio.paused){
        audio.play();
        if(document.getElementById('checkbox').checked){
            this.src = "icon/pause-icon-dark.png";
        } else {
            this.src = "icon/pause-icon-light.png";
        }
    } else {
        audio.pause();
        if(document.getElementById('checkbox').checked){
            this.src = "icon/play-icon-dark.png";
        } else {
            this.src = "icon/play-icon-light.png";
        }
    }
};

audio.addEventListener('timeupdate', function() {
    var time = (this.currentTime*100)/this.duration;
    if(!isSeeking){
        seekSlider.value = time.toString();
    }
});

seekSlider.addEventListener('mousedown', function() {
    isSeeking = true;
});

seekSlider.addEventListener('mouseup', function() {
    isSeeking = false;
});

seekSlider.addEventListener('click', function() {
    var time = (this.value*audio.duration)/100;
    audio.currentTime = time;
})

seekSlider.addEventListener('mousemove', function() {
    var time = (this.value*audio.duration)/100;
    if(isSeeking){
        audio.currentTime = time;
    }
})

previousButton.onmouseover = function() {
    this.style.height = "17px";
};

previousButton.onmouseout = function() {
    this.style.height = "15px";
};

nextButton.onmouseover = function() {
    this.style.height = "17px";
};

nextButton.onmouseout = function() {
    this.style.height = "15px";
};

slider.oninput = function() {
    audio.volume = this.value/100;
}
const playButton = document.getElementById('play-icon');
const previousButton = document.getElementById('previous-icon');
const nextButton = document.getElementById('next-icon');
const slider = document.getElementById('slider');
const seekSlider = document.getElementById('seek-slider');
const timeupdate = document.getElementById('current-time');

var audio = document.getElementById('audio');

var isSeeking = false;

playButton.onmouseover =  function() {
    this.style.height = "36px";
};

playButton.onmouseout = function() {
    this.style.height = "35px";
};

playButton.onclick = function() {
    if(audio.paused && audio.src != ''){
        audio.play();
        if(checkbox.checked){
            this.src = "./icon/pause-icon-dark.png";
        } else {
            this.src = "./icon/pause-icon-light.png";
        }
    } else if(!(audio.paused) && audio.src != ''){
        audio.pause();
        if(checkbox.checked){
            this.src = "./icon/play-icon-dark.png";
        } else {
            this.src = "./icon/play-icon-light.png";
        }
    }
};

audio.addEventListener('timeupdate', function() {
    var time = (this.currentTime*100)/this.duration;
    if(!isSeeking){
        seekSlider.value = time.toString();
        if(this.currentTime < 60){
            if(this.currentTime < 10){
                timeupdate.innerHTML = "0:0"+Math.floor(this.currentTime.toString());
            } else {
                timeupdate.innerHTML = "0:"+Math.floor(this.currentTime.toString());
            }
        } else {
            if(this.currentTime%60 < 10) {
                timeupdate.innerHTML = Math.floor(this.currentTime/60)+":0"+Math.floor(this.currentTime%60);
            } else {
                timeupdate.innerHTML = Math.floor(this.currentTime/60)+":"+Math.floor(this.currentTime%60);
            }
        }
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

$("#next-icon").click(function() {
    var btn = "next";
    var podcast_title = $(this).parents()[3].children[0].children[1].children[0].innerHTML.replace(/ /g, "_").toLowerCase();
    var podcast_channel = $(this).parents()[3].children[0].children[1].children[1].innerHTML.replace(/ /g, "_").toLowerCase();
    $.ajax({
      url : "./includes/retrievepodcast.inc.php?title="+podcast_title+"&button="+btn+"&channel="+podcast_channel,
      dataType: "html",
      success : function (data) {
        if(data != ""){
          var res = data.split(";");
          $("#audio").attr("src", res[3]);
          $("#thumbnail").attr("src", res[1]);
          $("#podcast-name").html(res[0].replace(/_/g, " ").toUpperCase());
          $("#podcast-channel").html(res[2].toUpperCase());
          $( "#play-icon" ).trigger( "click" );
          updatePodcastStreams(res[0], res[2]);
          setCookie("memaudio","audio="+res[3]+"&timestamp="+00+"&img="+res[1]+"&name="+res[0]+"&channel="+res[2]);
        }
      }
    });
  });

  $("#previous-icon").click(function() {
    var btn = "previous";
    var podcast_title = $(this).parents()[3].children[0].children[1].children[0].innerHTML.replace(/ /g, "_").toLowerCase();
    var podcast_channel = $(this).parents()[3].children[0].children[1].children[1].innerHTML.replace(/ /g, "_").toLowerCase();
    $.ajax({
      url : "./includes/retrievepodcast.inc.php?title="+podcast_title+"&button="+btn+"&channel="+podcast_channel,
      dataType: "html",
      success : function (data) {
        if(data != ""){
          var res = data.split(";");
          $("#audio").attr("src", res[3]);
          $("#thumbnail").attr("src", res[1]);
          $("#podcast-name").html(res[0].replace(/_/g, " ").toUpperCase());
          $("#podcast-channel").html(res[2].toUpperCase());
          $( "#play-icon" ).trigger( "click" );
          updatePodcastStreams(res[0], res[2]);
          setCookie("memaudio","audio="+res[3]+"&timestamp="+00+"&img="+res[1]+"&name="+res[0]+"&channel="+res[2]);
        }
      }
    });
  });
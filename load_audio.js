var audio = document.getElementById('audio');

$(document).ready(function(){
    $(".grid-element-btn").click(function(){
      $("#audio").attr("src", $(this)[0].dataset.file);
      $("#thumbnail").attr("src", $(this)[0].dataset.img);
      $("#podcast-name").html($(this)[0].dataset.title.replace(/_/g, " ").toUpperCase());
      $("#podcast-name").attr("title", $(this)[0].dataset.title.replace(/_/g, " "));
      $("#podcast-channel").html($(this)[0].dataset.chname.toUpperCase().replace(/_/g, " "));
      $("#podcast-channel").attr("title", $(this)[0].dataset.chname.replace(/_/g, " "));
      $("#podcast-playlist-player").html($(this)[0].dataset.playlist.replace(/_/g, " ").toUpperCase());
      $("#podcast-playlist-player").attr("title", $(this)[0].dataset.playlist.replace(/_/g, " "));
      $( "#play-icon-btn" ).trigger( "click" );
      updatePodcastStreams($(this)[0].dataset.title, $(this)[0].dataset.chname);
      setCookie("memaudio","audio="+$(this)[0].dataset.file+"&timestamp="+00+"&img="+$(this)[0].dataset.img+"&name="+$(this)[0].dataset.title+"&channel="+$(this)[0].dataset.chname.toLowerCase()+"&playlist="+$(this)[0].dataset.playlist, 2);
    });

    $(".grid-element-btn-search").click(function(){
      $("#audio").attr("src", $(this)[0].dataset.file);
      $("#thumbnail").attr("src", $(this)[0].dataset.img);
      $("#podcast-name").html($(this)[0].dataset.title.replace(/_/g, " ").toUpperCase());
      $("#podcast-name").attr("title", $(this)[0].dataset.title.replace(/_/g, " "));
      $("#podcast-channel").html($(this)[0].dataset.chname.toUpperCase().replace(/_/g, " "));
      $("#podcast-channel").attr("title", $(this)[0].dataset.chname.replace(/_/g, " "));
      $("#podcast-playlist-player").html($(this)[0].dataset.playlist.replace(/_/g, " ").toUpperCase());
      $("#podcast-playlist-player").attr("title", $(this)[0].dataset.playlist.replace(/_/g, " "));
      $( "#play-icon-btn" ).trigger( "click" );
      updatePodcastStreams($(this)[0].dataset.title, $(this)[0].dataset.chname);
      setCookie("memaudio","audio="+$(this)[0].dataset.file+"&timestamp="+00+"&img="+$(this)[0].dataset.img+"&name="+$(this)[0].dataset.title+"&channel="+$(this)[0].dataset.chname.toLowerCase()+"&playlist="+$(this)[0].dataset.playlist, 2);
    });

    $("#upload-icon-btn").click(function() {
      setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].children[0].innerHTML.toLowerCase()+"&playlist="+$("#podcast-playlist-player")[0].innerHTML.toLowerCase().replace(/ /g, "_"), 2); 
    });
}); 

function getCurrentTime() {
  return document.getElementById('audio').currentTime;
}

audio.oncanplaythrough = function() {
  $("#duration").html(Math.floor(audio.duration/60)+":"+Math.floor(audio.duration%60));
};

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

function setCookieSubstring(name, str, value, exdays) {
  var cookie = getCookie(name);
  var c = cookie.split('&');
  for(i = 0; i < c.length; i++){
    if(c[i].substring(0, str.length) == str){
      var string = c[i];
      c[i] = string.replace(c[i].substring(str.length, c[i].length), value);
    }
  }
  var res = (name+"=").concat(c.join('&'));
  document.cookie = res + ";" + exdays + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function getCookieIndex(cname){
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return i;
    }
  }
  return "";
}

function setAudio(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  var i = getCookieIndex("memaudio");
  var c = ca[i].split('&');
  c[0] = c[0].substring(name.length+1, c[0].length);
  var audio = c[0].substring("audio=".length, c[0].length);
  var timestamp = c[1].substring("timestamp=".length, c[1].length);
  var img = c[2].substring("img=".length, c[2].length);
  var title = c[3].substring("name=".length, c[3].length);
  var channel = c[4].substring("channel=".length, c[4].length);
  var playlist = c[5].substring("playlist=".length, c[5].length);
  $("#audio").attr("src", audio);
  $("#thumbnail").attr("src", img);
  $("#podcast-name").html(title.replace(/_/g , " ").toUpperCase());
  $("#podcast-name").attr("title", title.replace(/_/g, " "));
  $("#podcast-channel").html(channel.replace(/_/g , " ").toUpperCase());
  $("#podcast-channel").attr("title", channel.replace(/_/g, " "));
  $("#podcast-playlist-player").html(playlist.replace(/_/g, " ").toUpperCase());
  $("#podcast-playlist-player").attr("title", playlist.replace(/_/g, " "));
  document.getElementById('audio').currentTime = timestamp;
  if(timestamp > 60){
    $("#current-time").html(Math.floor(audio.timestamp/60)+":"+Math.floor(audio.timestamp%60));
  } else {
    $("#current-time").html("0:"+timestamp);
  }
};

function updatePodcastStreams(title, channel) {
  $.ajax({
    url : "./includes/update-streams.inc.php?title="+title+"&channel="+channel,
  });
};
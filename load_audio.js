$(document).ready(function(){
    $(".grid-element").click(function(){
      $("#audio").attr("src", $(this)[0].id);
      $("#thumbnail").attr("src", $(this).children()[0].src);
      $("#podcast-name").html($(this).children()[1].innerHTML);
      $("#podcast-channel").html($(this).children()[1].id.toUpperCase());
      $( "#play-icon" ).trigger( "click" );
      updatePodcastStreams($(this).children()[1].innerHTML.toLowerCase().replace(/ /g , "_"), $(this).children()[1].id);
      setCookie("memaudio","audio="+$(this)[0].id+"&img="+$(this).children()[0].src+"&name="+$(this).children()[1].innerHTML+"&channel="+$(this).children()[1].id.toUpperCase(), "2");
    });
});

var audio = document.getElementById('audio');
audio.oncanplaythrough = function() {
  console.log("audio is loaded");
  $("#duration").html(Math.floor(audio.duration/60)+":"+Math.floor(audio.duration%60));
};

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  var c = ca[1].split('&');
  c[0] = c[0].substring(name.length+1, c[0].length);
  var audio = c[0].substring("audio=".length, c[0].length);
  var img = c[1].substring("img=".length, c[1].length);
  var title = c[2].substring("name=".length, c[2].length);
  var channel = c[3].substring("channel=".length, c[3].length);
  $("#audio").attr("src", audio);
  $("#thumbnail").attr("src", img);
  $("#podcast-name").html(title);
  $("#podcast-channel").html(channel);
  $("#current-time").html("0:00");
};

function updatePodcastStreams(title, channel) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","./includes/update-streams.inc.php?title="+title+"&channel="+channel,true);
  xmlhttp.send();
};
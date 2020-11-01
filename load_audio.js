var audio = document.getElementById('audio');

$(document).ready(function(){
    $(".grid-element").click(function(){
      $("#audio").attr("src", $(this)[0].id);
      $("#thumbnail").attr("src", $(this).children()[0].getAttribute('src'));
      $("#podcast-name").html($(this).children()[1].innerHTML);
      $("#podcast-channel").html($(this).children()[1].id.toUpperCase());
      $( "#play-icon" ).trigger( "click" );
      updatePodcastStreams($(this).children()[1].innerHTML.toLowerCase().replace(/ /g , "_"), $(this).children()[1].id);
      setCookie("memaudio","audio="+$(this)[0].id+"&timestamp="+00+"&img="+$(this).children()[0].getAttribute('src')+"&name="+$(this).children()[1].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$(this).children()[1].id.toLowerCase(), 2);
    });

    $(".podcast-thumbnail").click(function(){
      $("#audio").attr("src", $(this).attr("id"));
      $("#thumbnail").attr("src", $(this).attr("src"));
      $("#podcast-name").html($(this).parent().find("h4").html());
      $("#podcast-channel").html($(this).parent().find("h4").attr("id").toUpperCase());
      $( "#play-icon" ).trigger( "click" );
      updatePodcastStreams($(this).parent().find("h4").html().toLowerCase().replace(/ /g , "_"), $(this).parent().find("h4").attr("id"));
      setCookie("memaudio","audio="+$(this).attr("id")+"&timestamp="+00+"&img="+ $(this).attr("src")+"&name="+$(this).parent().find("h4").html().toLowerCase().replace(/ /g , "_")+"&channel="+$(this).parent().find("h4").attr("id").toLowerCase(), 2);
    });

    $(".podcast-title").click(function(){
      $("#audio").attr("src", $(this).parent().parent().children()[0].id);
      $("#thumbnail").attr("src", $(this).parent().parent().children()[0].src);
      $("#podcast-name").html($(this).html());
      $("#podcast-channel").html($(this).attr("id").toUpperCase());
      $( "#play-icon" ).trigger( "click" );
      updatePodcastStreams($(this).html().toLowerCase().replace(/ /g , "_"), $(this).attr("id"));
      setCookie("memaudio","audio="+$(this).parent().parent().children()[0].id+"&timestamp="+00+"&img="+ $(this).parent().parent().children()[0].src+"&name="+$(this).html().toLowerCase().replace(/ /g , "_")+"&channel="+$(this).attr("id").toLowerCase(), 2);
    });

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

    $("#upload-button").click(function() {
      setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].innerHTML.toLowerCase(), 2); 
    });

    $("#unsubscribe-button").click(function() {
      setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].innerHTML.toLowerCase(), 2);     
    });

    $("#subscribe-button").click(function() {
      setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].innerHTML.toLowerCase(), 2);
    });

    $("#upload-img-btn").click(function() {
      setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].innerHTML.toLowerCase(), 2);
    });
    
    $("#upload-submit-settings").click(function() {
      setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].innerHTML.toLowerCase(), 2);
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
  $("#audio").attr("src", audio);
  $("#thumbnail").attr("src", img);
  $("#podcast-name").html(title.replace(/_/g , " ").toUpperCase());
  $("#podcast-channel").html(channel.toUpperCase());
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
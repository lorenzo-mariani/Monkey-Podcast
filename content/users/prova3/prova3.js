document.getElementById('channels-btn').addEventListener('click', function() {
  if(document.getElementById('chimg-container') != null){
    document.getElementById('chimg-container').style.display = 'none';
  }
  document.getElementById('info-container').style.display = 'none';
  document.getElementById('streams-container').style.display = 'none';
  document.getElementById('profile-home-container').style.display = 'none';
  document.getElementById('channels-container').style.display = 'inline-grid';
});

document.getElementById('home-btn').addEventListener('click', function() {
  if(document.getElementById('chimg-container') != null){
    document.getElementById('chimg-container').style.display = 'flex';
  }
  document.getElementById('info-container').style.display = 'flex';
  document.getElementById('streams-container').style.display = 'block';
  document.getElementById('profile-home-container').style.display = 'block';
  document.getElementById('channels-container').style.display = 'none';
});

$(".channel-btn").click(function(){
  $("#home-content").hide();
  $.ajax({
      url : "./content/users/"+$(this).children().children()[1].title+"/"+$(this).children().children()[1].title+".php",
      dataType: "html",
      success : function (data) {
          $("#profile-content").html(data);
          $("#profile-content").show();
      }
  });
  changeUrl("Profile", "home.php?view=profile&uid="+$(this).children().children()[1].title);
  $("#content").attr("class", "profile");

});

$(".podcast-settings-btn").click(function() {
  $("#search-content").hide();
  $("#home-content").hide();
  $("#profile-content").hide();
  var title = $(this).parent().parent().parent()[0].children[1].children[0].children[0].innerHTML.toLowerCase().replace(/ /g, "_");
  $.ajax({
    url : "./podcast_settings.php?title="+title,
    dataType: "html",
    success : function (data) {
        $("#podcastmod-content").html(data);
    }
  });
  $("#podcastmod-content").show();
});

$(".podcast-thumbnail-btn").click(function(){
  $("#audio").attr("src", $(this).children()[0].getAttribute("title"));
  $("#thumbnail").attr("src", $(this).children()[0].getAttribute("src"));
  $("#podcast-name").html($(this).parent().find("h4").html());
  $("#podcast-channel").html($(this).parent().find("h4").attr("title").toUpperCase());
  $("#podcast-playlist-player").html($(this)[0].title.replace(/_/g, " ").toUpperCase());
  $( "#play-icon-btn" ).trigger( "click" );
  updatePodcastStreams($(this).parent().find("h4").html().toLowerCase().replace(/ /g , "_"), $(this).parent().find("h4").attr("title"));
  setCookie("memaudio","audio="+$(this).children()[0].getAttribute("title")+"&timestamp="+00+"&img="+ $(this).children()[0].getAttribute("src")+"&name="+$(this).parent().find("h4").html().toLowerCase().replace(/ /g , "_")+"&channel="+$(this).parent().find("h4").attr("title").toLowerCase()+"&playlist="+$(this)[0].title, 2);
});

$(".podcast-title-btn").click(function(){
  $("#audio").attr("src", $(this).parent().parent().children()[0].children[0].title);
  $("#thumbnail").attr("src", $(this).parent().parent().children()[0].children[0].src);
  $("#podcast-name").html($(this).children()[0].innerHTML);
  $("#podcast-channel").html($(this).children()[0].getAttribute("title").toUpperCase());
  $("#podcast-playlist-player").html($(this)[0].title.replace(/_/g, " ").toUpperCase());
  $( "#play-icon-btn" ).trigger( "click" );
  updatePodcastStreams($(this).children()[0].innerHTML.toLowerCase().replace(/ /g , "_"), $(this).children()[0].getAttribute("title"));
  setCookie("memaudio","audio="+$(this).parent().parent().children()[0].children[0].title+"&timestamp="+00+"&img="+ $(this).parent().parent().children()[0].children[0].src+"&name="+$(this).children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$(this).children()[0].getAttribute("title").toLowerCase()+"&playlist="+$(this)[0].title, 2);
});

$("#unsubscribe-button").click(function() {
  setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].children[0].innerHTML.toLowerCase()+"&playlist="+$("#podcast-playlist-player")[0].innerHTML.toLowerCase().replace(/ /g, "_"), 2);     
});

$("#subscribe-button").click(function() {
  setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].children[0].innerHTML.toLowerCase()+"&playlist="+$("#podcast-playlist-player")[0].innerHTML.toLowerCase().replace(/ /g, "_"), 2);
});

$("#upload-img-btn").click(function() {
  setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].children[0].innerHTML.toLowerCase()+"&playlist="+$("#podcast-playlist-player")[0].innerHTML.toLowerCase().replace(/ /g, "_"), 2);
});

$("#upload-submit-settings").click(function() {
  setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].children[0].innerHTML.toLowerCase()+"&playlist="+$("#podcast-playlist-player")[0].innerHTML.toLowerCase().replace(/ /g, "_"), 2);
});
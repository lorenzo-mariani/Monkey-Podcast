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
      url : "./content/users/"+$(this).children().children()[1].children[0].innerHTML.toLowerCase()+"/"+$(this).children().children()[1].children[0].innerHTML.toLowerCase()+".php",
      dataType: "html",
      success : function (data) {
          $("#profile-content").html(data);
          $("#profile-content").show();
      }
  });
  changeUrl("Profile", "home.php?view=profile&uid="+$(this).children().children()[1].children[0].innerHTML.toLowerCase());
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
  changeUrl("Profile", "home.php?view=profile&uid="+$("#username")[0].innerHTML.replace(/ /g, "").replace(/\n/g, "").toLowerCase()+"&podmod=true&settings="+title);
  $("#podcastmod-content").show();
});

$(".podcast-thumbnail-btn").click(function(){
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

$(".podcast-title-btn").click(function(){
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
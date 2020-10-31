document.getElementById('channels').addEventListener('click', function() {
  if(document.getElementById('chimg-container') != null){
    document.getElementById('chimg-container').style.display = 'none';
  }
  document.getElementById('info-container').style.display = 'none';
  document.getElementById('streams-container').style.display = 'none';
  document.getElementById('profile-home-container').style.display = 'none';
  document.getElementById('channels-container').style.display = 'inline-grid';
});

document.getElementById('home').addEventListener('click', function() {
  if(document.getElementById('chimg-container') != null){
    document.getElementById('chimg-container').style.display = 'flex';
  }
  document.getElementById('info-container').style.display = 'flex';
  document.getElementById('streams-container').style.display = 'block';
  document.getElementById('profile-home-container').style.display = 'block';
  document.getElementById('channels-container').style.display = 'none';
});

$(".channel").click(function(){
  $(".home-content").hide();
  $(".content").attr("id", "profile");
});

$(".settings-playlist").click(function() {
  $(".search-content").hide();
  $(".home-content").hide();
  $(".profile-content").hide();
  $.ajax({
    url : "./podcast_settings.php?title="+$(this).parent()[0].children[0].innerHTML.toLowerCase().replace(/ /g, "_"),
    dataType: "html",
    success : function (data) {
        $(".playlist-content").html(data);
    }
  });
  $(".playlist-content").show();
});
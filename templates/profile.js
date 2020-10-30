var playlists = document.getElementsByClassName('playlist-container');

document.getElementById('channels').addEventListener('click', function() {
  document.getElementById('chimg-container').style.display = 'none';
  document.getElementById('info-container').style.display = 'none';
  document.getElementById('streams-container').style.display = 'none';
  for(var i = 0; i < playlists.length; i++){
    playlists[i].style.display = 'none';
  }
  document.getElementById('channels-container').style.display = 'inline-grid';
});

document.getElementById('home').addEventListener('click', function() {
  document.getElementById('chimg-container').style.display = 'flex';
  document.getElementById('info-container').style.display = 'flex';
  document.getElementById('streams-container').style.display = 'block';
  for(var i = 0; i < playlists.length; i++){
    playlists[i].style.display = 'block';
  }
  document.getElementById('channels-container').style.display = 'none';
});

$(".channel").click(function(){
  $(".home-content").hide();
  $.ajax({
      url : "./content/users/"+$(this).children()[1].id+"/"+$(this).children()[1].id+".php",
      dataType: "html",
      success : function (data) {
          $(".profile-content").html(data);
          $(".profile-content").show();
      }
  });
  $(".content").attr("id", "profile");
});
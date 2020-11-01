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

$(".podcast-settings").click(function() {
  $(".search-content").hide();
  $(".home-content").hide();
  $(".profile-content").hide();
  var title = $(this).parent().parent()[0].children[0].innerHTML.toLowerCase().replace(/ /g, "_");
  $.ajax({
    url : "./podcast_settings.php?title="+title,
    dataType: "html",
    success : function (data) {
        $(".podcastmod-content").html(data);
    }
  });
  $(".podcastmod-content").show();
});
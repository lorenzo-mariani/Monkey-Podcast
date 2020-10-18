$(document).ready(function(){
    $(".grid-element").click(function(){
      $("#audio").attr("src", $(this)[0].id);
      $("#thumbnail").attr("src", $(this).children()[0].src);
      $("#podcast-name").html($(this).children()[1].innerHTML);
      $("#podcast-channel").html($(this).children()[1].id.toUpperCase());
      $( "#play-icon" ).trigger( "click" );
    });
});
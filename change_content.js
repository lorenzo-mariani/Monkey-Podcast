$(document).ready(function(){
    $(".logo-container").click(function(){
        $(".profile-content").hide();
        $(".home-content").show();
        $(".content").attr("id", "home");
    });

    $(".channel-name").click(function(){
        $(".home-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });
    
    $("#profile-button").click(function(){
        $(".home-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });

    $("#podcast-channel").click(function() {
        $(".home-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });
});

function getProfileContent(name) {
    $.ajax({
        url : "./content/users/"+name+"/"+name+".php",
        dataType: "html",
        success : function (data) {
            $(".profile-content").html(data);
        }
    });
}
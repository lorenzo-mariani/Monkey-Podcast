$(document).ready(function(){
    $(".logo-container").click(function(){
        $(".profile-content").hide();
        $(".home-content").show();
        $(".content").attr("id", "home");
    });

    $("#channel-name").click(function(){
        $(".home-content").hide();
        $.ajax({
            url : "./content/users/"+$(this)[0].innerHTML.toLowerCase()+"/"+$(this)[0].innerHTML.toLowerCase()+".php",
            dataType: "html",
            success : function (data) {
                $(".profile-content").html(data);
                $(".profile-content").show();
            }
        });
        $(".content").attr("id", "profile");
    });
    
    $("#profile-button").click(function(){
        $(".home-content").hide();
        $.ajax({
            url : "./content/users/"+$(this).text().toLowerCase()+"/"+$(this).text().toLowerCase()+".php",
            dataType: "html",
            success : function (data) {
                $(".profile-content").html(data);
                $(".profile-content").show();
            }
        });
        $(".content").attr("id", "profile");
    });

    $("#podcast-channel").click(function() {
        $(".home-content").hide();
        $.ajax({
            url : "./content/users/"+$(this).text().toLowerCase()+"/"+$(this).text().toLowerCase()+".php",
            dataType: "html",
            success : function (data) {
                $(".profile-content").html(data);
                $(".profile-content").show();
            }
        });
        $(".content").attr("id", "profile");
    });
});
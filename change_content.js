$(document).ready(function(){
    $("#channel-name").click(function(){
        $(".home-content").hide();
        $.ajax({
            url : "./content/users/"+$(this)[0].innerHTML+"/"+$(this)[0].innerHTML+".php",
            dataType: "html",
            success : function (data) {
                $(".profile-content").html(data);
                $(".profile-content").show();
            }
        });
        $(".content").attr("id", "profile");
    });

    $(".logo-container").click(function(){
        $(".profile-content").hide();
        $(".home-content").show();
        $(".content").attr("id", "home");
    });
});
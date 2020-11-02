$(document).ready(function(){
    $("#logo-container").click(function(){
        $(".profile-content").hide();
        $(".help-content").hide();
        $(".podcastmod-content").hide();
        $(".search-content").hide();
        $(".home-content").show();
        $(".content").attr("id", "home");
    });

    $(".channel-name").click(function(){
        $(".home-content").hide();
        $(".help-content").hide();
        $(".podcastmod-content").hide();
        $(".search-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });
    
    $("#profile-button").click(function(){
        $(".home-content").hide();
        $(".help-content").hide();
        $(".podcastmod-content").hide();
        $(".search-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });

    $("#help-button").click(function(){
        $(".home-content").hide();
        $(".podcastmod-content").hide();
        $(".search-content").hide();
        $(".profile-content").hide();
        getHelpContent($(this).text().toLowerCase());
        $(".content").attr("id", "help");
        $(".help-content").show();
    });

    $("#podcast-channel").click(function() {
        $(".search-content").hide();
        $(".help-content").hide();
        $(".podcastmod-content").hide();
        $(".home-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });

    $("#search-icon").click(function() {
        if($("#search-bar").val() != ""){
            $("#search-content").html("");
            $(".help-content").hide();
            $(".podcastmod-content").hide();
            $(".home-content").hide();
            $(".profile-content").hide();
            getSearchContent($("#search-bar").val());
            $(".content").attr("id", "search");
            $(".search-content").show();
        }
    });

    $(".grid-element-users").click(function() {
        $(".search-content").hide();
        $(".help-content").hide();
        $(".podcastmod-content").hide();
        $(".home-content").hide();
        getProfileContent($(this).children()[1].innerHTML.toLowerCase());
        $(".content").attr("id", "profile");
        $(".profile-content").show();
    });

    $(".show-more").click(function() {
        $(".search-content").hide();
        $(".help-content").hide();
        $(".podcastmod-content").hide();
        $(".home-content").hide();
        getProfileContent($(this).attr("id"));
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

function getSearchContent(string){
    $.ajax({
        url : "./includes/search.inc.php?search="+string,
        dataType: "html",
        success : function (data) {
            $(".search-content").html(data);
        }
    });
}

function getHelpContent(){
    $.post("./help.php",
    {
        req : "help"
    },
    function (data) {
        $(".help-content").html(data);
    });
}
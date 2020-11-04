$(document).ready(function(){
    $("#logo-btn").click(function(){
        $("#profile-content").hide();
        $("#help-content").hide();
        $("#podcastmod-content").hide();
        $("#search-content").hide();
        $("#home-content").show();
        $("#content").attr("class", "home");
    });

    $(".channel-name-btn").click(function(){
        $("#home-content").hide();
        $("#help-content").hide();
        $("#podcastmod-content").hide();
        $("#search-content").hide();
        getProfileContent($(this).children()[0].innerHTML.toLowerCase());
        $("#content").attr("class", "profile");
        $("#profile-content").show();
    });
    
    $("#profile-btn").click(function(){
        $("#home-content").hide();
        $("#help-content").hide();
        $("#podcastmod-content").hide();
        $("#search-content").hide();
        getProfileContent($(this).children()[0].innerHTML.toLowerCase());
        $("#content").attr("class", "profile");
        $("#profile-content").show();
    });

    $("#help-btn").click(function(){
        $("#home-content").hide();
        $("#podcastmod-content").hide();
        $("#search-content").hide();
        $("#profile-content").hide();
        getHelpContent($(this).children()[0].innerHTML.toLowerCase());
        $("#content").attr("class", "help");
        $("#help-content").show();
    });

    $("#podcast-channel").click(function() {
        $("#search-content").hide();
        $("#help-content").hide();
        $("#podcastmod-content").hide();
        $("#home-content").hide();
        getProfileContent($(this).text().toLowerCase());
        $("#content").attr("class", "profile");
        $("#profile-content").show();
    });

    $("#search-icon-btn").click(function() {
        if($("#search-bar").val() != ""){
            $("#search-content").html("");
            $("#help-content").hide();
            $("#podcastmod-content").hide();
            $("#home-content").hide();
            $("#profile-content").hide();
            getSearchContent($("#search-bar").val());
            $("#content").attr("class", "search");
            $("#search-content").show();
            $("#search-bar").val("");
        }
    });

    $(".grid-element-users-btn").click(function() {
        $("#search-content").hide();
        $("#help-content").hide();
        $("#podcastmod-content").hide();
        $("#home-content").hide();
        getProfileContent($(this).children().children()[1].innerHTML.toLowerCase());
        $("#content").attr("class", "profile");
        $("#profile-content").show();
    });

    $(".show-more-btn").click(function() {
        $("#search-content").hide();
        $("#help-content").hide();
        $("#podcastmod-content").hide();
        $("#home-content").hide();
        getProfileContent($(this).children()[0].getAttribute("id"));
        $("#content").attr("class", "profile");
        $("#profile-content").show();
    });
});

function getProfileContent(name) {
    $.ajax({
        url : "./content/users/"+name+"/"+name+".php",
        dataType: "html",
        success : function (data) {
            $("#profile-content").html(data);
        }
    });
}

function getSearchContent(string){
    $.ajax({
        url : "./includes/search.inc.php?search="+string,
        dataType: "html",
        success : function (data) {
            $("#search-content").html(data);
        }
    });
}

function getHelpContent(){
    $.post("./help.php",
    {
        req : "help"
    },
    function (data) {
        $("#help-content").html(data);
    });
}
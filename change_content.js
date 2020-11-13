$(document).ready(function(){
    $("#logo-btn").click(function(){
        getHomeContent();
        changeUrl("Home", "home.php");
    });

    $(".channel-name-btn").click(function(){
        getProfileContent($(this).children()[0].innerHTML.toLowerCase());
        changeUrl("Profile", "home.php?view=profile&uid="+$(this).children()[0].innerHTML.toLowerCase());
    });
    
    $("#profile-btn").click(function(){
        getProfileContent($(this).children()[0].innerHTML.toLowerCase());
        changeUrl("Profile", "home.php?view=profile&uid="+$(this).children()[0].innerHTML.toLowerCase());
    });

    $("#help-btn").click(function(){
        getHelpContent($(this).children()[0].innerHTML.toLowerCase());
        changeUrl("Help", "home.php?view=help");
    });

    $("#podcast-channel-btn-player").click(function() {
        getProfileContent($(this)[0].children[0].innerHTML.toLowerCase());
        changeUrl("Profile", "home.php?view=profile&uid="+$(this)[0].children[0].innerHTML.toLowerCase());
    });

    $("#search-icon-btn").click(function() {
        if($("#search-bar").val() != ""){
            changeUrl("Search", "home.php?view=search&search="+$("#search-bar").val());
            getSearchContent($("#search-bar").val());
        }
    });

    $(".grid-element-users-btn").click(function() {
        getProfileContent($(this).children().children()[1].innerHTML.toLowerCase());
        changeUrl("Profile", "home.php?view=profile&uid="+$(this).children().children()[1].innerHTML.toLowerCase());
    });

    $(".show-more-btn").click(function() {
        getProfileContent($(this).children()[0].getAttribute("id"));
        changeUrl("Profile", "home.php?view=profile&uid="+$(this).children()[0].getAttribute("id"));
    });
});

function getProfileContent(name) {
    $("#profile-content").html("");
    $("#home-content").hide();
    $("#help-content").hide();
    $("#podcastmod-content").hide();
    $("#search-content").hide();
    $("#content").attr("class", "profile");
    var string = name.replace(/ /g, "_");
    $.ajax({
        url : "./profile.php?uid="+string,
        dataType: "html",
        success : function (data) {
            $("#profile-content").html(data);
        }
    });
    $("#profile-content").show();
}

function getPodMod(name, title) {
    getProfileContent(name);
    $("#profile-content").hide();
    $.ajax({
        url : "./podcast_settings.php?title="+title,
        dataType: "html",
        success : function (data) {
            $("#podcastmod-content").html(data);
        }
      });
    $("#podcastmod-content").show();
}

function getSearchContent(string){
    $("#search-content").html("");
    $("#help-content").hide();
    $("#podcastmod-content").hide();
    $("#home-content").hide();
    $("#profile-content").hide();
    $("#content").attr("class", "search");
    $.ajax({
        url : "./includes/search.inc.php?search="+string,
        dataType: "html",
        success : function (data) {
            $("#search-content").html(data);
        }
    });
    $("#search-content").show();
    $("#search-bar").val("");
}

function getHomeContent(){
    $("#profile-content").hide();
    $("#help-content").hide();
    $("#podcastmod-content").hide();
    $("#search-content").hide();
    $("#home-content").show();
    $("#content").attr("class", "home");
}

function getHelpContent(){
    $("#home-content").hide();
    $("#podcastmod-content").hide();
    $("#search-content").hide();
    $("#profile-content").hide();
    $("#content").attr("class", "help");
    $.post("./help.php",
    {
        req : "help"
    },
    function (data) {
        $("#help-content").html(data);
    });
    $("#help-content").show();
}

function changeUrl(title, url) {
    var string = url.replace(/ /g, "_");
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: string };
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        alert("Your browser does not support HTML5.");
    }
}
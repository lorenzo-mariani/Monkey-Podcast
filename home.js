var profileIcon = document.getElementById('profile-icon-btn');
var profileMenu = document.getElementById('profile-menu');
var checkbox = document.getElementById('checkbox');
var profileButton = document.getElementById('profile-button');
var searchbar = document.getElementById('search-bar');
var header = document.getElementById('header');
var searchContainer = document.getElementById('search-container');
var iconsContainer = document.getElementById('icons-container');
var displayMore = document.getElementById('display-more-btn');

function displayContainers(){
  searchContainer.style.display = 'flex';
  iconsContainer.style.display = 'flex';
}

function hideContainers(){
  searchContainer.style.display = 'none';
  iconsContainer.style.display = 'none';
}

displayMore.addEventListener('click', function() {
  if((searchContainer.style.display == 'none' && iconsContainer.style.display == 'none') || (searchContainer.style.display == '' && iconsContainer.style.display == '')) {
    displayContainers();
  } else if(searchContainer.style.display == 'flex' && iconsContainer.style.display == 'flex') {
    hideContainers();
  }
}, true);

function showVolume(){
  document.getElementById('slider').style.display = "block";
}

function hideVolume(){
  document.getElementById('slider').style.display = "none";
}

window.addEventListener('resize', function() {
  if(window.innerWidth <= 1250){
    hideContainers();
    displayMore.style.display = 'block';
  } else {
    displayContainers();
    displayMore.style.display = 'none';
  }
  if(window.innerWidth <= 700){
    hideVolume();
    document.getElementById('speaker-icon').addEventListener('mouseover', showVolume);
    document.getElementById('slider').addEventListener('mouseout', hideVolume);
  } else {
    document.getElementById('speaker-icon').removeEventListener('mouseover', showVolume);
    document.getElementById('slider').removeEventListener('mouseout', hideVolume);
    showVolume();
  }
});


profileIcon.addEventListener("click", function () {
  if (profileMenu.style.display == "none") {
    profileMenu.style.display = "grid"
  } else {
    profileMenu.style.display = "none";
  }
});

profileButton.onclick = function () {
  profileMenu.style.display = "none";
}

checkbox.onchange = function () {
  if (checkbox.checked == true) {
    document.getElementById('home-style').href = "./css/homestyledark.css";
    if(document.getElementById("content").getAttribute("id") == "profile") {
      if(document.getElementById('subscribe-button') != null){
        document.getElementById('subscribe-button').setAttribute("value", "dark");
      }
      if(document.getElementById('unsubscribe-button') != null){
        document.getElementById('unsubscribe-button').setAttribute("value", "dark");
      }
      if(document.getElementById('upload-img-btn') != null){
        document.getElementById('upload-img-btn').setAttribute("value", "dark");
      }
    }
    document.getElementById('upload-icon-btn').setAttribute("value", "dark");
    document.getElementById('search-style').href = "./css/searchstyledark.css";
    document.getElementById('profile-style').href = "./css/profilestyledark.css";
    document.getElementById('player-style').href = "./css/playerstyledark.css";
    document.getElementById('play-icon').src = "./icon/play-icon-dark.png";
    document.getElementById('next-icon').src = "./icon/next-icon-dark.png";
    document.getElementById('previous-icon').src = "./icon/next-icon-dark.png";
    document.getElementById('speaker-icon').src = "./icon/speaker-dark.png";
    document.getElementById('logo').src = "./img/logo/MonkeyPodcastLogo_dark.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE ON";
    checkbox.value = "dark";
    if(!audio.paused){
      document.getElementById('play-icon').src = "icon/pause-icon-dark.png";
    }
  } else {
    document.getElementById('home-style').href = "css/homestylelight.css";
    document.getElementById('upload-icon-btn').setAttribute("value", "light");
    if(document.getElementById("content").getAttribute("id") == "profile") {
      if(document.getElementById('subscribe-button') != null){
        document.getElementById('subscribe-button').setAttribute("value", "light");
      }
      if(document.getElementById('unsubscribe-button') != null){
        document.getElementById('unsubscribe-button').setAttribute("value", "light");
      }
      if(document.getElementById('upload-img-btn') != null){
        document.getElementById('upload-img-btn').setAttribute("value", "light");
      }
    }
    document.getElementById('search-style').href = "./css/searchstylelight.css";
    document.getElementById('profile-style').href = "css/profilestylelight.css";
    document.getElementById('player-style').href = "css/playerstylelight.css";
    document.getElementById('play-icon').src = "icon/play-icon-light.png";
    document.getElementById('next-icon').src = "icon/next-icon-light.png";
    document.getElementById('previous-icon').src = "icon/next-icon-light.png";
    document.getElementById('speaker-icon').src = "icon/speaker-light.png";
    document.getElementById('logo').src = "img/logo/MonkeyPodcastLogo_light.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE OFF";
    checkbox.value = "light";
    if(!audio.paused){
      document.getElementById('play-icon').src = "icon/pause-icon-light.png";
    }
  }
}

$('body').click(function(event) {
  if (profileMenu.style.display == "grid" && event.target.id != "profile-icon-btn" && event.target.id != "profile-uid" && event.target.id != "profile-icon") {
    profileMenu.style.display = "none"
  }
})

searchbar.addEventListener('keypress', function (e) {
  if (e.key === 'Enter') {
    document.getElementById('search-icon-btn').click();
  }
});

var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

var grammar = '#JSGF V1.0;'

var recognition = new SpeechRecognition();
var speechRecognitionList = new SpeechGrammarList();
speechRecognitionList.addFromString(grammar, 1);
recognition.grammars = speechRecognitionList;
recognition.lang = 'en-US';
recognition.interimResults = false;

recognition.onresult = function(event) {
    var last = event.results.length - 1;
    var command = event.results[last][0].transcript;
    if(command.includes("search")){
      searchbar.value = command.replace("search ", '');
      document.getElementById('search-icon-btn').click();
    }
};

recognition.onspeechend = function() {
    recognition.stop();
    searchbar.placeholder = 'Search...';
};

recognition.onerror = function(event) {
    console.log("Speach-recognition-error: " + event.error);
}

document.getElementById("speech-icon-btn").addEventListener('click', function(){
  if(confirm("Do you want to activate voice commands?")){
    recognition.start();
    searchbar.value = 'Listening...';
    document.getElementById("speech-check").checked = true;
  }
});

window.onload = function() {
  if(getCookie('memaudio') != '' && getCookie('memaudio').split('&')[0].substring('audio='.length, getCookie('memaudio').split('&')[0].length)  != 'undefined' && (getCookie("PHPSESSID") == getCookie("memaudio").split('&')[6].substring('phpsessid='.length, getCookie("memaudio").split('&')[6].length)) ){
    setAudio('memaudio');
  } else {
    setCookie('memaudio', '', -1);
  }
  if(getCookie('mode') == 'light'){
      document.getElementById('checkbox').click();
  }
  if(window.location.href.includes("view=")){
    var string = window.location.href.substring(window.location.href.indexOf("view="), window.location.href.length);
    var view = string.split('&')[0];
    var viewValue = view.substring("view=".length, view.length);
    var content = string.split('&')[1];
    if(viewValue == "profile"){
      if(string.split('&')[2] != undefined && string.split('&')[2] == "podmod=true"){
        var profile = content.substring("uid=".length, content.length);
        var settings = history.state.Url.split('?')[1].split('&')[3];
        var podcast = settings.substring("settings=".length, settings.length);
        getPodMod(profile, podcast);
      } else {
        var profile = content.substring("uid=".length, content.length);
        getProfileContent(profile);
      }
    } else if(viewValue == "search"){
      var search = content.substring("search=".length, content.length);
      getSearchContent(search);
    } else if(viewValue == "help"){
      getHelpContent();
    }
  }
}

window.onbeforeunload = function() {
  setCookie("memaudio","audio="+$("#audio").attr("src")+"&timestamp="+getCurrentTime()+"&img="+$("#thumbnail").attr("src")+"&name="+$("#details-container").children()[0].innerHTML.toLowerCase().replace(/ /g , "_")+"&channel="+$("#details-container").children()[1].children[0].innerHTML.toLowerCase()+"&playlist="+$("#podcast-playlist-player")[0].innerHTML.toLowerCase().replace(/ /g, "_")+"&phpsessid="+getCookie("PHPSESSID"), 2);
}

$("#history-back-btn").click(function() {
  history.back();
  setTimeout(function() {
    if(window.location.href.includes("view=")){
        if(window.location.href.split('?')[1] != "login=success" || window.location.href.split('?')[1] != "subscribe=success" || window.location.href.split('?')[1] != "unsubscribe=success"){
          var view = window.location.href.split('?')[1].split('&')[0];
          var content = window.location.href.split('?')[1].split('&')[1];
          var viewValue = view.substring("view=".length, view.length);
          if(viewValue == "profile"){
            if(window.location.href.split('?')[1].split('&')[2] != undefined && window.location.href.split('?')[1].split('&')[2] == "podmod=true"){
              document.getElementById("error-container").style.display = "none";
              var profile = content.substring("uid=".length, content.length);
              var settings = window.location.href.split('?')[1].split('&')[3];
              var podcast = settings.substring("settings=".length, settings.length);
              getPodMod(profile, podcast);
            } else {
              var profile = content.substring("uid=".length, content.length);
              getProfileContent(profile);
            }
          } else if(viewValue == "search"){
            var search = content.substring("search=".length, content.length);
            getSearchContent(search);
          } else if(viewValue == "help"){
            getHelpContent();
          }
        } else {
          getHomeContent();
        }
    } else {
      if(window.location.href.includes("home.php")){
        getHomeContent();
      } else if(history.state == null){
        getHomeContent();
      } else if(history.state.Url == "home.php"){
        getHomeContent();
      }
    }
  }, 200);
});

$("#history-forw-btn").click(function() {
  history.forward();
  setTimeout(function() {
    if(window.location.href.includes("view=")){
        if(window.location.href.split('?')[1] != "login=success" || window.location.href.split('?')[1] != "subscribe=success" || window.location.href.split('?')[1] != "unsubscribe=success"){
          var view = window.location.href.split('?')[1].split('&')[0];
          var content = window.location.href.split('?')[1].split('&')[1];
          var viewValue = view.substring("view=".length, view.length);
          if(viewValue == "profile"){
            if(window.location.href.split('?')[1].split('&')[2] != undefined && window.location.href.split('?')[1].split('&')[2] == "podmod=true"){
              document.getElementById("error-container").style.display = "none";
              var profile = content.substring("uid=".length, content.length);
              var settings = window.location.href.split('?')[1].split('&')[3];
              var podcast = settings.substring("settings=".length, settings.length);
              getPodMod(profile, podcast);
            } else {
              var profile = content.substring("uid=".length, content.length);
              getProfileContent(profile);
            }
          } else if(viewValue == "search"){
            var search = content.substring("search=".length, content.length);
            getSearchContent(search);
          } else if(viewValue == "help"){
            getHelpContent();
          }
        } else {
          getHomeContent();
        }
    } else {
      if(window.location.href.includes("home.php")){
        getHomeContent();
      } else if(history.state == null){
        getHomeContent();
      } else if(history.state.Url == "home.php"){
        getHomeContent();
      }
    }
  }, 200);
});
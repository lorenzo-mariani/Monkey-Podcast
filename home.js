const buttonRight = document.getElementsByClassName('right-scroll-arrow');
const buttonLeft = document.getElementsByClassName('left-scroll-arrow');
const profileIcon = document.getElementById('profile-icon');
const profileMenu = document.getElementById('profile-menu');
const checkbox = document.getElementById('checkbox');
const profileButton = document.getElementById('profile-button');

for (var i = 0; i < buttonRight.length; i++) {
  
  buttonRight.item(i).onclick = function () {
    this.parentNode.scrollLeft += 310;
  };
  
  buttonLeft.item(i).onclick = function () {
    this.parentElement.scrollLeft -= 310;
  };

}

profileIcon.onclick = function () {
  if (profileMenu.style.display == "none") {
    profileMenu.style.display = "grid"
  } else {
    profileMenu.style.display = "none";
  }
};

profileButton.onclick = function () {
  profileMenu.style.display = "none";
}

checkbox.onchange = function () {
  if (checkbox.checked == true) {
    document.getElementById('home-style').href = "css/homestyledark.css";
    document.getElementById('profile-style').href = "css/profilestyledark.css";
    document.getElementById('player-style').href = "css/playerstyledark.css";
    document.getElementById('play-icon').src = "icon/play-icon-dark.png";
    document.getElementById('next-icon').src = "icon/next-icon-dark.png";
    document.getElementById('previous-icon').src = "icon/next-icon-dark.png";
    document.getElementById('speaker-icon').src = "icon/speaker-dark.png";
    document.getElementById('logo').src = "img/logo/MonkeyPodcastLogo_dark.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE ON";
    checkbox.value = "dark";
    if(!audio.paused){
      document.getElementById('play-icon').src = "icon/pause-icon-dark.png";
    }
  } else {
    document.getElementById('home-style').href = "css/homestylelight.css";
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
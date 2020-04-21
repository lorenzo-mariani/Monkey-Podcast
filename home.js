const buttonRight = document.getElementsByClassName('right-scroll-arrow');
const buttonLeft = document.getElementsByClassName('left-scroll-arrow');
const profileButton = document.getElementById('profile-icon');
const profileMenu = document.getElementById('profile-menu');
const checkbox = document.getElementById('checkbox');

for (var i = 0; i < buttonRight.length; i++) {
  
  buttonRight.item(i).onclick = function () {
    this.parentNode.scrollLeft += 310;
  };
  
  buttonLeft.item(i).onclick = function () {
    this.parentElement.scrollLeft -= 310;
  };

}

profileButton.onclick = function () {
  if (profileMenu.style.display == "none") {
    profileMenu.style.display = "grid"
  } else {
    profileMenu.style.display = "none";
  }
};

checkbox.onchange = function () {
  if (checkbox.checked == true) {
    document.getElementById('style').href = "/css/homestyledark.css";
    document.getElementById('logo').src = "/img/logo/MonkeyPodcastLogo_dark.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE ON";
  } else {
    document.getElementById('style').href = "/css/homestylelight.css";
    document.getElementById('logo').src = "/img/logo/MonkeyPodcastLogo_light.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE OFF";
  }
}
document.getElementById('channels').addEventListener('click', function() {
    document.querySelector('.info-container').style.display = 'none';
    document.querySelector('.views-container').style.display = 'none';
    document.querySelector('.podcasts-container').style.display = 'none';
    document.quesrySelector('.channels-container').style.display = 'inline-grid';
});

document.getElementById('home').addEventListener('click', function() {
    document.querySelector('.info-container').style.display = 'flex';
    document.querySelector('.views-container').style.display = 'block';
    document.querySelector('.podcasts-container').style.display = 'inline-grid';
    document.quesrySelector('.channels-container').style.display = 'none';
});

const checkbox = document.getElementById('checkbox');

checkbox.onchange = function () {
  if (checkbox.checked == true) {
    document.getElementById('style').href = "css/profilestyledark.css";
    document.getElementById('logo').src = "img/logo/MonkeyPodcastLogo_dark.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE ON";
  } else {
    document.getElementById('style').href = "css/profilestylelight.css";
    document.getElementById('logo').src = "img/logo/MonkeyPodcastLogo_light.png";
    document.getElementById('mode-text').innerHTML = "DARK MODE OFF";
  }
};

const profileButton = document.getElementById('profile-icon');
const profileMenu = document.getElementById('profile-menu');
    
profileButton.onclick = function () {
  if (profileMenu.style.display == "none") {
    profileMenu.style.display = "grid"
  } else {
    profileMenu.style.display = "none";
  }
};
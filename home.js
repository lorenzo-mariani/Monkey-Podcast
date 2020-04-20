const buttonRight = document.getElementsByClassName('right-scroll-arrow');
const buttonLeft = document.getElementsByClassName('left-scroll-arrow');
const profileButton = document.getElementById('profile-icon');
const profileMenu = document.getElementById('profile-menu');

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
const buttonRight = document.getElementsByClassName('right-scroll-arrow');
const buttonLeft = document.getElementsByClassName('left-scroll-arrow');

for (var i = 0; i < buttonRight.length; i++) {
  
  buttonRight.item(i).onclick = function () {
    this.parentNode.scrollLeft += 310;
  };
  
  buttonLeft.item(i).onclick = function () {
    this.parentElement.scrollLeft -= 310;
  };

} 
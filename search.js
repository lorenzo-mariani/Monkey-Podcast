const buttonRight = document.getElementById('right-scroll-arrow');
const buttonLeft = document.getElementById('left-scroll-arrow');

buttonRight.onclick = function () {
    this.parentNode.scrollLeft += 300;
  };
  
  buttonLeft.onclick = function () {
    this.parentElement.scrollLeft -= 300;
  };
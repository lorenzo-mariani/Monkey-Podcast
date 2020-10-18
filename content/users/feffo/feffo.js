document.getElementById('channels').addEventListener('click', function() {
  document.querySelector('.info-container').style.display = 'none';
  document.querySelector('.views-container').style.display = 'none';
  document.querySelector('.podcasts-container').style.display = 'none';
  document.querySelector('.channels-container').style.display = 'inline-grid';
});

document.getElementById('home').addEventListener('click', function() {
  document.querySelector('.info-container').style.display = 'flex';
  document.querySelector('.views-container').style.display = 'block';
  document.querySelector('.podcasts-container').style.display = 'inline-grid';
  document.querySelector('.channels-container').style.display = 'none';
});

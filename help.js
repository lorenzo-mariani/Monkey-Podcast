var explanationContainer = document.getElementById("explanation-container");
var sight = document.getElementById("sight");
var words = document.getElementById("words");
var mouse = document.getElementById("mouse");
var hear = document.getElementById("hear");
var move = document.getElementById("move");
var blind = document.getElementById("blind");
var icon = document.getElementById("focused-icon");
var description = document.getElementById("description");
var arrowTut = document.getElementById("show-tutorial-btn");
var arrowDisab = document.getElementById("show-disability-btn");
var arrowTop = document.getElementById("arrow-top-btn");
var searchPodGif = document.getElementById("podcast-gif-btn");
var searchChanGif = document.getElementById("channel-gif-btn");
var subscribeGif = document.getElementById("subscribe-gif-btn");
var unsubscribeGif = document.getElementById("unsubscribe-gif-btn");
var uploadGif = document.getElementById("upload-gif-btn");
var modifyGif = document.getElementById("modify-gif-btn");
var deletePodGif = document.getElementById("delete-podcast-gif-btn");
var playerGif = document.getElementById("player-gif-btn");
var deleteAccGif = document.getElementById("delete-account-gif-btn");
var closeGif = document.getElementById("close-gif-btn");
var gif = document.getElementById("gif-big");
var gifContainer = document.getElementById("gif-big-container");

closeGif.addEventListener("click", function() {
    if(gifContainer.style.display == "flex"){
        gifContainer.style.display = "none";
    }
});

searchPodGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

searchChanGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

subscribeGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

unsubscribeGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

uploadGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

modifyGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

deletePodGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

playerGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

deleteAccGif.addEventListener("click", function() {
    if(gifContainer.style.display == "none") {
        gifContainer.style.display = "flex";
        gif.setAttribute("src", this.children[0].getAttribute("src"));
    }
});

window.onscroll = function() {
    scrollCheck()
};

function scrollCheck() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    arrowTop.style.display = "block";
  } else {
    arrowTop.style.display = "none";
  }
}

function goToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

arrowTop.addEventListener("click", function() {
    goToTop();
});

arrowTut.addEventListener("click", function() {
    var tutContainer = document.getElementById("tutorial-list-container");
    if(tutContainer.style.display == "none"){
        tutContainer.style.display = "flex";
        tutContainer.scrollIntoView();
        setTimeout(function() {
            window.scrollBy(0, -30);
        }, 300);
    } else if(tutContainer.style.display == "flex"){
        tutContainer.style.display = "none";
    }
});

arrowDisab.addEventListener("click", function() {
    var disabContainer = document.getElementById("buttons-container");
    if(disabContainer.style.display == "none"){
        disabContainer.style.display = "flex";
        disabContainer.scrollIntoView();
    } else if(disabContainer.style.display == "flex"){
        disabContainer.style.display = "none";
    }
});

sight.addEventListener("click", function() {
    if(explanationContainer.style.display == "none"){
        description.innerHTML = "Let's start by making this text bigger. Is it better? Because you can make the entire website bigger! There are two different ways: the fastest is by using your keaboard, and pressing both \"Ctrl\" and \"+\" to zoom in the entire webpage (to make it smaller, instead, you have to press \"Ctrl\" and \"-\"). The other one is by using your browser settings: some browser have a tiny lens, on the right side of the URL bar, others have the zoom tool inside the settings panel.";
        icon.setAttribute("src", "./icon/glasses.png");
        description.style.fontSize = "30px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    } else {
        explanationContainer.style.display = "none";
        description.innerHTML = "Let's start by making this text bigger. Is it better? Because you can make the entire website bigger! There are two different ways: the fastest is by using your keaboard, and pressing both \"Ctrl\" and \"+\" to zoom in the entire webpage (to make it smaller, instead, you have to press \"Ctrl\" and \"-\"). The other one is by using your browser settings: some browser have a tiny lens, on the right side of the URL bar, others have the zoom tool inside the settings panel.";
        icon.setAttribute("src", "./icon/glasses.png");
        description.style.fontSize = "30px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    }
});

words.addEventListener("click", function() {
    if(explanationContainer.style.display == "none"){
        description.innerHTML = "Did you know that basically all of modern browsers have an automatic search ability? All you have to do is highlight with your mouse the text that you want to search, right click on it, and select the voice \"Search with...\". A new tab will be opened in your browser aaaand... That's it! Pretty amazing right?";
        icon.setAttribute("src", "./icon/dictionary.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    } else {
        explanationContainer.style.display = "none";
        description.innerHTML = "Did you know that basically all of modern browsers have an automatic search ability? All you have to do is highlight with your mouse the text that you want to search, right click on it, and select the voice \"Search with...\". A new tab will be opened in your browser aaaand... That's it! Pretty amazing right?";
        icon.setAttribute("src", "./icon/dictionary.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    }
});

mouse.addEventListener("click", function() {
    if(explanationContainer.style.display == "none"){
        description.innerHTML = "There are listeners everywhere... What? No, not spies! I mean listeners that we programmed on this website to make you able to use your TAB and arrow keys, on your keaboard! By typing it, you can scroll down through pages, select different podcasts, stop skip or play them, activate voice commands, and even navigate this menu right above here! Try it!";
        icon.setAttribute("src", "./icon/mouse.png");
        explanationContainer.style.display = "flex";
        description.style.fontSize = "18px";
        explanationContainer.scrollIntoView();
    } else {
        explanationContainer.style.display = "none";
        description.innerHTML = "There are listeners everywhere... What? No, not spies! I mean listeners that we programmed on this website to make you able to use your TAB and arrow keys, on your keaboard! By typing it, you can scroll down through pages, select different podcasts, stop skip or play them, activate voice commands, and even navigate this menu right above here! Try it!";
        icon.setAttribute("src", "./icon/mouse.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    }
});

hear.addEventListener("click", function() {
    if(explanationContainer.style.display == "none"){
        description.innerHTML = "We give all our users the possibility to upload the text of their podcasts, to make you more confortable to understand the words that they're saying. If you click on the tiny letters on the player, you will be prompted with the podcast text, if available. In future, we're planning to develop an AI that writes this text automatically and displays it in form of subtitles!";
        icon.setAttribute("src", "./icon/ear.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    } else {
        explanationContainer.style.display = "none";
        description.innerHTML = "We give all our users the possibility to upload the text of their podcasts, to make you more confortable to understand the words that they're saying. If you click on the tiny letters on the player, you will be prompted with the podcast text, if available. In future, we're planning to develop an AI that writes this text automatically and displays it in form of subtitles!";
        icon.setAttribute("src", "./icon/ear.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    }
});


move.addEventListener("click", function() {
    if(explanationContainer.style.display == "none"){
        description.innerHTML = "Our voice is the most powerful tool ever! If you find phsysically difficult to use your peripherals and computer, you can activate voice commands! If you click on the little \"speech\" icon right next to the searchbar you can activate o deactivate them anytime you want. Example of command: \"search [podcast-name]\"";
        icon.setAttribute("src", "./icon/running.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    } else {
        explanationContainer.style.display = "none";
        description.innerHTML = "Our voice is the most powerful tool ever! If you find phsysically difficult to use your peripherals and computer, you can activate voice commands! If you click on the little \"speech\" icon right next to the searchbar you can activate o deactivate them anytime you want. Example of command: \"search [podcast-name]\"";
        icon.setAttribute("src", "./icon/running.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    }
});

blind.addEventListener("click", function() {
    if(explanationContainer.style.display == "none"){
        description.innerHTML = "If you use a Screen Reader and you are confortable with using your computer's keyboard, we have implemented full TAB and arrow keys support. If you want something 'cooler' instead, you can always activate voice commands! If you click on the little \"speech\" icon right next to the searchbar you can activate o deactivate them anytime you want. Example of command: \"search [podcast-name]\"";
        icon.setAttribute("src", "./icon/eye.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    } else {
        explanationContainer.style.display = "none";
        description.innerHTML = "If you use a Screen Reader and you are confortable with using your computer's keyboard, we have implemented full TAB and arrow keys support. If you want something 'cooler' instead, you can always activate voice commands! If you click on the little \"speech\" icon right next to the searchbar you can activate o deactivate them anytime you want. Example of command: \"search [podcast-name]\"";
        icon.setAttribute("src", "./icon/eye.png");
        description.style.fontSize = "18px";
        explanationContainer.style.display = "flex"
        explanationContainer.scrollIntoView();
    }
});


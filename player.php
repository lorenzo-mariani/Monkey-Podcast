<head>
    <link rel="stylesheet" href="./css/playerstyle.css" type="text/css">
    <link id="player-style" rel="stylesheet" href="./css/playerstyledark.css" type="text/css">
</head>
<div id="player">
    <div id="left-container">
        <img id="thumbnail" src="./img/logo/MonkeyPodcastLogo_vertical.png">
        <div id="details-container">
            <h3 id="podcast-name"></h3>
            <h4 id="podcast-channel" tabindex="10"></h4>
        </div>
    </div>
    <div id="center-container">
        <div id="center-icons-container">
            <h4 id="current-time"></h4>
            <div id="center-icons">
                <button id="previous-icon-btn" tabindex="11">
                    <img id="previous-icon" src=".//icon/next-icon-dark.png" alt="previous-icon">
                </button> 
                <button id="play-icon-btn" tabindex="12">
                    <img id="play-icon" src="./icon/play-icon-dark.png" alt="play-icon">
                </button> 
                <button id="next-icon-btn" tabindex="13">
                    <img id="next-icon" src="./icon/next-icon-dark.png"alt="next-icon">
                </button>
            </div>
            <audio id="audio" type="audio/mp3"></audio>
            <h4 id="duration"></h4>
        </div>
        <div id="seek-container">
            <input type="range" min="1" max="100" value="0" step="0.001" id="seek-slider" tabindex="14">
        </div>
    </div>
    <div id="right-container">
        <img src="./icon/speaker-dark.png" alt="speaker-icon" id="speaker-icon">
        <input type="range" min="1" max="100" value="100" step="1" id="slider" tabindex="15">
    </div>
</div>
<script src="./player.js"></script>

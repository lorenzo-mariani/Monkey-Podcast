<head>
    <link rel="stylesheet" href="/Monkey-Podcast/css/playerstyle.css" type="text/css">
    <link id="player-style" rel="stylesheet" href="/Monkey-Podcast/css/playerstyledark.css" type="text/css">
</head>
<div id="player">
    <div id="left-container">
        <img id="thumbnail" src="/Monkey-Podcast/audio/Slipknot-All Hope Is Gone/Front cover.jpg">
        <div id="details-container">
            <h3 id="podcast-name">
            <?php
                function runMyFunction() {
                    echo 'PROVA';
                }
                
                if (isset($_GET['name'])) {
                    runMyFunction();
                }
            ?>
            </h3>
            <h4 id="podcast-channel">Slipknot</h4>
        </div>
    </div>
    <div id="center-container">
        <div id="center-icons-container">
            <img id="previous-icon" src="/Monkey-Podcast/icon/next-icon-dark.png" alt="previous-icon">
            <img id="play-icon" src="/Monkey-Podcast/icon/play-icon-dark.png" alt="play-icon">
            <img id="next-icon" src="/Monkey-Podcast/icon/next-icon-dark.png"alt="next-icon">
            <audio id="audio" src="/Monkey-Podcast/audio\Slipknot-All Hope Is Gone\Gehenna.mp3" type="audio/mp3"></audio>
        </div>
        <div id="seek-container">
            <input type="range" min="1" max="100" value="0" step="0.001" id="seek-slider">
        </div>
    </div>
    <div id="right-container">
        <img src="/Monkey-Podcast/icon/speaker-light.png" alt="speaker-icon" id="speaker-icon">
        <input type="range" min="1" max="100" value="100" step="1" id="slider">
    </div>
</div>
<script src="player.js"></script>
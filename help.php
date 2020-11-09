<script src="./help.js"></script>

<?php

    if(isset($_POST['req']) && $_POST['req'] == "help"){
        echo "<div id=\"help-container\">
        <h1 id=\"title\">Need some help? Here are some tips and tricks to use Monkey Podcasts!</h1>
        <div id=\"help-content-container\">
            <div id=\"tutorial-container\">
            <h2 id=\"tutorial\">Learn how to use our website at its full potential!</h2>
            <h3 id=\"tutorial-subtitle\">Listed below are some useful GIFs that will make your experience flawlessly smooth.</h3>
            <div id=\"tutorial-list-container\">
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">SEARCH A PODCAST</h4>
                    <p class=\"tutorial-subtitle\">You can search for anything you like or that you wish to listen to, anytime!
                    Results of the query will be display under the \"PODCASTS\" section that will appear after the search submission.
                    But, be careful: this search bar is under development, and it does no implement any AI; because of that, it searches for anything you type in its entirety. 
                    Example: if i type \"charles dickens\", and click search, it will show podcasts like \"charles dickens audiobook\",
                    or \"live like charles dickens\", or again \"first charles dickens audiobook\" (and so on...), which contain the phrase \"charles dickens\", typed inside the searchbar, entirely.
                    So you have to keep one thing in mind: for more results type less words!
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">SEARCH A CHANNEL</h4>
                    <p class=\"tutorial-subtitle\">The search principles extend to not only podcasts, but also channels!
                    Instead, results of the query will be display under the \"USERS\" section that will appear after the search submission.
                    But, be careful: this search bar is under development, and it does no implement any AI; because of that, it searches for anything you type in its entirety. 
                    Example: if i type \"andrew huang\", and click search, it will show users like \"andrew huang\",
                    or \"andrew huang second channel\", or again \"main andrew huang channel\" (and so on...), which contain the phrase \"andrew huang\", typed inside the searchbar, entirely.
                    So you have to keep one thing in mind: for more results type less words!
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">SUBSCRIBE TO YOUR FAVORITE CHANNELS</h4>
                    <p class=\"tutorial-subtitle\">If you click on a user/channel button, a new page will be displayed, containing informations and podcasts that have been uploaded.
                    On the right side of the screen you will immediately see a big red button, with the label \"SUBSCRIBE\" written on it.
                    If you click it, you will subscribe to that channel, and automatically display it inside your home page and \"channels\" tab of your own profile page.
                    So, by subscribing to channels, you don't have to visit their pages everytime you want to listen to the podcasts they've uploaded, you have all their playlist inside your home page!
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">UNSUBSCRIBE FROM THE CHANNELS YOU'RE SUBSCRIBED TO</h4>
                    <p class=\"tutorial-subtitle\">The process of unsubscribing is the exact same as subscribing:
                    When the page of a channel is displayed, and you're already subscribed to it, a new button with the label \"UNSUBSCRIBE\" written on it will appear, substituting the \"SUBSCRIBE\" that was there before.
                    By clicking it, you will automatically unsubscribe from that channel, and remove it from your home page ora \"channels\" tab, inside your profile.
                    You can always subscribe again, whenever you want!
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">UPLOAD A PODCAST!</h4>
                    <p class=\"tutorial-subtitle\">Yes! The fun part! If you look on the top-right corner of the website page, you will see a tiny microphone icon. That is the upload button for your podcasts!
                    If you click on it a new page will be opened, containing a form:
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">MODIFY A PODCAST YOU'VE UPLOADED</h4>
                    <p class=\"tutorial-subtitle\">
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">DELETE A PODCAST YOU'VE UPLOADED</h4>
                    <p class=\"tutorial-subtitle\">
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">FIND OUT HOW THE PLAYER WORKS</h4>
                    <p class=\"tutorial-subtitle\">
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
                <div class=\"tut-description\">
                    <h4 class=\"tutorial-title\">DELETE YOUR ACCOUNT</h4>
                    <p class=\"tutorial-subtitle\">
                </div>
                <div class=\"gif-container\">
                    <img class=\"tut-gif\" src=\"./img/background/background_image.jpg\">
                </div>
            </div>
        </div>
            <div id=\"disabilty-container\">
                <h2 id=\"disability\">Do you have any kind of disability?</h2>
                <h3 id=\"disability-subtitle\">We're here to give you the best experience!</h3>
                <div id=\"buttons-container\">
                    <button class=\"button\" id=\"sight\">
                        <div class=\"issue-container\">
                            <div class=\"icons-help-container\">
                                <img class=\"icons-help\" src=\"./icon/glasses.png\">
                            </div>
                            <p class=\"issue\">I can't see very well.
                        </div>
                    </button>
                    <button class=\"button\" id=\"words\">
                        <div class=\"issue-container\">
                            <div class=\"icons-help-container\">
                                <img class=\"icons-help\" src=\"./icon/dictionary.png\">
                            </div>
                            <p class=\"issue\">Sometimes I find words difficult to understand.
                        </div>
                    </button>
                    <button class=\"button\" id=\"mouse\">
                        <div class=\"issue-container\">
                            <div class=\"icons-help-container\">
                                <img class=\"icons-help\" src=\"./icon/mouse.png\">
                            </div>
                            <p class=\"issue\">It's hard to use the mouse or trackpad.
                        </div>
                    </button>
                    <button class=\"button\" id=\"hear\">
                        <div class=\"issue-container\">
                            <div class=\"icons-help-container\">
                                <img class=\"icons-help\" src=\"./icon/ear.png\">
                            </div>
                            <p class=\"issue\">Hearing is not my strongest.
                        </div>
                    </button>
                    <button class=\"button\" id=\"move\">
                        <div class=\"issue-container\">
                            <div class=\"icons-help-container\">
                                <img class=\"icons-help\" src=\"./icon/running.png\">
                            </div>
                            <p class=\"issue\">I'm unable to move.
                        </div>
                    </button>
                    <button class=\"button\" id=\"blind\">
                        <div class=\"issue-container\">
                            <div class=\"icons-help-container\">
                                <img class=\"icons-help\" src=\"./icon/eye.png\">
                            </div>
                            <p class=\"issue\">I'm blind.
                        </div>
                    </button>
                </div>
                <div id=\"explanation-container\" style=\"display: none;\">
                    <div id=\"icon-container-focus\">
                        <img id=\"focused-icon\">
                    </div>
                    <div id=\"description\">
                    </div>
                </div>
            </div>
        </div>";
    }

?>
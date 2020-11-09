<script src="./help.js"></script>

<?php

    if(isset($_POST['req']) && $_POST['req'] == "help"){
        echo "<div id=\"help-container\">
        <button id=\"arrow-top-btn\" style=\"display: none;\">
            <img id=\"arrow-top\" src=\"./icon/arrow.png\">
        </button>
        <h1 id=\"title\">Need some help? Here are some tips and tricks to use Monkey Podcasts!</h1>
        <div id=\"help-content-container\">
            <div id=\"tutorial-container\">
                <div class=\"title-container\">
                    <h2 class=\"tutorial-title\">Learn how to use our website at its full potential!</h2>
                    <button id=\"show-tutorial-btn\">
                        <img class=\"show-tutorial-arrow\" src=\"./icon/arrow.png\" alt=\"show-tutorial\">
                    </button>
                </div>
                <h3 class=\"tutorial-subtitle\">Below are some useful GIFs that will make your experience flawlessly smooth.</h3>
                <div id=\"tutorial-list-container\" style=\"display: none\">
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">SEARCH A PODCAST</h4>
                        <p class=\"tutorial-subtitle\">You can search for anything you like or that you wish to listen to, anytime!
                        Results of the query will be display under the \"PODCASTS\" section that will appear after the search submission.
                        But, be careful: this search bar is under development, and it does no implement any AI; because of that, it searches for anything you type in its entirety. 
                        Example: if i type \"charles dickens\", and click search, it will show podcasts like \"charles dickens audiobook\",
                        or \"live like charles dickens\", or again \"first charles dickens audiobook\" (and so on...), which contain the phrase \"charles dickens\", typed inside the searchbar, entirely.
                        So you have to keep one thing in mind: for more results type less words!
                    </div>
                    <div class=\"gif-container\">\
                        <button id=\"podcast-gif-btn\">
                            <img class=\"tut-gif\" src=\"./img/gifs/1.gif\">
                        </button>
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
                        <button id=\"channel-gif-btn\">
                            <img class=\"tut-gif\" src=\"./img/gifs/2.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">SUBSCRIBE TO YOUR FAVORITE CHANNELS</h4>
                        <p class=\"tutorial-subtitle\">If you click on a user/channel button, a new page will be displayed, containing informations and podcasts that have been uploaded.
                        On the right side of the screen you will immediately see a big red button, with the label \"SUBSCRIBE\" written on it.
                        If you click it, you will subscribe to that channel, and automatically display it inside your home page and \"channels\" tab of your own profile page.
                        So, by subscribing to channels, you don't have to visit their pages everytime you want to listen to the podcasts they've uploaded, you have all their playlist inside your home page!
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"subscribe-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/1.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">UNSUBSCRIBE FROM THE CHANNELS YOU'RE SUBSCRIBED TO</h4>
                        <p class=\"tutorial-subtitle\">The process of unsubscribing is the exact same as subscribing:
                        When the page of a channel is displayed, and you're already subscribed to it, a new button with the label \"UNSUBSCRIBE\" written on it will appear, substituting the \"SUBSCRIBE\" that was there before.
                        By clicking it, you will automatically unsubscribe from that channel, and remove it from your home page ora \"channels\" tab, inside your profile.
                        You can always subscribe again, whenever you want!
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"unsubscribe-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/2.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">UPLOAD A PODCAST!</h4>
                        <p class=\"tutorial-subtitle\">Yes! The fun part! If you look on the top-right corner of the website page, you will see a tiny microphone icon. That is the upload button for your podcasts!
                        If you click on it a new page will be opened, containing a form.
                        Right below the Monkey Podcast logo there are two buttons: the first one lets you choose ad audio file, which has to be in a \".mp3\" format;
                        the second one lets you choose an image which will be the thumbnail for the podcast you're uploading.
                        There is a limitation on the size on every image and audio file uploaded, which is 100MB. 
                        Next, we have two input fields: title and playlist, respectively; on the title input there are some rescritions, in fact you CANNOT type any of these symbols \"\/:*?\"<>|\".
                        Instead, the playlist field doesn't have any restriction.
                        Below the playlist input field there is a \"select genre\" menu: if you click on it, a list of genres will be displayed, and you can select the correct one for your podcast.
                        Last but not least, there's the upload button which, as the name suggests, lets you upload the podcast with the details that you've inserted above. A confirm will be asked before submission.
                        IMPORTANT: all the fields mentioned above are mandatory.
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"upload-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/1.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">MODIFY A PODCAST YOU'VE UPLOADED</h4>
                        <p class=\"tutorial-subtitle\">You can do it whenever you want, and as many times as you desire!
                        You just have to go to your profile page, and click on the little \"gear\" icon that you see right below the podcast that you want to modify.
                        A new page will be displayed: on the left side there are the actual details of the podcast that you are trying to modify, and on the right side all the fields that you want to change.
                        THEY ARE NOT MANDATORY, so you can modify even just one of them.
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"modify-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/2.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">DELETE A PODCAST YOU'VE UPLOADED</h4>
                        <p class=\"tutorial-subtitle\">If you want to delete a podcast PERMANENTLY, you have to go to your profile page, find the podcast that you want to delete
                        and click on the red \"trash\" icon right below it. You will be asked for a confirm.
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"delete-podcast-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/1.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">FIND OUT HOW THE PLAYER WORKS</h4>
                        <p class=\"tutorial-subtitle\">We can divide it in three main sections: left, center and right.
                        Inside the left one you have all the informations about the podcast that you are listening to right now which are the title, the channel (that you can click on to go to that channel's page) and the playlist (from top to bottom).
                        The center one, instead, contains the play/pause button, the previous and next buttons (the little arrows pointing in opposite directions), the seek slider (which lets you \"seek through\" the current podcast).
                        On the right side you have only the volume level slider.
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"player-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/2.gif\">
                        </button>
                    </div>
                    <div class=\"tut-description\">
                        <h4 class=\"tutorial-title\">DELETE YOUR ACCOUNT</h4>
                        <p class=\"tutorial-subtitle\">We're sad to hear that. But you can always sign back in, if you want! We will be more than happy to welcome you back!
                        Anyway, you can delete your account by going to your profile page, and click on the little red \"trash\" right next to the sub counter and the label \"DELETE ACCOUNT\".
                        You will be asked for a confirm.
                    </div>
                    <div class=\"gif-container\">
                        <button id=\"delete-account-gif-btn\">
                        <img class=\"tut-gif\" src=\"./img/gifs/1.gif\">
                        </button>
                    </div>
                </div>
            </div>

            <div id=\"gif-big-container\" style=\"display: none;\">
                <button id=\"close-gif-btn\">X</button>
                <img id=\"gif-big\" alt=\"gif-big\">
            </div>

            <div id=\"disability-container\">
                <div class=\"title-container\">
                    <h2 class=\"tutorial-title\">Do you have any kind of disability?</h2>
                    <button id=\"show-disability-btn\">
                        <img class=\"show-tutorial-arrow\" src=\"./icon/arrow.png\" alt=\"show-tutorial\">
                    </button>
                </div>
                <h3 class=\"tutorial-subtitle\">We're here to give you the best experience!</h3>
                <div id=\"buttons-container\" style=\"display: none;\">
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
                <div id=\"explanation-container\">
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
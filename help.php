<script src="./help.js"></script>

<?php

    if(isset($_POST['req']) && $_POST['req'] == "help"){
        echo "<div id=\"help-container\">
        <h1 id=\"title\">Need some help? Here are some tips and tricks to use Monkey Podcasts!</h1>
        <div id=\"help-content-container\">
            <div id=\"tutorial\">

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
            </div>
        </div>";
    }

?>
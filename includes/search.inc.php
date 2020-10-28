<?php

    if(isset($_GET['search'])){

        require 'dbh.inc.php';
        
        $search_text = str_replace(" ", "_", $_GET['search']);

        $query_users = "SELECT * FROM channels WHERE channelName LIKE CONCAT('%', ?, '%')";
        $query_podcasts = "SELECT * from podcasts WHERE userUID LIKE CONCAT('%', ?, '%') OR podcastTitle LIKE CONCAT('%', ?, '%') OR genre LIKE CONCAT('%', ?, '%') OR playlist LIKE CONCAT('%', ?, '%')";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query_podcasts)) {
            header("Location: ./home.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $search_text, $search_text, $search_text, $search_text);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $stmt->bind_result($genre, $title, $img, $channel_name, $streams, $file, $playlist);
            if($stmt->num_rows > 0){
                echo "
                <div id=\"podcasts-container\" style=\"height: 200px;\">
                    <h4 id=\"podcasts\" style=\"position: relative;
                    font-family: caviar_dreamsbold;
                    color: whitesmoke;
                    font-size: 80px;
                    text-align: center;
                    top: 50%;
                    transform: translate(0, -50%);
                    background: rgba(0, 0, 0, 0.521);\">PODCASTS</h4>
                </div>
                    <div class=\"scrollchannel\">
                        <img class=\"left-scroll-arrow\" src=\"./icon/arrow.png\" alt=\"Left Arrow\">
                        <img class=\"right-scroll-arrow\" src=\"./icon/arrow.png\" alt=\"Right Arrow\">
                    ";
                while($stmt->fetch()){
                    echo 
                    "   <div class=\"grid-element\" id=".$file.">
                        <img src=".$img." alt=\"Sample1\">
                        <h4 id=".$channel_name.">".strtoupper(str_replace('_', ' ', $title))."</h4>
                        <p>".$streams."</p></div>";
                }
                echo "</div>";
            }
            if (!mysqli_stmt_prepare($stmt, $query_users)) {
                header("Location: ./home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $search_text);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $stmt->bind_result($name, $views, $ch_img);
                if($stmt->num_rows > 0){
                    echo "
                    <div id=\"users-container\" style=\"height: 100px;\">
                        <h4 id=\"users\" style=\"position: relative;
                        font-family: caviar_dreamsbold;
                        color: whitesmoke;
                        font-size: 50px;
                        text-align: center;
                        top: 50%;
                        transform: translate(0, -50%);
                        background: rgba(0, 0, 0, 0.521);\">USERS</h4>
                    </div>
                        <div class=\"scrollchannel\">
                            <img class=\"left-scroll-arrow\" src=\"./icon/arrow.png\" alt=\"Left Arrow\">
                            <img class=\"right-scroll-arrow\" src=\"./icon/arrow.png\" alt=\"Right Arrow\">
                        ";
                    while($stmt->fetch()){
                        echo 
                        "   <div class=\"grid-element-users\">
                            <img src=".$ch_img." alt=\"Sample1\">
                            <h4 id=\"name\">".strtoupper($name)."</h4>
                            <p>".$views."</p>
                            </div>";
                    }
                    echo "</div>";
                } else {
                    echo "<div id=\"default-search\">
                        <h1 id=\"empty-search\">Sorry, no results found.</h1>
                    </div>";
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }

?>

<script src="../load_audio.js"></script>
<script src="../change_content.js"></script>
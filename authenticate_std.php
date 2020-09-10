<?php
    session_start();

    if(!(isset($_SESSION["username"]) && isset($_SESSION["userlevel"]))) { exit_with_hound(); }

    function exit_with_hound()
    {
        echo "<img src='../media/hell_hound.jpg' alt='guard_dog_picture' id='unwelcome_hound' width='80%' />";
        session_unset();    
        exit();
    }
?>
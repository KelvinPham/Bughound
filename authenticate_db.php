<?php
    require "authenticate_std.php";

    if ($_SESSION["userlevel"] < 3) { exit_with_hound(); } 
?>
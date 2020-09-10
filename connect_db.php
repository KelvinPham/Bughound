<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'bughound');

    // Connects to bughound database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE); 
    
    if(!$conn) {
        die("Failed to connect to server". mysqli_connect_error());
    }
?>
<?php
    require "../authenticate_db.php";
    require_once "../connect_db.php";
    $query = "SELECT * FROM areas";
    // Column headers
    $txt =  "+---------+---------+----------------------------------+\n";
    $txt .= "| area_id | prog_id | area                             |\n";
    $txt .= "+---------+---------+----------------------------------+\n";

    $asciifile = fopen("areasASCII.txt", "w") or die("Unable to open file!");
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_row($result)) {
        $txt .= sprintf("|%-9d|%-9d|%-34s|\n",$row[0], $row[1], $row[2]);        
    }
    $txt .= "+---------+---------+----------------------------------+\n";
    fwrite($asciifile, strval($txt));
    fclose($asciifile);
?>
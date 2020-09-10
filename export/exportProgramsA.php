<?php
    require "../authenticate_db.php";
    require_once "../connect_db.php";
    
    $query = "SELECT * FROM programs";
    // Column headers
    $txt =  "+---------+--------------------------------+--------------------------------+--------------------------------+\n";
    $txt .= "| prog_id | program                        | program_release                | program_version                |\n";
    $txt .= "+---------+--------------------------------+--------------------------------+--------------------------------+\n";

    $asciifile = fopen("programsASCII.txt", "w") or die("Unable to open file!");
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_row($result)) {
        $txt .= sprintf("|%-9d|%-32s|%-32s|%-32s|\n",$row[0], $row[1], $row[2], $row[3]);        
    }
    $txt .= "+---------+--------------------------------+--------------------------------+--------------------------------+\n";
    fwrite($asciifile, strval($txt));
    fclose($asciifile);
?>
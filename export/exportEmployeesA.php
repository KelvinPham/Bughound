<?php
    require "../authenticate_db.php";
?>

<?php
    require_once "../connect_db.php";
    $query = "SELECT * FROM employees";
    // Column headers
    $txt =  "+--------+--------------------------------+--------------------------------+--------------------------------+-----------+\n";
    $txt .= "| emp_id | name                           | username                       | password                       | userlevel |\n";
    $txt .= "+--------+--------------------------------+--------------------------------+--------------------------------+-----------+\n";

    $asciifile = fopen("employeesASCII.txt", "w") or die("Unable to open file!");
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_row($result)) {
        $txt .= sprintf("|%-8d|%-32s|%-32s|%-32s|%-11d|\n",$row[0], $row[1], $row[2], $row[3], $row[4]);        
    }
    $txt .= "+--------+--------------------------------+--------------------------------+--------------------------------+-----------+\n";
    fwrite($asciifile, strval($txt));
    fclose($asciifile);
?>
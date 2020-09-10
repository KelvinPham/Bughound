<?php
    require "../authenticate_db.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Areas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/areas.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Areas</h3>
        <?php
            require_once "../connect_db.php";

            $query = "SELECT * FROM programs";
            $result = mysqli_query($conn, $query);
            // No data in table
            if(mysqli_num_rows($result) == 0) {
                echo "<h3>No matching records found. Please add a program first. </h3>\n";
            }
            else {
                // Header of the table
                echo "<table class=\"display\"><tr><th>ID</th><th>Program Name</th><th>Release</th><th>Version</th></tr>";
                while($row = mysqli_fetch_row($result)) {
                    printf("<tr><td><form action=\"addArea.php\" method=\"get\">
                    <input type=\"submit\" name=\"prog_id\" value=%d></form></td><td>%s</td><td>%d</td><td>%d</td</tr>", $row[0], $row[1], $row[2], $row[3]);
		        }
                echo "</table>";
            }
            mysqli_close($conn);
        ?>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
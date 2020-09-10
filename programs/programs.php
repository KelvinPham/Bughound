<?php
    require "../authenticate_db.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Employees</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/programs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Programs</h3>
        <?php
            require_once "../connect_db.php";
            $query = "SELECT * FROM programs";
            $result = mysqli_query($conn, $query);
            // No data in table
            if(mysqli_num_rows($result) == 0) {
                echo "<h3>No matching records found.</h3>\n";
            }
            else {
                // Header of the table
                echo "<table class=\"display\"><tr><th>ID</th><th>Program</th><th>Program Release</th><th>Program Version</th><th>Update</th><th>Delete</th>";
                while($row = mysqli_fetch_row($result)) {
                    // Prints out each program's information
                    printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%d</td>", $row[0], $row[1], $row[2], $row[3]);
                    // Update button passing the prog_id to the update form
                    echo "<td><form action=\"updateProgram.php\" method=\"post\">
                    <input type=\"hidden\" name=\"prog_id\" value=$row[0]/>
                    <input type=\"submit\" name=\"submit\" value=\"Update\"/>
                    </form></td>";
                    // Delete button passing the prog_id
                    echo "<td><form name=\"deleteProgram\" action=\"deleteProgram.php\" method=\"post\">
                    <input type=\"hidden\" name=\"prog_id\" value=$row[0]/>
                    <input type=\"submit\" name=\"submit\" value=\"Delete\"/>
                    </form></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($conn);
        ?>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
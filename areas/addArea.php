<?php
    require "../authenticate_db.php";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../connect_db.php";
        
        $prog_id = $_POST['prog_id'];
        $area = $_POST['area'];
        // Add areas to area table
        if(!isset($_POST['area_id'])) {
            $query = "INSERT INTO areas (area_id, prog_id, area) VALUES (NULL,'".$prog_id."','".$area."')";
            mysqli_query($conn, $query);
        }
        // Updates area
        else {
            if($area != "") {
                $area_id = $_POST['area_id'];
                $query = "UPDATE areas SET area = '".$area."' WHERE area_id = '".$area_id."'";
                mysqli_query($conn, $query);
            }
            else {
                echo "<script>alert(\"Area must contain characters\")</script>";
            }
        }
        mysqli_close($conn);
        header(str_replace('/',"",'Location: addArea.php?prog_id='.$prog_id));
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Areas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/areas.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php
            require_once "../connect_db.php";
            // Displays Program, Release Number and Version Number
            $query = "SELECT program, program_release, program_version FROM programs WHERE prog_id=".$_GET['prog_id'];
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            printf("<h3>Add Areas to %s %d - %d</h3>", $row[0], $row[1], $row[2]);

            // Displays areas for the passed program
            $query = "SELECT * FROM areas WHERE prog_id=".$_GET['prog_id'];
            $result = mysqli_query($conn, $query);

            // Header of the table
            echo "<table class=\"display\"><tr><th>Area ID</th><th>Program ID</th><th>Area</th><th>Add/Update</th><th>Delete</th>";
            while($row = mysqli_fetch_row($result)) {
                // Prints out each program's information
                printf("<tr><td>%d</td><td>%d</td>
                <form name=\"updateArea\" action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">
                <td><input id=\"updateAreaInput$row[0]\" name=\"area\" value=\"%s\"></td>", $row[0], $row[1], $row[2]);
                // Update button passing the prog_id to the update form
                echo "<td>
                <input type=\"hidden\" name=\"area_id\" value=$row[0]/>
                <input type=\"hidden\" name=\"prog_id\" value=$row[1]/>
                <input type=\"submit\" name=\"submit\" value=\"Update\"/>
                </form></td>";
                // Delete button passing the prog_id
                echo "<td><form name=\"deleteArea\" action=\"deleteArea.php\" method=\"post\">
                <input type=\"hidden\" name=\"area_id\" value=$row[0]/>
                <input type=\"submit\" name=\"submit\" value=\"Delete\"/>
                </form></td>";
                echo "</tr>";
            }
            echo "<tr><form name=\"addArea\" action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">
            <td>Add</td>
            <td><input type=\"hidden\" name=\"prog_id\" value=".$_GET['prog_id']."/>".$_GET['prog_id']."</td>
            <td><input id=\"addAreaInput\" name=\"area\" type=\"text\"></td>
            <td><input type=\"submit\" name=\"submit\" value=\"Add\"/></form></td>";
            echo "</table>";
            mysqli_close($conn);
        ?>
        <br/>
        <button id="eButton">Return</button>
    </body>
</html>
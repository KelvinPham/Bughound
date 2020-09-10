<?php
    require "../authenticate_db.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Employees</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/employees.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Employees</h3>
        <?php
            require_once "../connect_db.php";
            $query = "SELECT * FROM employees";
            $result = mysqli_query($conn, $query);
            // No data in table
            if(mysqli_num_rows($result) == 0) {
                echo "<h3>No matching records found.</h3>\n";
            }
            else {
                // Header of the table
                echo "<table class=\"display\"><tr><th>ID</th><th>Name</th><th>Username</th><th>Password</th><th>User Level</th><th>Update</th><th>Delete</th>";
                while($row = mysqli_fetch_row($result)) {
                    // Prints out each employee's information
                    printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td>", $row[0], $row[1], $row[2], $row[3], $row[4]);
                    // Update button passing the emp_id to the update form
                    echo "<td><form action=\"updateEmployee.php\" method=\"post\">
                    <input type=\"hidden\" name=\"emp_id\" value=$row[0]/>
                    <input type=\"submit\" name=\"submit\" value=\"Update\"/>
                    </form></td>";
                    // Delete button passing the emp_id
                    echo "<td><form name=\"deleteEmployee\" action=\"deleteEmployee.php\" method=\"post\">
                    <input type=\"hidden\" name=\"emp_id\" value=$row[0]/>
                    <input type=\"hidden\" name=\"name\" value=\"$row[1]\"/>
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
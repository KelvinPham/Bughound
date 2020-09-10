<?php
    require "../authenticate_std.php";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../connect_db.php";
        // Search Parameters
        $searchParams = "";
        if($_POST['programs'] != '*') {
            $searchParams .= "prog_id = '".$_POST['programs']."' AND ";
        }
        if($_POST['rType'] != '*') {
            $searchParams .= "bug_type = '".$_POST['rType']."' AND ";
        }
        if($_POST['severity'] != '*') {
            $searchParams .= "severity = '".$_POST['severity']."' AND ";
        }
        if($_POST['fArea'] != '*') {
            // Queries all area_id that matches the area
            $aQuery = "SELECT area_id FROM areas WHERE area ='".$_POST['fArea']."'";
            $searchParams .= "area_id IN (".$aQuery.") AND ";
        }
        if($_POST['aEmp'] != '*') {
            $searchParams .= "aEmp = '".$_POST['aEmp']."' AND ";
        }
        if($_POST['rEmp'] != '*') {
            $searchParams .= "emp_id = '".$_POST['rEmp']."' AND ";
        }
        if($_POST['status'] != '*') {
            $searchParams .= "`status` = '".$_POST['status']."' AND ";
        }
        if($_POST['priority'] != '') {
            $searchParams .= "priority = '".$_POST['priority']."' AND ";
        }
        if($_POST['resolution'] != '*') {
            $searchParams .= "resolution = '".$_POST['resolution']."' AND ";
        }

        $searchParams = substr($searchParams, 0, -5);   // truncates the last comma and space
        if($searchParams != "") {
            $searchParams = "WHERE ".$searchParams;
        }
        $sQuery = "SELECT bug_id FROM bugs LEFT JOIN bugOptional ON bugs.bugOp_id = bugOptional.bugOp_id ".$searchParams;
        //echo $sQuery;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bugs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/bugs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Bugs</h3>
        <?php
            require_once "../connect_db.php";
            //$query = "SELECT bug_id, prog_id, summary FROM bugs";
            $query = "SELECT bug_id, prog_id, summary FROM bugs WHERE bug_id IN (".$sQuery.")";
            $result = mysqli_query($conn, $query);
            // No data in table
            if(mysqli_num_rows($result) == 0) {
                echo "<h3>No matching records found.</h3>\n";
            }
            else {
                // Header of the table
                echo "<table class=\"display\"><tr><th>Bug ID</th><th>Program</th><th>Summary</th><th>Update</th><th>Delete</th><th></th></tr>";
                // Prints out each bug's information
                while($row = mysqli_fetch_row($result)) {
                    // Retrieves the program names using the prog_id associated with each bug
                    $progQuery = "SELECT program FROM programs WHERE prog_id = ".$row[1];
                    $progName = mysqli_query($conn, $progQuery);
                    while($progRow = mysqli_fetch_row($progName)) {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td>", $row[0], $progRow[0], $row[2]);
                    }
                    // Update button passing the bug_id to the update form (not yet implemented)
                    echo "<td><form action=\"updateBug.php\" method=\"get\">
                    <input type=\"hidden\" name=\"bug_id\" value=$row[0]/>
                    <input type=\"submit\" name=\"submit\" value=\"Update\"/>
                    </form></td>";
                    // Delete button passing the bug_id 
                    echo "<td><form name=\"deleteBug\" action=\"deleteBug.php\" method=\"post\">
                    <input type=\"hidden\" name=\"bug_id\" value=$row[0]/>
                    <input type=\"submit\" name=\"submit\" value=\"Delete\"/>
                    </form></td>";
                    // View attachments passing the bug_id
                    /*
                    echo "<td><form action=\"viewAttachment.php\" method=\"get\">
                    <input type=\"hidden\" name=\"bug_id\" value=$row[0]/>
                    <input type=\"submit\" name=\"submit\" value=\"View Attachment\"/>
                    </form></td>";
                    echo "</tr>";
                    */
                }
                echo "</table>";
            }
            mysqli_close($conn);
        ?>
        <br/>
        <button id="cButton">Return</button>
    </body>
</html>
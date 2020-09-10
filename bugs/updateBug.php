<?php
    require "../authenticate_db.php";

    // Populate form with bug report data
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once "../connect_db.php";
        $bug_id = $_GET['bug_id'];
        $query = "SELECT * FROM bugs LEFT JOIN bugOptional ON bugs.bugOp_id = bugOptional.bugOp_id WHERE bugs.bug_id = '".$bug_id."'";
        $result = mysqli_query($conn, $query) or die("Error [Populate Form] : ".mysqli_error($conn)."<br/>".$query."<br/>");
        $bugData = mysqli_fetch_array($result);     // Associative array for the bug report data
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../connect_db.php";
        $bug_id = $_POST['bug_id'];
        $prog_id = $_POST['program'];                   // program id (could be name instead)
        $rType = $_POST['rType'];                       // report type
        $severity = $_POST['severity'];                 // severity
        $rSum = addslashes($_POST['rSum']);             // report summary
        $reproduce = $_POST['reproduce'] ?? '';         // reproducibility
        $rMain = addslashes($_POST['rMain']);           // report problem
        $sFix = addslashes($_POST['sFix']) ?? '';       // suggested Fix (optional)
        $dEmployee = $_POST['dEmployee'];               // employee who reported this bug (id)
        $dDate = $_POST['dDate'];                       // date the bug was discovered
        $query = "UPDATE bugs SET ";
        
        // Optional Bug Report Info
        // Checks if at least one value is filled in optional section
        // Only inserts into bugOptional if at least 1 value is filled in optional section
        $area_id = $_POST['area'] ?? '';
        $aEmp = $_POST['aEmployee'] ?? '';
        $comments = addslashes($_POST['comments']) ?? '';
        $status = $_POST['status'] ?? '';
        $priority = $_POST['priority'] ?? '';
        $resolution = $_POST['resolution'] ?? '';
        $resVer = $_POST['resVer'] ?? 0;
        $rEmp = $_POST['rEmployee'] ?? '';
        $rDate = $_POST['rDate'] ?? '';
        $tEmp = $_POST['tEmployee'] ?? '';
        $tDate = $_POST['tDate'] ?? '';
        $deferred = $_POST['deferred'] ?? '';

        // Gets the bugOp_id associated with this bug report if it exists (indicates whether 1+ bugOptional data fields were filled)
        $opQuery = "SELECT bugOp_id from bugs WHERE bug_id = '" . $bug_id . "'";
        $opResult = mysqli_query($conn, $opQuery);
        $opRow = mysqli_fetch_row($opResult);
        $bugOp_id = $opRow[0];

        // Determines if all bugOptional data fields are filled or not 
        $optional = array('area', 'aEmployee', 'comments', 'status', 'priority', 'resolution', 'res_version', 'rEmployee', 'rDate', 'tEmployee', 'tDate', 'deferred');
        $filled = FALSE;
        foreach ($optional as $field) {
            if (!empty($_POST[$field] || ($_POST[$field] != NULL))) {
                $filled = TRUE;
            }
        }

        // Indicates 1+ bugOptional data fields were filled
        if ($bugOp_id != NULL) {
            $uOpQuery = "UPDATE bugoptional SET area_id = " . $area_id . ", aEmp = " . $aEmp . ", comments = '" . $comments . "',
                        status = '" . $status . "', priority = '" . $priority . "', resolution = '" . $resolution . "', res_version = '".$resVer."', rEmp = " . $rEmp . ",
                        rDate = '" . $rDate . "', tEmp = " . $tEmp . ", tDate = '" . $tDate . "', deferred = '" . $deferred . "' WHERE bugOP_id = " . $bugOp_id;
            $upOptional = mysqli_query($conn, $uOpQuery) or die("Error [Bug Optional Update]: " . mysqli_error($conn)."<br/>".$uOpQuery."<br/>");
            
            // Deletes bugOptional data row associated with this bug report 
            // This indicates that the bug report was updated to not have any bugOptional data fields filled and thus bugOp_id is no longer needed
            if(!$filled){
                echo "delete bug optional <br/>";
                //change the value of bugOp_id in bugs table to unlink Optional data
                $delOpQuery = "UPDATE bugs SET bugOp_id = NULL WHERE bugOp_id = '".$bugOp_id."'";
                mysqli_query($conn, $delOpQuery);
                $delOpQuery = "DELETE from bugoptional WHERE bugOp_id = '".$bugOp_id."'";
                mysqli_query($conn, $delOpQuery);
            }
        }
        // Indicates bugOptional data fields were blank before update
        else {
            // add if filled out as there wasn't optional data before
            if ($filled) {
                $uOpQuery = "INSERT INTO bugOptional
                            VALUES (NULL, '" . $area_id . "', '" . $aEmp . "', '" . $comments . "', '" . $status . "', " . $priority . ", '" . $resolution . "', ".$resVer.", '" . $rEmp . "', '" . $rDate . "', '" . $tEmp . "', '" . $tDate . "', " . $deferred . ")";
                mysqli_query($conn, $uOpQuery) or die("Error [Bug Optional Update] : ".mysqli_error($conn)."<br/>".$uOpQuery."<br/>");

                // Retrieves the new bugOp_id to be updated into the bugs table
                $uOpQuery = "SELECT bugOp_id FROM bugOptional ORDER BY bugOp_id DESC LIMIT 1";
                $uOpResult = mysqli_query($conn, $uOpQuery) or die("Error [Bug Optional ID] : ".mysqli_error($conn)."<br/>".$uOpQuery."<br/>");
                $bugOpRow = mysqli_fetch_row($uOpResult);
                $bugOp_id = $bugOpRow[0];
            } 
        }

        // Creates query to update bugs table
        if ($prog_id != NULL) {
            $query .= "prog_id = '" . $prog_id . "', ";
        }
        if ($rType != NULL) {
            $query .= "bug_type = '" . $rType . "', ";
        }
        if ($severity != NULL) {
            $query .= "severity = '" . $severity . "', ";
        }
        if ($rSum != NULL) {
            $query .= "summary = '" . $rSum . "', ";
        }
        if ($reproduce != NULL) {
            $query .= "reproduce = '" . $reproduce . "', ";
        }
        if ($rMain != NULL) {
            $query .= "problem = '" . $rMain . "', ";
        }
        // Optional and thus can be null
        $query .= "suggest_fix = '" . $sFix . "', ";
        if ($dEmployee != NULL) {
            $query .= "emp_id = '" . $dEmployee . "', ";
        }

        if ($dDate != NULL) {
            $query .= "dDate = '" . $dDate . "', ";
        }
        if ($bugOp_id != NULL) {
            $query .= "bugOp_id ='" . $bugOp_id . "', ";
        }

        // Truncates the last comma and whitespace
        $query = substr($query, 0, -2);
        $query .= " WHERE bug_id = ".$bug_id."";
        $query = substr($query, 0, -1); // not sure if needed

        mysqli_query($conn, $query) or die("Error [Bug Update] : ".mysqli_error($conn)."<br/>".$query."<br/>");

        // Inserts attachment to attachments table if an attachment was added (doesn't support insert multiple attachments at once yet)
        if(isset($_FILES['attachment'])) {
            // Goes through each file and inserts it with the latest bug_id as the foreign key reference
            foreach($_FILES['attachment']['tmp_name'] as $key => $tmp_name) {
                $attach_name = basename($_FILES['attachment']['name'][$key]);                           // file name
                $attach_type = $_FILES['attachment']['type'][$key];                                     // file type
                $attach_data = addslashes(file_get_contents($_FILES['attachment']['tmp_name'][$key]));  // file data

                $query = "INSERT INTO attachments
                            VALUES (NULL, ".$bug_id.", '".$attach_name."','".$attach_type."', '".$attach_data."')";
                // Performs the query to insert attachment or prints out an error message with the query
                mysqli_query($conn, $query) or die("Error [attachment] : ".mysqli_error($conn)."<br/>".$query."<br/>");    
            }
        }
        mysqli_close($conn);
        header('Location: searchBug.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Bug Report</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bugs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Update Bug Report</h3>
        <!-- View Attachments -->
        <form id="viewAttachment" action="viewAttachment.php" method="get" target="_blank">
            <select name="attachments">
                <option value=""></option>
                <?php
                    require_once "../connect_db.php";
                    $query = "SELECT attach_id, attach_name FROM attachments WHERE bug_id = '".$_GET['bug_id']."'";
                    $result = mysqli_query($conn, $query) or die("Error [View Attachments] : ".mysqli_error($conn));
                    while($row = mysqli_fetch_row($result)) {
                        // Assigns attach_id to value and displays attach_name
                        echo "<option value=\"".$row[0]."\">".$row[1]."</option>";
                    }
                ?>
            </select>
            <input type="submit" name="submit" value="View Attachment">
        </form>
        <br/>
        <!-- Update Bug Report -->
        <form id="updateBug" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <input id="bug_id" name="bug_id" type="hidden" value=<?php echo $_GET['bug_id']; ?>>
            <?php require "bugForm.php" ?>     
        </form>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
<?php
    require "../authenticate_std.php";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../connect_db.php";
        
        // Required Bug Report Info
        $prog_id = $_POST['program'];                   // program id (could be name instead)
        $rType = $_POST['rType'];                       // report type
        $severity = $_POST['severity'];                 // severity
        $rSum = addslashes($_POST['rSum']);             // report summary
        $reproduce = $_POST['reproduce'] ?? NULL;       // reproducibility
        $rMain = addslashes($_POST['rMain']);           // report problem
        $sFix = addslashes($_POST['sFix']) ?? '';       // suggested Fix (optional)
        $dEmployee = $_POST['dEmployee'];               // employee who reported(discovered) this bug (id)
        $dDate = $_POST['dDate'];                       // Date discovered        

        // Optional Bug Report Info
        // Checks if at least one value is filled in optional section
        $optional = array('area', 'aEmployee', 'comments', 'status', 'priority', 'resolution', 'resVer', 'rEmployee', 'rDate', 'tEmployee', 'tDate', 'deferred');
        $filled = FALSE;
        foreach($optional as $field) {
            if(!empty($_POST[$field])) {
                $filled = TRUE;
            }
        }
        $bugOp_id = NULL;
        // Only inserts into bugOptional if at least 1 value is filled in optional section
        if($filled) {
            $area_id = $_POST['area'];
            $aEmp = $_POST['aEmployee'];
            $comments = addslashes($_POST['comments']) ?? '';
            $status = $_POST['status'];
            $priority = $_POST['priority'] ?? '';
            $resolution = $_POST['resolution'] ?? '';
            $resVer = $_POST['resVer'] ?? 0;
            $rEmp = $_POST['rEmployee'];
            $rDate = $_POST['rDate'] ?? '';
            $tEmp = $_POST['tEmployee'];
            $tDate = $_POST['tDate'] ?? '';
            $deferred = $_POST['deferred'];

            $query = "INSERT INTO bugOptional
                        VALUES (NULL, ".$area_id.", ".$aEmp.", '".$comments."', '".$status."', '".$priority."', '".$resolution."', '".$resVer."', ".$rEmp.", '".$rDate."', ".$tEmp.", '".$tDate."', '".$deferred."')"; 
            mysqli_query($conn, $query) or die("Error [bugOptional]: ".mysqli_error($conn)."<br/>".$query."<br/>");

            // Grabs the latest id added to be inserted into bugs
            $query = "SELECT bugOp_id FROM bugOptional ORDER BY bugOp_id DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            $bugOpRow = mysqli_fetch_row($result);
            $bugOp_id = $bugOpRow[0];
        }
        // Insert bug report into bugs table (should only need this query as NULL can be inserted)
        $query = "INSERT INTO bugs 
                        VALUES (NULL, ".$prog_id.", '".$rType."', '".$severity."', '".$rSum."', '".$reproduce."', '".$rMain."', '".$sFix."', '".$dEmployee."', '".$dDate."', ".$bugOp_id.")";

        // Prints out error if query fails
        if(!mysqli_query($conn, $query)) {
            echo("Error description 2: " . mysqli_error($conn));
            echo "<br/>".$query."<br/>";
        }
        // Inserts attachment to attachments table if an attachment was added (doesn't support insert multiple attachments at once yet)
        if(isset($_FILES['attachment'])) {
            // Grabs the latest bug id to be inserted into attachments
            $query = "SELECT bug_id FROM bugs ORDER by bug_ID DESC LIMIT 1";
            $result = mysqli_query($conn, $query) or die("Error [bugID] : ".mysqli_error($conn)."<br/>".$query."<br/>");
            $bugIdRow = mysqli_fetch_row($result);
            $bug_id = $bugIdRow[0];

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
        header('Location: ../start_page.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Bug Report</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bugs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>New Bug Report</h3>
        <form enctype="multipart/form-data" id="addBug" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php require "bugForm.php" ?>
        </form>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>

<?php
    require "../authenticate_db.php"; 
    require_once "../connect_db.php";

    // Creates the file
    $asciifile = fopen("bugsASCII.txt", "w") or die("Unable to open file!");

    // Headers
    $txt = "Bug Reports\n";


    $query = "SELECT * FROM bugs LEFT JOIN bugOptional ON bugs.bugOp_id = bugOptional.bugOp_id";
    $result = mysqli_query($conn,$query);

    $txt .= "-----------------------------------------------------------------\n";
    while($row = mysqli_fetch_array($result)) {
        $txt .= "[Bug ID] :".$row['bug_id']."\n";
        $txt .= "[Program ID] : ".$row['prog_id']."\n";
        $txt .= "[Bug Type] : ".$row['bug_type']."\n";
        $txt .= "[Severity] : ".$row['severity']."\n";
        $txt .= "[Summary] : ".$row['summary']."\n";
        $txt .= "[Reproducible] : ".$row['reproduce']."\n";
        $txt .= "[Problem] : ".$row['problem']."\n";
        $txt .= "[Suggested Fix] : ".$row['suggest_fix']."\n";
        $txt .= "[Reported By Employee ID] : ".$row['emp_id']."\n";
        $txt .= "[Discovered Date] : ".$row['dDate']."\n";
        $txt .= "[Bug Optional ID] : ".$row['bugOp_id']."\n";
        $txt .= "[Functional Area ID] : ".$row['area_id']."\n";
        $txt .= "[Assigned To Employee ID] : ".$row['aEmp']."\n";
        $txt .= "[Comments] : ".$row['comments']."\n";
        $txt .= "[Status] : ".$row['status']."\n";
        $txt .= "[Priority] : ".$row['priority']."\n";
        $txt .= "[Resolution] : ".$row['resolution']."\n";
        $txt .= "[Resolution Version] : ".$row['res_version']."\n";
        $txt .= "[Resolved By Employee ID] : ".$row['rEmp']."\n";
        $txt .= "[Resolved Date] : ".$row['rDate']."\n";
        $txt .= "[Tested By Employee ID] : ".$row['tEmp']."\n";
        $txt .= "[Tested Date] : ".$row['tDate']."\n";
        $txt .= "[Deferred] : ".$row['deferred']."\n";
        $txt .= "-----------------------------------------------------------------\n";
    }

    // Writes to file and closes it
    fwrite($asciifile, strval($txt));
    fclose($asciifile);

    header("Location: ../maintain_db.php");
?>
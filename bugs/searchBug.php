<?php
    require "../authenticate_std.php";

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>New Bug Report</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bugs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Bug Search</h3>
        <br><br/>
        <form id="searchBug" method="post" action="bugs.php">
            <label for="programs">Program </label>
            <select id="programs" name="programs">
                <?php
                    require_once "../connect_db.php";
                    $pQuery = "SELECT * FROM programs ";
                    $pResult = mysqli_query($conn, $pQuery);
                    echo "<option value='*'>All</option>";
                    while($row = mysqli_fetch_row($pResult)) {
                    // Assigns id to value and displays the program name along with [release].[version]
                        echo "<option value=\"".$row[0]."\">".$row[1]." ".$row[2].".".$row[3]."</option>";
                    }
                ?>
            </select>
            <br/>
            <label for="rType">Report Type </label>
            <select id="rType" name="rType">
                    
                <option value='*'>All</option>";
                <option value="Coding Error">Coding Error</option>
                <option value="Design Issue">Design Issue</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Documentation">Documentation</option>
                <option value="Hardware">Hardware</option>
                <option value="Query">Query</option>
                    
                
            </select>
            <br/>
            <label for="severity">Severity </label>
            <select id="severity" name="severity">
           
                <option value='*'>All</option>
                <option value="Minor">Minor</option>
                <option value="Serious">Serious</option>
                <option value="Fatal">Fatal</option>
            </select>
            <br/>
            <label for="fArea">Functional Area </label>
            <select id="fArea" name="fArea">
                <?php
                    // Shows only distinct areas as there may be multiple progrmas with the same area
                    $aQuery = "SELECT DISTINCT area FROM areas";
                    $aResult = mysqli_query($conn, $aQuery);
                    echo "<option value='*'>All</option>";
                    while($row = mysqli_fetch_row($aResult)) {
                        // Assigns area to value and displays the area as an option
                        echo "<option value=\"".$row[0]."\">".$row[0]."</option>";
                    }
                ?>
            </select>
            <br/>
            <label for="assigned">Assigned To </label>
            <select id="assigned" name="aEmp">
                <?php
                    $assignedQuery = "SELECT * FROM employees";
                    //$sQuery = "SELECT * FROM areas WHERE prog_id = '".$_POST['programs']."'";
                    $eResult = mysqli_query($conn, $assignedQuery);
                    echo "<option value='*'>All</option>";
                    // Reuses a previous query result that fetched employee's id and name
                    while($row = mysqli_fetch_row($eResult)) {
                        // Assigns id to value and displays the employee name as an option
                        echo "<option value=\"".$row[0]."\">".$row[1]."</option>";
                    }
                    mysqli_data_seek($eResult, 0);  // resets pointer to the start of the result set for reuse
                ?>
            </select>
            <br/>
            <label for="reported">Reported By </label>
            <select id="reported" name="rEmp">
                <?php
                    echo "<option value='*'>All</option>";
                    // Reuses a previous query result that fetched employee's id and name
                    while($row = mysqli_fetch_row($eResult)) {
                        // Assigns id to value and displays the employee name as an option
                        echo "<option value=\"".$row[0]."\">".$row[1]."</option>";
                    }
                ?>
            </select>
            <br/>
            <label for="status">Status </label>
            <select id="status" name="status">
                <option value="Open">Open</option>
                <option value="Closed">Closed</option>
                <option value="Resolved">Resolved</option>
            </select>
            <br/>
            <label for="priority">Priority </label>
                  <input type="number" id="priority" name="priority" min="1" max="6" value=""> 
            <br/>
            <label for="resolution">Resolution </label>
            <select id="resolution" name="resolution">
                <option value="*">All</option>
                <option value="Pending">Pending</option>
                <option value="Fixed">Fixed</option>
                <option value="Irreproducible">Irreproducible</option>
                <option value="Deferred">Deferred</option>
                <option value="As designed">As designed</option>
                <option value="Withdrawn by reporter">Withdrawn by reporter</option>
                <option value="Need more information">Need more information</option>
                <option value="Disagree with suggestion">Disagree with suggestion</option>
                <option value="Duplicate">Duplicate</option>
            </select>
            <br/>
            <input type="submit" name="submit" value="Submit">
        </form>
        <button id="hButton">Return</button>
    </body>
</html>
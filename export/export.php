<?php
    require "../authenticate_db.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tableName = $_POST['tableName'];
        $format = $_POST['format'];

        // Export areas
        if(strcmp($tableName, "areas") == 0) {
            if(strcmp($format, "ASCII") == 0) {
                header('Location: exportAreasA.php');
            }
            else {
                header('Location: exportAreasX.php');
            }
        }
        // Export employees
        else if(strcmp($tableName, "employees") == 0) {
            if(strcmp($format, "ASCII") == 0) {
                header('Location: exportEmployeesA.php');
            }
            else {
                header('Location: exportEmployeesX.php');
            }
        }
        // Export programs
        else if(strcmp($tableName, "programs") == 0) {
            if(strcmp($format, "ASCII") == 0) {
                header('Location: exportProgramsA.php');
            }
            else {
                header('Location: exportProgramsX.php');
            }
        }
        // Export bugs
        else {
            if(strcmp($format, "ASCII") == 0) {
                header('Location: exportBugsA.php');
            }
            else {
                header('Location: exportBugsX.php');
            }
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Export Data</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/areas.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Export Data</h3>
        <form name="exportData" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <select id="tableName" name="tableName">
                <option value="areas">Areas</option>
                <option value="employees">Employees</option>
                <option value="programs">Programs</option>
                <option value="bugs">Bugs</option>
            </select>
            <select id="format" name="format">
                <option value="ASCII">ASCII</option>
                <option value="XML">XML</option>
            </select>
            <button id="exportSubmit" type="submit" value="Submit">Submit</button>
        </form>
        <br />
        <button id="hButton">Return</button>
    </body>
</html>

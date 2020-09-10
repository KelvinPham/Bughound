<?php
    // Only runs if one of the update fields have a value
    if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['pName']) || isset($_POST['pRelease']) || isset($_POST['pVersion']))) {
        require_once "../connect_db.php";
        
        $prog_id = $_POST['prog_id'];
        $pName = $_POST['pName'];
        $pRelease = $_POST['pRelease'];
        $pVersion = $_POST['pVersion'];

        // Update program in Programs table
        $query = "UPDATE programs SET";
        if($pName != NULL) {
            $query .= " program = '".$pName."',";
        }
        if($pRelease != NULL) {
            $query .= " program_release = '".$pRelease."',";
        }
        if($pVersion != NULL) {
            $query .= " program_version = '".$pVersion."',";
        }
        // Truncates the last comma before adding the WHERE clause
        $query = substr($query, 0, -1);
        $query .= " WHERE prog_id = '".$prog_id."'"; 
        mysqli_query($conn, $query);
        mysqli_close($conn);
        header('Location: programs.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Employees</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/programs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Update Program</h3>
        <form id="updateProgram" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input name= "prog_id" type="hidden" value=<?php echo $_POST['prog_id']; ?>>
            <table>
                <tr><td>Name: </td><td><input id="pName" name="pName" type="Text"></td></tr>
                <tr><td>Program Release: </td><td><input name="pRelease"type="number" min = 0;></td></tr>
                <tr><td>Program Version: </td><td><input name="pVersion" type="number" min = 0;></td></tr>
            </table>
            <br/>
            <input type="submit" name="submit" value="Submit">
        </form>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
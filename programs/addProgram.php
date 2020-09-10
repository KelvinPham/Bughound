<?php
    require "../authenticate_db.php";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../connect_db.php";
        
        $pName = $_POST['pName'];
        $pRelease = $_POST['pRelease'];
        $pVersion = $_POST['pVersion'];
        // Insert program into programs table
        $query = "INSERT INTO programs (prog_id, program, program_release, program_version) VALUES (NULL,'".$pName."','".$pRelease."','".$pVersion."')";
        mysqli_query($conn, $query);
        mysqli_close($conn);
        header('Location: ../maintain_db.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Programs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/programs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Add Program</h3>
        <form id="addProgram" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr><td>Program Name: </td><td><input id="pName" name="pName" type="Text"></td></tr>
                <tr><td>Program Release: </td><td><input id="pRelease" name="pRelease"type="number" min="0"></td></tr>
                <tr><td>Program Version: </td><td><input id="pVersion" name="pVersion" type="number" min="0"></td></tr>
            </table>
            <br/>
            <input type="submit" name="submit" value="Submit">
        </form>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
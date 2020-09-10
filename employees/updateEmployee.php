<?php
    require "../authenticate_db.php";

    // Only runs if one of the update fields have a value
    if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['name']) || isset($_POST['user']) || isset($_POST['pwd']) || isset($_POST['uLvl']))) {
        require_once "../connect_db.php";
        
        $emp_id = $_POST['emp_id'];
        $name = $_POST['name'];
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];
        $uLvl = $_POST['uLvl'];

        // Update employee in Employees table
        $query = "UPDATE employees SET";
        if($name != NULL) {
            $query .= " name = '".$name."',";
        }
        if($user != NULL) {
            $query .= " username = '".$user."',";
        }
        if($pwd != NULL) {
            // Hashes password using sha512 and truncates to 32 chars
            $pwd = hash('sha512', $pwd);
            $pwd = substr($pwd, 0, 32);
            $query .= " password = '".$pwd."',";
        }
        if($uLvl != NULL) {
            $query .= " userlevel = '".$uLvl."',";
        }
        // Truncates the last comma before adding the WHERE clause
        $query = substr($query, 0, -1);
        $query .= " WHERE emp_id = '".$emp_id."'"; 
        mysqli_query($conn, $query);
        mysqli_close($conn);
        header('Location: employees.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Programs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/employees.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Update Employee</h3>
        <form id="updateEmployee" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input id="emp_id" name="emp_id" type="hidden" value=<?php echo $_POST['emp_id']; ?>>
            <table>
                <tr><td>Name: </td><td><input id="name" name="name" type="Text"></td></tr>
                <tr><td>Username: </td><td><input name="user" type="Text"></td></tr>
                <tr><td>Password: </td><td><input name="pwd" type="password"></td></tr>
                <tr><td>User Level: </td><td><input name="uLvl"type="number" min="1" max="3" ></td></tr>
            </table>
            <br/>
            <input type="submit" name="submit" value="Submit">
        </form>
        <br/>
        <button id="eButton">Return</button>
    </body>
</html>
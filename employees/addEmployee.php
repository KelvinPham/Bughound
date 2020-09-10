<?php
    require "../authenticate_db.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../connect_db.php";

        $name = $_POST['name'];
        $user = $_POST['user'];

        $pwd = $_POST['pwd'];
        $pwd = hash('sha512', $pwd);
        $pwd = substr($pwd, 0, 32);

        $uLvl = $_POST['uLvl'];
        // Insert employee into Employees table
        $query = "INSERT INTO employees (emp_id, name, username, password, userlevel) VALUES (NULL,'".$name."','".$user."','".$pwd."','".$uLvl."')";  // insert if not exists ?? -JC
        mysqli_query($conn, $query);
        mysqli_close($conn);
        header('Location: ../maintain_db.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Employees</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/employees.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Add Employee</h3>
        <form id="addEmployee" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr><td>Name: </td><td><input id="name" name="name" type="Text"></td></tr>
                <tr><td>Username: </td><td><input id="user" name="user" type="Text"></td></tr>
                <tr><td>Password: </td><td><input id="pwd" name="pwd" type="password"></td></tr>
                <tr><td>User Level: </td><td><input id="uLvl" name="uLvl" type="number" min="1" max="3" ></td></tr>
            </table>
            <br/>
            <input type="submit" name="submit" value="Submit">
        </form>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
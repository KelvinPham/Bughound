<!-- start page -->

<?php
    session_start();
    attempt_user_login();

    function attempt_user_login()
    {
        require "connect_db.php";

        if($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['username']) || !isset($_POST['password'])) { return false; }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = hash('sha512', $password);    // Hashes it 
        $password = substr($password, 0, 32);
        $query = "SELECT * FROM employees WHERE username = '" . $username . "' AND password = '" . $password . "'";
        $result = mysqli_query($conn, $query);
        if (! $result) { echo "TO DEVS: If you see this you done goof'd the SQL querry - JC"; session_unset(); return false; }
        if ($row = mysqli_fetch_row($result))
        {
            // Valid login
            $_SESSION["username"] = $row[1];
            $_SESSION["userlevel"] = $row[4];
            return true;
        }

        // Logs out user if they attempt to log into a different account and fail
        session_unset();
        return false;
    }
?>

<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf8'>
        <title>Bughound</title>        
        <link rel='stylesheet' href='css/style.css'>
        <link rel="icon" href="media/fav.png">
        <script type='text/javascript' src='js/start_page/main.js'></script>
    </head>

    <body>
        <h1> Welcome to Bughound </h1>

        <table>

        <?php
            function is_logged_in() { return isset($_SESSION["username"]) && isset($_SESSION["userlevel"]); }

            if(is_logged_in())
            {
                echo '<tr><td class="large_text"><a href="bugs/addBug.php">Enter NEW Bug</a></td></tr>';
                echo '<tr><td class="large_text"><a href="bugs/searchBug.php">Update EXISTING Bug</a></td></tr>';
                if ($_SESSION["userlevel"] >= 3) { echo '<tr><td class="large_text"><a href="maintain_db.php">Database Maintenance</a></td></tr>'; }
                echo '<tr><td class="medium_text">User: <span class="green_me">' . $_SESSION["username"] . '</span>, User Level: <span class="green_me">' . $_SESSION["userlevel"] .'</span></td></tr>';
                echo '<tr><td><button class="small_text" onclick=\'return_to_login_page();\'>Sign out</button></td></tr>';
            }
            else
            {
                echo '<tr><td class="large_text">User could not be validated. Please click return and attempt to login again. </td></tr>';
                echo '<tr><td><button class="large_text" onclick=\'return_to_login_page();\'>Return</button></td></tr>';
            }
        ?>

        </table>

        <img src='media/hound.jpg' alt='mascot picture' id='welcome_hound' />
    </body>

</html>
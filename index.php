<!-- login page -->
<?php
    session_start();
    // TO DEVS: Visiting this page constitutes logging out, do not change this.
    session_unset();
?>

<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf8'>
        <title>Bughound</title>        
        <link rel='stylesheet' href='css/style.css'>
        <link rel="icon" href="media/fav.png">
        <!--<script type='text/javascript' src='js/lib/sha512.js'></script>-->
        <script type='text/javascript' src='js/login/main.js'></script>
    </head>

    <body>
        <h1> Welcome to Bughound </h1>

        <img src='media/hound.jpg' alt='mascot picture' id='welcome_hound' />

        <form action='start_page.php' method='post' onsubmit='return process_login_form(this)'>
            <table>
                <tr>
                    <td><input type='text' name='username' placeholder='Username'> </td> 
                </tr> 
                <tr>
                    <td><input type='password' name='password'  placeholder='Password'> </td> 
                </tr>
            </table>

            <input type='submit' name='submit' value='Login' />
        </form>
    </body>

</html>
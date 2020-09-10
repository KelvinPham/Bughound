<?php
    require "authenticate_db.php";
?>

<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf8'>
        <title>Bughound</title>
        <link rel='stylesheet' href='css/style.css'>
        <link rel="icon" href="media/fav.png">
        <script type='text/javascript' src='js/database_mainenance_page/main.js'></script>
    </head>

    <body>
        <h1> Database Maintenance </h1>

        <table>
            <tr><td><a class='large_text' href="areas/areas.php">Add / Edit Areas</a></td></tr>
            <tr></tr>
            <tr><td><a class='large_text' href="programs/addProgram.php">Add Programs</a></td></tr>
            <tr></tr>
            <tr><td><a class='large_text' href="programs/programs.php">Edit Programs</a></td></tr>
            <tr></tr>
            <tr><td><a class='large_text' href="employees/addEmployee.php">Add Employees</a></td></tr>
            <tr></tr>
            <tr><td><a class='large_text' href="employees/employees.php">Edit Employees</a></td></tr>
            <tr></tr>
            <tr><td><a class='large_text' href="export/export.php">Export Data</a></td></tr>
            <tr></tr>
            <tr><td><button class='small_text' onclick='return_to_start_page()'>Return</button></td></tr>
        </table>
    </body>

</html>
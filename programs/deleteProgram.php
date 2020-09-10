<?php
    require_once "../connect_db.php";

    $prog_id = $_POST['prog_id'];
    // Deletes employee in Employees table
    $query = "DELETE FROM programs WHERE prog_id = '".$prog_id."'";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    header("Location: programs.php");
?>
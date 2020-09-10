<?php
    require_once "../connect_db.php";

    $emp_id = $_POST['emp_id'];
    // Deletes employee in Employees table
    $query = "DELETE FROM employees WHERE emp_Id = '".$emp_id."'";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    header("Location: employees.php");
?>
<?php
    require_once "../connect_db.php";

    $area_id = $_POST['area_id'];
    // Deletes area in Area table
    $query = "DELETE FROM areas WHERE area_Id = '".$area_id."'";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    header("Location: addArea.php");
?>
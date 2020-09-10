<?php
    require_once "../connect_db.php";

    $bug_id = $_POST['bug_id'];
    // Deletes bugOptional entry associated with this bug
    $opQuery = "SELECT bugOp_id FROM bugs WHERE bug_id = '".$bug_id."'";
    $result = mysqli_query($conn, $opQuery);
    $bugOp_id = NULL;
    while ($opRow = mysqli_fetch_row($result)) {
        $bugOp_id = $opRow[0];
    }
    if($bugOp_id != NULL){
        //unlink optional data
        $unlinkOp = "UPDATE bugs SET bugOp_id = NULL WHERE bug_id = '".$bug_id."'";
        mysqli_query($conn, $unlinkOp);
        //delete optional data
        $deleteOp = "DELETE FROM bugoptional WHERE bugOp_id = '".$bugOp_id."'";
        mysqli_query($conn, $deleteOp);
    }
    // Deletes bugs entry
    $query = "DELETE FROM bugs WHERE bug_id = '".$bug_id."'";
    mysqli_query($conn, $query);

    // Deletes attachment entries associated with this bug
    $query = "DELETE FROM attachments WHERE bug_id = '".$bug_id."'";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    header("Location: searchBug.php");
?>
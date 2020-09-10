<?php
    require "../authenticate_db.php";
    require_once "../connect_db.php";
    if(isset($_GET['attachments'])) {
        $attach_id = $_GET['attachments'];
        // query for attachments table
        $query = "SELECT attach_type, attach_data FROM attachments WHERE attach_id = '".$attach_id."'";
        $result = mysqli_query($conn, $query) or die("ERROR".mysqli_error($conn));
        $attachmentRow = mysqli_fetch_array($result);

        // Sets the header to allow the browser how to render the binary data
        header('Content-type: '.$attachmentRow['attach_type'].'');
        echo $attachmentRow['attach_data'];
    }
    mysqli_close($conn);
?>
<?php
    require "../authenticate_db.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bugs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/bugs.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Results</h3>
            <?php
                 require_once "../connect_db.php";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once "../connect_db.php";
        $prog_id = $_POST['programs'];
        $rtype = $_POST['rType'];
        $severity = $_POST['severity'];
        $fArea = $_POST['fArea'];
        $assigned = $_POST['assigned'];
        $reported = $_POST['reported'];
        $status = $_POST['status'];
        $priority = $_POST['priority'];
        $resolution = $_POST['resolution'];
        
        
       *searchQuery Select * from bugs WHERE prog_id = $prog_id
        /*
        if($prog_id != "*"){
            $searchQuery .= "prog_id = '".$prog_id."', ";
        }
         if($rType != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        if($severity != "*"){
            $query .= "severity = '".$severity."', ";
        }
        if($fArea != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        if($rType != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        if($rType != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        if($rType != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        if($rType != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        if($rType != "*"){
            $query .= "bug_type = '".$rType."', ";
        }
        
        
        
         * */
        }
            ?>
        <br/>
        <button id="hButton">Return</button>
    </body>
</html>
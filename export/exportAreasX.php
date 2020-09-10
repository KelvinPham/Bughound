<?php
    require "../authenticate_db.php";
    require_once "../connect_db.php";

    $query = "SELECT * FROM areas";

    $result = mysqli_query($conn,$query);
    $xml = new DOMDocument();
    $xmlAreas = $xml->createElement("areasTable");

    while($row=mysqli_fetch_row($result)) {
        
        $xmlAreaInfo = $xml->createElement("areaInfo");
        $xmlAreaID = $xml->createElement("areaID");
        $xmlProgID = $xml->createElement("progID");
        $xmlArea = $xml->createElement("area");

        // Headers
        $xmlAreas->appendChild($xmlAreaInfo);
        $xmlAreaInfo->appendChild($xmlAreaID);
        $xmlAreaInfo->appendChild($xmlProgID);
        $xmlAreaInfo->appendChild($xmlArea);

        // Data
        $xmlAreaIDText = $xml->createTextNode($row[0]);
        $xmlProgIDText = $xml->createTextNode($row[1]);
        $xmlAreaText = $xml->createTextNode($row[2]);
        $xmlAreaID->appendChild($xmlAreaIDText);
        $xmlProgID->appendChild($xmlProgIDText);
        $xmlArea->appendChild($xmlAreaText);

        // For testing purposes
        //printf("<tr><td>%d</td><td>%d</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2]);

    }
    $xml->appendChild($xmlAreas);
    $xml->save("areas.xml");


?>

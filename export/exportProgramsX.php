<?php
    require "../authenticate_db.php";
    require_once "../connect_db.php";

    $query = "SELECT * FROM programs";

    $result = mysqli_query($conn,$query);
    $xml = new DOMDocument();
    $xmlPrograms = $xml->createElement("programsTable");

    while($row=mysqli_fetch_row($result)) {
        
        $xmlProgramInfo = $xml->createElement("programInfo");
        $xmlProgID = $xml->createElement("progId");
        $xmlProgName = $xml->createElement("ProgName");
        $xmlProgRelease = $xml->createElement("progRelease");
        $xmlProgVersion = $xml->createElement("progVersion");

        // Headers
        $xmlPrograms->appendChild($xmlProgramInfo);
        $xmlProgramInfo->appendChild($xmlProgID);
        $xmlProgramInfo->appendChild($xmlProgName);
        $xmlProgramInfo->appendChild($xmlProgRelease);
        $xmlProgramInfo->appendChild($xmlProgVersion);

        // Data
        $xmlIdText = $xml->createTextNode($row[0]);
        $xmlNameText = $xml->createTextNode($row[1]);
        $xmlReleaseText = $xml->createTextNode($row[2]);
        $xmlVersionText = $xml->createTextNode($row[3]);
        $xmlProgID->appendChild($xmlIdText);
        $xmlProgName->appendChild($xmlNameText);
        $xmlProgRelease->appendChild($xmlReleaseText);
        $xmlProgVersion->appendChild($xmlVersionText);

        // For testing purposes
        //printf("<tr><td>%d</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2]);

    }
    $xml->appendChild($xmlPrograms);
    $xml->save("programs.xml");


?>

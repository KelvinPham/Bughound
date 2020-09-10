<?php
    require "../authenticate_db.php";
    require_once "../connect_db.php";

    $query = "SELECT * FROM employees";

    $result = mysqli_query($conn,$query);
    $xml = new DOMDocument();
    $xmlEmployees = $xml->createElement("employeesTable");

    while($row=mysqli_fetch_row($result)) {
        
        $xmlEmployeeInfo = $xml->createElement("employeeInfo");
        $xmlEmpID = $xml->createElement("empID");
        $xmlName = $xml->createElement("name");
        $xmlUsername = $xml->createElement("username");
        $xmlPassword = $xml->createElement("password");
        $xmlUserLevel = $xml->createElement("userlevel");

        // Headers
        $xmlEmployees->appendChild($xmlEmployeeInfo);
        $xmlEmployeeInfo->appendChild($xmlEmpID);
        $xmlEmployeeInfo->appendChild($xmlName);
        $xmlEmployeeInfo->appendChild($xmlUsername);
        $xmlEmployeeInfo->appendChild($xmlPassword);
        $xmlEmployeeInfo->appendChild($xmlUserLevel);

        // Data
        $xmlIDText = $xml->createTextNode($row[0]);
        $xmlNameText = $xml->createTextNode($row[1]);
        $xmlUsernameText = $xml->createTextNode($row[2]);
        $xmlPasswordText = $xml->createTextNode($row[3]);
        $xmlUserLevelText = $xml->createTextNode($row[4]);
        $xmlEmpID->appendChild($xmlIDText);
        $xmlName->appendChild($xmlNameText);
        $xmlUsername->appendChild($xmlUsernameText);
        $xmlPassword->appendChild($xmlPasswordText);
        $xmlUserLevel->appendChild($xmlUserLevelText);

        // For testing purposes
        //printf("<tr><td>%d</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2]);

    }
    $xml->appendChild($xmlEmployees);
    $xml->save("employees.xml");


?>

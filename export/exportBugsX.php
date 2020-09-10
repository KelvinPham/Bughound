<?php
    require "../authenticate_db.php"; // could be std if it doesn't need to be restricted to lvl 3 users
    require_once "../connect_db.php";

    $query = "SELECT * FROM bugs LEFT JOIN bugOptional ON bugs.bugOp_id = bugOptional.bugOp_id";

    $result = mysqli_query($conn,$query);
    $xml = new DOMDocument();
    // Root Node
    $xmlBugs = $xml->createElement("bugsTable");

    while($row=mysqli_fetch_array($result)) {
        
        // Name
        $xmlBugInfo = $xml->createElement("bugInfo");
        $xmlBugID = $xml->createElement("bugID");
        $xmlProgID = $xml->createElement("progID");
        $xmlBugType = $xml->createElement("bugType");
        $xmlSeverity = $xml->createElement("severity");
        $xmlSummary = $xml->createElement("summary");
        $xmlReproduce = $xml->createElement("reproduce");
        $xmlProblem = $xml->createElement("problem");
        $xmlSuggestFix = $xml->createElement("suggestFix");
        $xmlDiscoveredEmp = $xml->createElement("discoveredEmp");
        $xmlDiscoveredDate = $xml->createElement("discoveredDate");

        $xmlBugOpID = $xml->createElement("bugOpID");
        $xmlAreaID = $xml->createElement("areaID");
        $xmlAssignedEmp = $xml->createElement("assignedEmp");
        $xmlComments = $xml->createElement("comments");
        $xmlStatus = $xml->createElement("status");
        $xmlPriority = $xml->createElement("priority");
        $xmlResolution = $xml->createElement("resolution");
        $xmlResolutionVersion = $xml->createElement("resVersion");
        $xmlResolvedEmp = $xml->createElement("resolvedEmp");
        $xmlResolvedDate = $xml->createElement("resolvedDate");
        $xmlTestedEmp = $xml->createElement("testedEmp");
        $xmlTestedDate = $xml->createElement("testedDate");
        $xmlDeferred = $xml->createElement("deferred");


        // Hierarchy
        $xmlBugs->appendChild($xmlBugInfo);
        $xmlBugInfo->appendChild($xmlBugID);
        $xmlBugInfo->appendChild($xmlProgID);
        $xmlBugInfo->appendChild($xmlBugType);
        $xmlBugInfo->appendChild($xmlSeverity);
        $xmlBugInfo->appendChild($xmlSummary);
        $xmlBugInfo->appendChild($xmlReproduce);
        $xmlBugInfo->appendChild($xmlProblem);
        $xmlBugInfo->appendChild($xmlSuggestFix);
        $xmlBugInfo->appendChild($xmlDiscoveredEmp);
        $xmlBugInfo->appendChild($xmlDiscoveredDate);

        $xmlBugInfo->appendChild($xmlBugOpID);
        $xmlBugInfo->appendChild($xmlAreaID);
        $xmlBugInfo->appendChild($xmlAssignedEmp);
        $xmlBugInfo->appendChild($xmlComments);
        $xmlBugInfo->appendChild($xmlStatus);
        $xmlBugInfo->appendChild($xmlPriority);
        $xmlBugInfo->appendChild($xmlResolution);
        $xmlBugInfo->appendChild($xmlResolutionVersion);
        $xmlBugInfo->appendChild($xmlResolvedEmp);
        $xmlBugInfo->appendChild($xmlResolvedDate);
        $xmlBugInfo->appendChild($xmlTestedEmp);
        $xmlBugInfo->appendChild($xmlTestedDate);
        $xmlBugInfo->appendChild($xmlDeferred);

        // Value
        $xmlBugIDText = $xml->createTextNode($row['bug_id']);
        $xmlProgIDText = $xml->createTextNode($row['prog_id']);
        $xmlBugTypeText = $xml->createTextNode($row['bug_type']);
        $xmlSeverityText = $xml->createTextNode($row['severity']);
        $xmlSummaryText = $xml->createTextNode($row['summary']);
        $xmlReproduceText = $xml->createTextNode($row['reproduce']);
        $xmlProblemText = $xml->createTextNode($row['problem']);
        $xmlSuggestFixText = $xml->createTextNode($row['suggest_fix']);
        $xmlDiscoveredEmpText = $xml->createTextNode($row['emp_id']);
        $xmlDiscoveredDateText = $xml->createTextNode($row['dDate']);

        $xmlBugOpIDText = $xml->createTextNode($row['bugOp_id']); 
        $xmlAreaIDText = $xml->createTextNode($row['area_id']);
        $xmlAssignedEmpText = $xml->createTextNode($row['aEmp']);
        $xmlCommentsText = $xml->createTextNode($row['comments']);
        $xmlStatusText = $xml->createTextNode($row['status']);
        $xmlPriorityText = $xml->createTextNode($row['priority']);
        $xmlResolutionText = $xml->createTextNode($row['resolution']);
        $xmlResolutionVersionText = $xml->createTextNode($row['res_version']);
        $xmlResolvedEmpText = $xml->createTextNode($row['rEmp']);
        $xmlResolvedDateText = $xml->createTextNode($row['rDate']);
        $xmlTestedEmpText = $xml->createTextNode($row['tEmp']);
        $xmlTestedDateText = $xml->createTextNode($row['tDate']);
        $xmlDeferredText = $xml->createTextNode($row['deferred']);
        
        // Attaches value to its respective name node
        $xmlBugID->appendChild($xmlBugIDText);
        $xmlProgID->appendChild($xmlProgIDText);
        $xmlBugType->appendChild($xmlBugTypeText);
        $xmlSeverity->appendChild($xmlSeverityText);
        $xmlSummary->appendChild($xmlSummaryText);
        $xmlReproduce->appendChild($xmlReproduceText);
        $xmlProblem->appendChild($xmlProblemText);
        $xmlSuggestFix->appendChild($xmlSuggestFixText);
        $xmlDiscoveredEmp->appendChild($xmlDiscoveredEmpText);
        $xmlDiscoveredDate->appendChild($xmlDiscoveredDateText);

        $xmlBugOpID->appendChild($xmlBugOpIDText);
        $xmlAreaID->appendChild($xmlAreaIDText);
        $xmlAssignedEmp->appendChild($xmlAssignedEmpText);
        $xmlComments->appendChild($xmlCommentsText);
        $xmlStatus->appendChild($xmlStatusText);
        $xmlPriority->appendChild($xmlPriorityText);
        $xmlResolution->appendChild($xmlResolutionText);
        $xmlResolutionVersion->appendChild($xmlResolutionVersionText);
        $xmlResolvedEmp->appendChild($xmlResolvedEmpText);
        $xmlResolvedDate->appendChild($xmlResolvedDateText);
        $xmlTestedEmp->appendChild($xmlTestedEmpText);
        $xmlTestedDate->appendChild($xmlTestedDateText);
        $xmlDeferred->appendChild($xmlDeferredText);
    }
    $xml->appendChild($xmlBugs);
    $xml->save("bugs.xml");

    header("Location: ../maintain_db.php");
?>

<!-- Program the bug is associated with -->
<label for="program">Program</label>
<select id="program" name="program" required>
    <option value=""></option>
    <?php 
        // Query program table and get the name and id of each program
        // assign program name to value and text of each option
        require_once "../connect_db.php";
        $query = "SELECT * FROM programs";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_row($result)) {
            // Assigns id to value and displays the program name along with [release].[version]
            echo "<option value=\"".$row[0]."\" ";
            if(isset($bugData) && $bugData['prog_id'] == $row[0]) echo "selected=\"selected\"";
            echo ">".$row[1]." ".$row[2].".".$row[3]."</option>";
        }
    ?>
</select>
<!-- Bug Report Type (Enumerated) -->
<label for="rType">Report Type</label>
<select id="rType" name="rType" required>
    <option value=""></option>
    <option value="Coding Error" <?php if(isset($bugData) && ($bugData['bug_type'] == "Coding Error")) echo "selected=\"selected\""; ?>>Coding Error</option>
    <option value="Design Issue" <?php if(isset($bugData) && $bugData['bug_type'] == "Design Issue") echo "selected=\"selected\""; ?>>Design Issue</option>
    <option value="Suggestion" <?php if(isset($bugData) && $bugData['bug_type'] == "Suggestion") echo "selected=\"selected\""; ?>>Suggestion</option>
    <option value="Documentation" <?php if(isset($bugData) && $bugData['bug_type'] == "Documentation") echo "selected=\"selected\""; ?>>Documentation</option>
    <option value="Hardware" <?php if(isset($bugData) && $bugData['bug_type'] == "Hardware") echo "selected=\"selected\""; ?>>Hardware</option>
    <option value="Query" <?php if(isset($bugData) && $bugData['bug_type'] == "Query") echo "selected=\"selected\""; ?>>Query</option>
</select>
<!-- Severity of the bug (Enumerated) -->
<label for="severity">Severity</label>
<select id="severity" name="severity" required>
    <option value=""></option>
    <option value="Minor" <?php if(isset($bugData) && $bugData['severity'] == "Minor") echo "selected=\"selected\""; ?>>Minor</option>
    <option value="Serious" <?php if(isset($bugData) && $bugData['severity'] == "Serious") echo "selected=\"selected\""; ?>>Serious</option>
    <option value="Fatal" <?php if(isset($bugData) && $bugData['severity'] == "Fatal") echo "selected=\"selected\""; ?>>Fatal</option>
</select>
<!-- Attachments (Optional) -->
<label for="attachment">Attachments</label>
<!-- Indicates max file size of (MEDIUMBLOB) not sure if this is needed as it showed up in one of the guides -->
<!--<input type="hidden" name="MAX_FILE_SIZE" value=16,777,215/>--> 
<input type="file" name="attachment[]" id="attachment" multiple>
<br/><br/>
<!-- Short summary of the bug -->
<label for="rSum">Summary </label><input type="text" id="rSum" name="rSum" value="<?php if (isset($bugData)) echo $bugData['summary']; ?>" required>
<!-- If the bug is reproducible -->
<label for="reproduce">Reproducible? </label>
<select id="reproduce" name="reproduce" required>
    <option value=""></option>
    <option value=1 <?php if(isset($bugData) && $bugData['reproduce']) echo "selected=\"selected\""; ?>>Yes</option>
    <option value=0 <?php if(isset($bugData) && !$bugData['reproduce']) echo "selected=\"selected\""; ?>>No</option>
</select>
<br/><br/>
<!-- Main problem -->
<label for="rMain">Problem </label><textarea id="rMain" name="rMain" rows="4" cols="100%" required><?php if (isset($bugData)) echo $bugData['problem']; ?></textarea>
<br/><br/>
<!-- Suggested Fix for the bug (Optional) -->
<label for="sFix">Suggested Fix (Optional) </label><textarea id="sFix" name="sFix" rows="4" cols="100%"><?php if (isset($bugData)) echo $bugData['suggest_fix']; ?></textarea>
<br/><br/>
<!-- Employee who reported this bug -->
<label for="dEmployee">Reported By </label>
<select id="dEmployee" name="dEmployee" required>
    <option value=""></option>
    <?php
        // Queries employees table to fetch the name and if of each employee
        $eQuery = "SELECT emp_id, name FROM employees";
        $eResult = mysqli_query($conn, $eQuery);
        while($row = mysqli_fetch_row($eResult)) {
            // Assigns id to value and displays the employee name as an option
            echo "<option value=\"".$row[0]."\" ";
            if(isset($bugData) && $bugData['emp_id'] == $row[0]) echo "selected=\"selected\"";
            echo ">".$row[1]."</option>";
        }
        mysqli_data_seek($eResult, 0);  // resets pointer to the start of the result set for reuse
    ?>
</select>
<!-- Date of bug discovery -->
<label for="dDate">Date Discovered </label>
<input type="date" id="dDate" name="dDate" <?php if(isset($bugData)) echo "value=".$bugData['dDate']; ?> required>
<br/><br/>
<hr />
<!-- Optional section of the bug report. Form elements in this section are stored in a separate table-->
<h2>Optional Section</h2>
<!-- Area the program is associated with -->
<label for="area">Area </label>
<select id="area" name="area">
    <!-- Default option is blank to indicate it is optional -->
    <option value=NULL></option>
    <?php
        // Goal: Query areas table and only show selection that matches the prog_id selected in Programs
        $query = "SELECT * FROM areas";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_row($result)) {
            // Assigns the area name to both the value the displayed option
            echo "<option data-prog_id=\"".$row[1]."\" value=\"".$row[0]."\"";
            if(isset($bugData) && $bugData['area_id'] == $row[0]) echo "selected=\"selected\"";
            echo ">".$row[2]."</option>";
        }
    ?>
</select>
<!-- Employee assigned to handle the bug report -->
<label for="aEmployee">Assigned To </label>
<select id="aEmployee" name="aEmployee">
    <!-- Default option is blank to indicate it is optional -->
    <option value=NULL></option>
    <?php
        // Reuses a previous query result that fetched employee's id and name
        while($row = mysqli_fetch_row($eResult)) {
            // Assigns id to value and displays the employee name as an option
            echo "<option value=\"".$row[0]."\"";
            if(isset($bugData) && $bugData['aEmp'] == $row[0]) echo "selected=\"selected\"";
            echo ">".$row[1]."</option>";
        }
        mysqli_data_seek($eResult, 0);  // resets pointer to the start of the result set for reuse
    ?>
</select>
<br/><br/>
<!-- Brief description of how the bug was fixed -->
<label for="comments">Comments </label>
<textarea id="comments" name="comments" row="4" cols="100%"><?php if(isset($bugData)) echo $bugData['comments']; ?></textarea>
<br/><br/>
<!-- Current status of the bug -->
<label for="status">Status </label>
<select id="status" name="status">
    <option value="Open" <?php if(isset($bugData) && $bugData['status'] == "Open") echo "selected=\"selected\""; ?>>Open</option>
    <option value="Closed" <?php if(isset($bugData) && $bugData['status'] == "Closed") echo "selected=\"selected\""; ?>>Closed</option>
    <option value="Resolved" <?php if(isset($bugData) && $bugData['status'] == "Resolved") echo "selected=\"selected\""; ?>>Resolved</option>
</select>
<!-- Indicates the importance of solving the bug -->
<label for="priority">Priority </label>
<input type="number" id="priority" name="priority" min="0" max="6" value=<?php if(isset($bugData) && $bugData['priority'] != 0) echo $bugData['priority']; ?>> 
<!-- Current status -->
<label for="resolution">Resolution </label>
<select id="resolution" name="resolution">
    <option value=NULL></option>
    <option value="Pending" <?php if(isset($bugData) && $bugData['resolution'] == "Pending") echo "selected=\"selected\""; ?>>Pending</option>
    <option value="Fixed" <?php if(isset($bugData) && $bugData['resolution'] == "Fixed") echo "selected=\"selected\""; ?>>Fixed</option>
    <option value="Irreproducible" <?php if(isset($bugData) && $bugData['resolution'] == "Irreproducible") echo "selected=\"selected\""; ?>>Irreproducible</option>
    <option value="Deferred" <?php if(isset($bugData) && $bugData['resolution'] == "Deferred") echo "selected=\"selected\""; ?>>Deferred</option>
    <option value="As designed" <?php if(isset($bugData) && $bugData['resolution'] == "As designed") echo "selected=\"selected\""; ?>>As designed</option>
    <option value="Withdrawn by reporter" <?php if(isset($bugData) && $bugData['resolution'] == "Withdrawn by reporter") echo "selected=\"selected\""; ?>>Withdrawn by reporter</option>
    <option value="Need more information" <?php if(isset($bugData) && $bugData['resolution'] == "Need more information") echo "selected=\"selected\""; ?>>Need more information</option>
    <option value="Disagree with suggestion" <?php if(isset($bugData) && $bugData['resolution'] == "Disagree with suggestion") echo "selected=\"selected\""; ?>>Disagree with suggestion</option>
    <option value="Duplicate" <?php if(isset($bugData) && $bugData['resolution'] == "Duplicate") echo "selected=\"selected\""; ?>>Duplicate</option>
</select>
<!-- Indicates the number of times the bug report was updated (not sure if this should just be auto-incremented and thus should not be in the form) -->
<label for="resVer">Resolution Version</label>
<input type="number" id="resVer" name="resVer" min="0" max="6" value=<?php if(isset($bugData) && $bugData['res_version'] != 0) echo $bugData['res_version']; ?>>
<br/><br/>
<!-- Employee who resolved the bug -->
<label for="rEmployee">Resolved by </label>
<select id="rEmployee" name="rEmployee">
    <!-- Default option is blank to indicate it is optional -->
    <option value=NULL></option>
    <?php
        // Reuses a previous query result that fetched employee's id and name
        while($row = mysqli_fetch_row($eResult)) {
            // Assigns id to value and displays the employee name as an option
            echo "<option value=\"".$row[0]."\"";
            if(isset($bugData) && $bugData['rEmp'] == $row[0]) echo "selected=\"selected\"";
            echo ">".$row[1]."</option>";
        }
        mysqli_data_seek($eResult, 0);  // resets pointer to the start of the result set for reuse
    ?>
</select>
<!-- Date the bug was resolved -->
<label for="rDate">Date </label>
<input type="date" id="rDate" name="rDate" <?php if(isset($bugData)) echo "value=".$bugData['rDate']; ?>>
<br/><br/>
<label for="tEmployee">Tested by </label>
<select id="tEmployee" name="tEmployee">
    <!-- Default option is blank to indicate it is optional -->
    <option value=NULL></option>
    <?php
        // Reuses a previous query result that fetched employee's id and name
        while($row = mysqli_fetch_row($eResult)) {
            // Assigns id to value and displays the employee name as an option
            echo "<option value=\"".$row[0]."\"";
            if(isset($bugData) && $bugData['tEmp'] == $row[0]) echo "selected=\"selected\"";
            echo ">".$row[1]."</option>";
        }
        mysqli_close($conn);
    ?>
</select>
<!-- Date the bug fix was tested -->
<label for="tDate">Date </label>
<input type="date" id="tDate" name="tDate" <?php if(isset($bugData)) echo "value=".$bugData['tDate']; ?>>
<!-- Indicates if the bug fix was deferred or not -->
<label for="deferred">Deferred </label>
        <select id="deferred" name="deferred">
            <option value=NULL></option>
            <option value=1 <?php if(isset($bugData) && $bugData['deferred']) echo "selected=\"selected\""; ?>>Yes</option>
            <option value=0 <?php if(isset($bugData) && $bugData['deferred']) echo "selected=\"selected\""; ?>>No</option>
        </select>
<br/><br/>
<br/><br/>
<input type="submit" name="submit" value="Submit">
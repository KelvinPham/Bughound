$(document).ready(function() {
    // Add area validation
    $('form[name="addArea"]').submit(function(e) {
        if($('#addAreaInput').val() == "") {
            alert ("Area field must contain characters");
            return false;
        }
        alert ("Added " + $('#addAreaInput').val() + " successfully!");
    });

    // Update area validation not working
    $('form[name="updateArea"]').submit(function(e) {
        var areaInput = $(this).find('input[name="area"]').val();
        if(areaInput === NULL) {
            alert ("Area field must contain characters");
            return false;
        }
        else {
            alert ("Updated successfully!");
        }
    });

    // Confirms deleting
    $('form[name="deleteArea"]').submit(function(e) {
        return confirm("Are you sure you want to delete this area?");
    });

    // Confirms exporting data
    $('form[name="exportData"]').submit(function(e) {
        alert("Exported " + $("#tableName").val() + " in " + $("#format").val() + " successfully!");
    });
    
    $("#eButton").click(function() {
        window.location.replace("../areas/areas.php");
    }); 
    
    $("#hButton").click(function() {
        window.location.replace("../maintain_db.php");
    }); 
});
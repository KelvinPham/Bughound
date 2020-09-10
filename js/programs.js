$(document).ready(function() {
    $("#addProgram").submit(function() {
        if($("#pName").val() == ""){
            alert ("Program field must contain characters");
            return false;
        }
        if($("#pRelease").val() === ""){
            alert ("Program Release field must contain a number");
            return false;
        }
        if($("#pVersion").val() === ""){
            alert ("Program Version field must contain a number");
            return false;
        }
        alert($('#pName').val() + " program added successfully!");
    });

    $("#updateProgram").submit(function() {
        alert("Updated " + $("#pName").val() + " successfully!");
    });

    // Confirms deleting
    $('form[name="deleteProgram"]').submit(function(e) {
        return confirm("Are you sure you want to delete this program?");
    });

    $("#hButton").click(function() {
        window.location.replace("../maintain_db.php");
    }); 
});
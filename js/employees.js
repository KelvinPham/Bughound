$(document).ready(function() {
    $("#addEmployee").submit(function(e) {
        if($("#name").val() === ""){
            alert ("Name field must contain characters");
            return false;
        }
        if($("#user").val() === ""){
            alert ("Username field must contain characters");
            return false;
        }
        if($("#pwd").val() === ""){
            alert ("Password field must contain characters");
            return false;
        }
        if($("#uLvl").val() === ""){
            alert("User Level field must contain digits");
            return false;
        }
        alert("Added " + $("#name").val() + " successfully!");
    });

    $("#updateEmployee").submit(function() {
        alert("Updated " + $("#name").val() + " successfully!");
    });

    // Confirms deleting
    $('form[name="deleteEmployee"]').submit(function(e) {
        return confirm("Are you sure you want to delete this employee?");
    });

    $("#eButton").click(function() {
        window.location.replace("employees.php");
    }); 

    $("#hButton").click(function() {
        window.location.replace("../maintain_db.php");
    }); 
});

$(document).ready(function() {
    // Detects when the program option changes and only shows area options that match the prog_id
    $("#program").change(function() {
        $("#area option").hide();
        $("#area option[data-prog_id=\"" + $(this).val() + "\"]").show();
    });

    // Confirms deleting
    $('form[name="deleteBug"]').submit(function(e) {
        return confirm("Are you sure you want to delete this bug?");
    });

    // Returns to start page when exiting search or adding new bugs
    $("#hButton").click(function() {
        window.location.replace("../start_page.php");
    }); 

    // Return to search
    $("#cButton").click(function() {
        window.location.replace("../bugs/searchBug.php");
    }); 
});
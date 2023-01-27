// Wait for the document to be fully loaded
$(document).ready(function() {
    // Add event listener for submit button
    $("#submit-form").on("submit", function(e) {
        // Prevent the default form submission
        e.preventDefault();
        // Get the values of the form inputs
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        // Validate the form inputs
        if(name === "" || email === "" || password === "") {
            alert("Please fill in all fields");
        } else {
            // Send a post request to the server with the form data
            $.post("submit.php", { name: name, email: email, password: password }, function(data) {
                // Check if the submission was successful
                if(data === "success") {
                    alert("Your submission was successful!");
                } else {
                    alert("An error occurred. Please try again later.");
                }
            });
        }
    });
});



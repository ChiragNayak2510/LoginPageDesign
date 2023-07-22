$(document).ready(function() {
    // Handle form submission
    $("#registerForm").submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Get the form data (username and password)
        var formData = {
            username: $("#username").val(),
            password: $("#password").val()
        };

        // Send the data using a POST request
        $.ajax({
            type: "POST",
            url: "register.php",
            data: formData,
            success: function(response) {
                // Handle the server response
                console.log(response); // You can do something with the response if needed
                // For example, display a success message or redirect the user to another page.
            },
            error: function(xhr, status, error) {
                // Handle any errors that occurred during the request
                console.error("Error occurred: " + error);
            }
        });
    });
});

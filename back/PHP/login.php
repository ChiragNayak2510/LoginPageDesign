<?php
// Start the session (if not already started)
session_start();
require_once "config.php";

// Check if the form is submitted
$jsonData = file_get_contents('php://input');

// Decode the JSON data into an associative array
$requestData = json_decode($jsonData, true);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a MySQL database connection already established.

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the email and password from the form
    $email = $requestData['email'];
    $password = $requestData['password'];

    // Hash the password (assuming you are storing hashed passwords in the database)
    $hashed_password = sha1($password);
    $_SESSION['signed_in'] = false;
    // Prepare the SQL query to check the credentials
    $stmt = $conn->prepare("SELECT * FROM userprofile WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $hashed_password);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                // Authentication successful, store the user details in the session
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['contact'] = $row['contact'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['signed_in'] = true;

                // Redirect to the profile page
            } else {
                echo '
                <script>
                    window.alert("Invalid username and password");
                    setTimeout(()=>{
                        window.location.href = "http://localhost:8080/dashboard/Login%20page/front/HTML/login.html";
                    },100);
                </script>';
            }

            mysqli_free_result($result);
        }
    } else {
        echo "Something went wrong with the query execution.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

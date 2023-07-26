<?php
require_once "config.php";

$jsonData = file_get_contents('php://input');

// Decode the JSON data into an associative array
$requestData = json_decode($jsonData, true);

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if username is empty
    if (empty(trim($requestData['email']))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM userprofile WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($requestData['email']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $name = trim($requestData['name']);
                    $email = trim($requestData['email']);
                    $contact = trim($requestData['contact']);
                    $age = trim($requestData['age']);
                }
            } else {
                echo "Something went wrong";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($requestData['password']))) {
        $password_err = "Password cannot be blank";
    } else if (strlen(trim($requestData['password'])) < 5) {
        $password_err = "Password can not be less than 5 characters";
    } else {
        $password = trim($requestData['password']);
        $hashed_password = sha1($password);
    }
    if (empty($username_err) && empty($password_err)) {
        $stmt = $conn->prepare("INSERT INTO userprofile (name, email, password, contact, age) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, $hashed_password, $contact, $age);

        if ($stmt->execute()) {
            // Successfully inserted data, redirect to login page
            header("Location:http://localhost:8080/dashboard/Login%20page/LoginPageDesign/front/HTML/login.html");
            exit;
        } else {
            echo "Something went wrong while inserting data.";
        }
        $stmt->close();
    }

    mysqli_close($conn);
}
?>

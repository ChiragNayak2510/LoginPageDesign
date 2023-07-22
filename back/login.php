<?php
// Start the session (if not already started)

session_start();

// Check if the user is already logged in. If so, redirect to the profile page.
// if (isset($_SESSION['username'])) {
//     // header('Location:http://localhost:8080/dashboard/Login%20page/front/profile.html');
//     exit;
// }



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a MySQL database connection already established.
    require_once "config.php";

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the username and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform any validation or sanitization of user input if needed

    // Hash the password (assuming you are storing hashed passwords in the database)
    $hashed_password = sha1($password);

    // Prepare the SQL query to check the credentials
    $sql = "SELECT * FROM userprofile WHERE email = '$email' AND password = '$hashed_password'";

    // Execute the query
    $result = mysqli_query($conn, $sql);
    $signed_in = false;
    $myname;
    $myemail;
    $mypass;
    $mycontact;
    $myage;

if ($result) {
    while ($obj = mysqli_fetch_object($result)) {
        $myname = $obj->name;
        $myemail = $obj->email;
        $mypass = $obj->password;
        $mycontact = $obj->contact;
        $myage = $obj->age;
        $signed_in = true;
        $_SESSION['name'] = $myname;
        $_SESSION['email']= $myemail;
        $_SESSION['password']= $mypass;
        $_SESSION['contact']= $mycontact;
        $_SESSION['age']= $myage;
        $_SESSION['signed_in'] = $signed_in;
    }
    mysqli_free_result($result);
    header('Location:http://localhost:8080/dashboard/Login%20page/front/profile.php');
    // echo`<script>console.log("hi")</script>`;
  }

    

    // Check if the query returned any rows (i.e., the credentials are correct)
    // if (mysqli_num_rows($result) === 1) {
    //     // Authentication successful, store the username in the session and redirect to profile.html
    //     // $_SESSION['username'] = $username;
    //     // $sql = "SELECT username,password FROM users where username='$username'";
    //     // $result = mysqli_query($conn,$sql);
    // //     echo `
    // //     <script>
    // //     window.alert("VAlid username and password");
    // //     setTimeout(()=>{
    // //         window.location.href = "https://google.com";
    // //     },1000000);
    // // </script>';`;
    // $gay;   
    // $result.toRelaxedExtendedJSON($gay);
    //     header(`Location:$gay`);


    // } else {
    //     echo '
    //     <script>
    //         window.alert("Invalid username and password");
    //         setTimeout(()=>{
    //             window.location.href = "http://localhost:8080/dashboard/Login%20page/front/login.html";
    //         },100);
    //     </script>';
    //     // header('Location:http://localhost:8080/dashboard/Login%20page/front/login.html');
    // }
    mysqli_close($conn);
}
?>

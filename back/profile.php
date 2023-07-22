<?php
    require_once "config.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        //Check if username is empty
        if(empty(trim($_POST["email"]))){
            $username_err = "Email cannot be blank";
        }
        else{
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $contact = trim($_POST["contact"]);
            $age = trim($_POST["age"]);

            $sql = "UPDATE userprofile SET name='$name',contact='$contact',age='$age' WHERE email='$email'";
            if (mysqli_query($conn, $sql)) {
                echo '
                    <script>
                        window.alert("Changes updated successfully!Login to see changes");
                        setTimeout(()=>{
                            window.location.href = "http://localhost:8080/dashboard/Login%20page/front/login.html";
                        },100);
                    </script>';
              } else {
                echo "Error updating record: " . mysqli_error($conn);
              }
            }
    }
    ?>
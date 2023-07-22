<?php
    require_once "config.php";

    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        //Check if username is empty
        if(empty(trim($_POST["email"]))){
            $username_err = "Username cannot be blank";
        }
        else{
            $sql = "SELECT id FROM userprofile WHERE email = ?";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,"s",$param_username);

                //Set the value of param_username
                $param_username = trim($_POST['email']);

                //Try to execute this statement
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $username_err = "This username is already taken";
                    }
                    else{
                        $name = trim($_POST['name']);
                        $email = trim($_POST['email']);
                        $contact = trim($_POST['contact']);
                        $age = trim($_POST['age']);
                    }
                }
                else{
                    echo "Something went wrong";
                }
            }
        }
        mysqli_stmt_close($stmt);

        if(empty(trim($_POST['password']))){
            $password_err = "Password cannot be blank";
        }
        else if(strlen(trim($_POST['password']))<5){
            $password_err = "Password can not be less than 5 characters";
        }
        else{
            $password = trim($_POST['password']);
            $hashed_password = sha1($password);
        }

        if(empty($username_err) && empty($password_err)){
            $sql = "INSERT INTO userprofile(name,email,password,contact,age) VALUES ('$name','$email','$hashed_password','$contact','$age')";
            mysqli_query($conn,$sql);
            header("Location:http://localhost:8080/dashboard/Login%20page/front/login.html");
                //Try to execeute query
            }
            mysqli_close($conn);
        }
    ?>
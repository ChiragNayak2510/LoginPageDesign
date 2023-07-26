<?php
    require_once "config.php";
    $jsonData = file_get_contents('php://input');
    $requestData = json_decode($jsonData, true);

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        //Check if username is empty
        if(empty(trim($requestData['email']))){
            $username_err = "Email cannot be blank";
        }
        else{
            $name = trim($requestData["name"]);
            $email = trim($requestData["email"]);
            $contact = trim($requestData["contact"]);
            $age = trim($requestData["age"]);

            $stmt = $conn->prepare("UPDATE userprofile SET name= ?,contact= ?,age= ? WHERE email= ?");
            $stmt->bind_param("ssis",$name,$contact,$age,$email);
            if ($stmt->execute()) {
                echo '
                    <script>
                        window.alert("Changes updated successfully!Login to see changes");
                        setTimeout(()=>{
                            window.location.href = "http://localhost:8080/dashboard/Login%20page/LoginPageDesign/front/HTML/login.html";
                        },100);
                    </script>';
              } else {
                echo "Error updating record: " . mysqli_error($conn);
              }
            }
    }
    ?>
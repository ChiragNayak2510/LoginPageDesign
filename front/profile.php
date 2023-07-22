<?php
    session_start();
    $signed_in = $_SESSION['signed_in'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $contact = $_SESSION['contact'];
    $age = $_SESSION['age'];
    if($signed_in==false)
        header("Location:http://localhost:8080/dashboard/Login%20page/front/register.html");
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <div class="container-fluid ps-md-0">
        <div class="row g-0">
          <div class="left d-none d-md-flex col-md-5 bg-image">
              <img id="image" src="register.png" alt="Profile" height="500px" width="600px">
          </div>
          <div class="right col-md-7 col-lg-7">
            <div class="login d-flex align-items-center py-5">
              <div class="container">
                <div class="row1">
                  <div class="col-md-9 col-lg-8 mx-auto">
                    <h4>Know Yourself</h4>
                    <h3 class="login-heading mb-4"></h3>
                    <!-- Profile -->
                    <form action="http://localhost:8080/dashboard/Login%20page/back/profile.php" method="post">
                      <div class="form">
                        <input name="name" type="text" class="form-control" id="data" placeholder="Name: " value=" <?php echo $name; ?>">
                        <label for="floatingInput"></label>
                      </div>
                      <div class="form mb-1">
                        <input name = "email" type="email" class="form-control sox" id="data" value=" <?php echo $email; ?>">
                        <label for="floatingPassword"></label>
                      </div>
      
                      <div class="form mb-1">
                          <input name = "contact" type="tel" class="form-control sox" id="data" value=" <?php echo $contact; ?>">
                          <label for="floatingPassword"></label>
                        </div>
      
                        <div class="form mb-1">
                          <input name="age" type="tel" class="form-control sox" id="data" value=" <?php echo $age; ?>">
                          <label for="floatingPassword"></label>
                        </div>
      
                      <div class="button">
                        <button class="btn btn-btn-lg-dark btn-login fw-bold mb-2 text-white" type="submit">Save</button>
                      </div>
                      <div class="logout_redirect">
                              <a href="http://localhost:8080/dashboard/Login%20page/back/logout.php">Logout</a>
                          </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>

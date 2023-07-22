<?php
session_start();
session_destroy();
header('Location:http://localhost:8080/dashboard/Login%20page/front/login.html');
exit;
?>
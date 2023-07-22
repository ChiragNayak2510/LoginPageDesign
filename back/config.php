<?php
/*  
    Database configuration
    Author : Chirag Nayak
    User = "root" Pw = ""
*/

    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "webapp";


    $conn = mysqli_connect($servername,$username,$password,$dbname);


    //Check connection
    if($conn == false){
        dir('Error : Cannot connect');
    }
?>
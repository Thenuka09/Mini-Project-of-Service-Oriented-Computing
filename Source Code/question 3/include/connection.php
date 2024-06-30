<?php 

    $host = "localhost";
    $username = "root";
    $password ="";
    $dbname = "restful";

    $connection = mysqli_connect($host , $username , $password , $dbname);

    if(!$connection){
        die("connection Failed " . mysqli_connect_error());

        // mysqli_connect_error() --> display the what type of error 
    }

?>
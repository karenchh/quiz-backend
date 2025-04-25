<?php // declare it as a php file
include 'connection.php';
//Check if they are valid 
if (isset($_POST["name"],$_POST["lastname"],$_POST["email"],$_POST["password"])){
    //Retriving the name , lastname, email and password from url by get statment
    $username = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
}




<?php
include 'connection.php';

if (isset($_POST["email"],$_POST["password"])){
    //Retriving email and password from url by post statment
    $email = $_POST["email"];
    $password = $_POST["password"];

    
}
else{
    echo json_encode(["message" => "login failed missing credintials."]);
}
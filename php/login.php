<?php
include 'connection.php';

if (isset($_POST["email"],$_POST["password"])){
    //Retriving email and password from url by post statment
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $connection->prepare("SELECT * FROM users WHERE email = :email");

    $query->bindValue(":email", $email, PDO::PARAM_STR);  // Binding the email to the email to prevent sql injection
        
    $query->execute();
}
else{
    echo json_encode(["message" => "login failed missing credintials."]);
}
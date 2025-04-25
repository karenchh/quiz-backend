<?php
include 'connection.php';

if (isset($_POST["email"],$_POST["password"])){
    //Retriving email and password from url by post statment
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $connection->prepare("SELECT * FROM users WHERE email = :email");

    $query->bindValue(":email", $email, PDO::PARAM_STR);  // Binding the email to the email to prevent sql injection
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);
    if($user == true && $user["password"] === $password){   // if the user exists check the password
        if($user["email"] === "admin@quiz.com" && $user["password"] === 'admin123'){
            echo json_encode(["message" => "You are an admin"]); // must be directed to the dashboard
        }
        else{
            echo json_encode(["message" => "Logged in successfully"]); // must be redirected to the index.html home page
        }
    }
    else{
        echo json_encode(["message" => "User doesn't exist please sign up and try to login again"]); // or invalid email and password
    }
}
else{
    echo json_encode(["message" => "login failed missing credintials."]);
}
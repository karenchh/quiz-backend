<?php // declare it as a php file
include 'connection.php';
//Check if they are valid 
if (isset($_POST["name"],$_POST["lastname"],$_POST["email"],$_POST["password"])){
    //Retriving the name , lastname, email and password from url by get statment
    $username = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $connection->prepare("SELECT * FROM users WHERE email = :email AND password = :password");

    $query->bindValue(":email", $email, PDO::PARAM_STR);  // Binding the email to the email to prevent sql injection
    $query->bindValue(":password", $password, PDO::PARAM_CHAR); 
        
        
    
        
    
}




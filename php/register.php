<?php // declare it as a php file
include 'connection.php';
//Check if they are valid 
if (isset($_POST["name"],$_POST["lastname"],$_POST["email"],$_POST["password"])){
    //Retriving the name , lastname, email and password from url by post statment
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $connection->prepare("SELECT * FROM users WHERE email = :email");

    $query->bindValue(":email", $email, PDO::PARAM_STR);  // Binding the email to the email to prevent sql injection
        
    $query->execute();

    // change the returned array from the execution to an associative array that php understands
    // fetch returns each array but it points only for one array that's why we need a loop
    // In my opinion we don't need to fetch all since it is not allowed to have multiple rows with same email and pass
    // so if it exists we will not insert it again it will not be doubled 
    $user = $query->fetch(PDO::FETCH_ASSOC); 

    if($user == true){   // if the user exists
        echo json_encode(["message" => "Email already exists"]);
    }
    else{
        $insertuserquery = $connection->prepare("INSERT INTO users (name,last_name,email,password) VALUES (:name,:lastname,:email,:password)");
        $insertuserquery->bindValue(":name", $name, PDO::PARAM_STR);
        $insertuserquery->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        $insertuserquery->bindValue(":email", $email, PDO::PARAM_STR);
        $insertuserquery->bindValue(":password", $password, PDO::PARAM_STR);
        $insertuserquery->execute();
    }
}
else {
    echo json_encode(["message" => "Registration failed invalid credintials."]);
}




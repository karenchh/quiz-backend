<?php
include 'connection.php';
$quiz_id = $_GET["id"];

if (isset($_POST["title"],$_POST["description"])){
    //Retriving title and description from url by get statment
    $title = $_POST["title"];
    $description = $_POST["description"];

    $query = $connection->prepare("UPDATE quizzes SET title = :title , description = :description WHERE id = :id");

    $query->bindValue(":title", $title ,PDO::PARAM_STR);
    $query->bindValue(":description", $description ,PDO::PARAM_STR);
    $query->bindValue(":id", $quiz_id ,PDO::PARAM_INT);

    $query->execute();

    echo json_encode(["message" => "Quiz is updated successfully"]);
}
else{
    echo json_encode(["message" => "Quiz update failed"]);
}

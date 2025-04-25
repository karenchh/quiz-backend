<?php
include 'connection.php';
$quiz_id = $_GET["id"];

if (isset($_POST["title"],$_POST["description"])){
    //Retriving title and description from url by get statment
    $title = $_POST["title"];
    $description = $_POST["description"];
    $query = $connection->prepare("DELETE FROM quizzes WHERE id = :id");

    $query->bindValue(":id", $quiz_id ,PDO::PARAM_INT);

    $query->execute();
}
else{
    echo json_encode(["message" => "Quiz update failed"]);
}
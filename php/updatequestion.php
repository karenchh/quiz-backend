<?php
include 'connection.php';

if (isset($_GET["quiz_id"],$_GET["id"],$_GET["question_text"])){
    //Retriving title and description from url by get statment
    $quiz_id = $_GET["quiz_id"];
    $id = $_GET["id"];
    $question_text = $_GET["question_text"];

    $query = $connection->prepare("UPDATE questions SET question_text = :question_text WHERE quiz_id = :quiz_id AND id = :id");
    $query->bindValue(":question_text", $question_text ,PDO::PARAM_STR);
    $query->bindValue(":quiz_id", $quiz_id ,PDO::PARAM_INT);
    $query->bindValue(":id", $id ,PDO::PARAM_INT);

    $query->execute();

    echo json_encode(["message" => "Question is updated successfully"]);
}
else{
    echo json_encode(["message" => "Question update failed"]);
}

<?php
include 'connection.php';
$quiz_id = $_GET["quiz_id"];
$id = $_GET["id"];
$query = $connection->prepare("DELETE FROM questions WHERE quiz_id = :quiz_id AND id = :id");
$query->bindValue(":quiz_id", $quiz_id ,PDO::PARAM_INT);
$query->bindValue(":id", $id ,PDO::PARAM_INT);
$query->execute();

echo json_encode(["message" => "Question is deleted successfully"]);

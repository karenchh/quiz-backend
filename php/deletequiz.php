<?php
include 'connection.php';

$quiz_id = $_GET["id"];
$query = $connection->prepare("DELETE FROM quizzes WHERE id = :id");
$query->bindValue(":id", $quiz_id ,PDO::PARAM_INT);
$query->execute();

echo json_encode(["message" => "Quiz is deleted successfully"]);

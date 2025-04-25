<?php
include 'connection.php';
$quiz_id = $_GET["id"];
$query = $connection->prepare("SELECT title, description FROM quizzes WHERE id = :id");

$query->bindValue(":id", $id ,PDO::PARAM_INT);

$query->execute();

$quiz = $query->fetch(PDO::FETCH_ASSOC);
// since quiz id is unique

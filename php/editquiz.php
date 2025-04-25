<?php
include 'connection.php';
$quiz_id = $_GET["id"];
$query = $connection->prepare("SELECT * FROM quizzes WHERE id = :id");

$query->bindValue(":id", $id ,PDO::PARAM_STR);

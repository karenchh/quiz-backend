<?php
include 'connection.php';

if (isset($_GET["title"],$_GET["description"])){
    //Retriving title and description from url by get statment
    $title = $_GET["title"];
    $description = $_GET["description"];

    $query = $connection->prepare("INSERT INTO quizzes (title,description) VALUES (:title,:description)");

    $query->bindValue(":title", $title ,PDO::PARAM_STR);
    $query->bindValue(":description", $description ,PDO::PARAM_STR);

    $query->execute();
}

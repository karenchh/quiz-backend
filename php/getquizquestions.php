<?php
include 'connection.php';
if (isset($_GET["quiz_id"])) {
    // Retrieving quiz_id from GET 
    $quiz_id = $_GET["quiz_id"];
    $getquery = $connection->prepare("SELECT * FROM questions WHERE quiz_id = :quiz_id");
    $getquery->execute();

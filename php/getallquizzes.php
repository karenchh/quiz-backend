<?php
include 'connection.php';

$getquery = $connection->prepare("SELECT * FROM quizzes");
$getquery->execute();

$result = [];

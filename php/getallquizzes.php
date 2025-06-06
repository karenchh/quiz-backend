<?php
include 'connection.php';

$getquery = $connection->prepare("SELECT * FROM quizzes");
$getquery->execute();

$result = [];
//Creating empty array since fetch points only to one row array and this query will retrieve more than one row/record
while($quiz = $getquery->fetch(PDO::FETCH_ASSOC)){
    $result [] = $quiz; // pushing to the array results
}
echo json_encode($result);
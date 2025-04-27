<?php
include 'connection.php';
if (isset($_GET["quiz_id"])) {
    // Retrieving quiz_id from GET 
    $quiz_id = $_GET["quiz_id"];
    $getquery = $connection->prepare("SELECT question_text FROM questions WHERE quiz_id = :quiz_id");
    $getquery->bindValue(":quiz_id", $quiz_id ,PDO::PARAM_INT);
    $getquery->execute();

    $result = [];
    //Creating empty array since fetch points only to one row array and this query will retrieve more than one row/record
    while($question = $getquery->fetch(PDO::FETCH_ASSOC)){
        $result [] = $question; // pushing to the array results
    }
echo json_encode($result);
}
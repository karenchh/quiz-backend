<?php
include 'connection.php';

if (isset($_GET["question_id"])) {
    // Retrieve question_id from GET request
    $question_id = $_GET["question_id"];

    // Prepare SQL query to get all answers for the given question_id
    $query = $connection->prepare("SELECT id, answer_text, is_correct FROM answers WHERE question_id = :question_id");

    // Bind the question_id to the SQL statement
    $query->bindValue(":question_id", $question_id, PDO::PARAM_INT);

    // Execute the query
    $query->execute();

    // Check if any rows are returned
    if ($query->rowCount() > 0) {
        $answers = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["answers" => $answers]); // Return answers as JSON
    } else {
        echo json_encode(["message" => "No answers found for this question"]);
    }
} else {
    echo json_encode(["message" => "Missing question_id"]);
}
<?php
include 'connection.php';

// Check if quiz_id is provided via GET request
if (isset($_GET["quiz_id"])) {
    // Retrieve quiz_id from GET request
    $quiz_id = $_GET["quiz_id"];

    // Query to get user details, quiz title, and score for a specific quiz
    $query = $connection->prepare("
        SELECT u.name, u.email, q.title AS quiz_title, s.score
        FROM scores s
        JOIN users u ON s.user_id = u.id  -- Join users table on user_id
        JOIN quizzes q ON s.quiz_id = q.id  -- Join quizzes table on quiz_id
        WHERE s.quiz_id = :quiz_id
        ORDER BY u.name
    ");

    // Bind the quiz_id parameter to the query
    $query->bindValue(":quiz_id", $quiz_id, PDO::PARAM_INT);

    // Execute the query
    $query->execute();

    // Check if any rows are returned
    if ($query->rowCount() > 0) {
        $scores = $query->fetchAll(PDO::FETCH_ASSOC);

        // Return the data as a JSON object
        echo json_encode(["scores" => $scores]);
    } else {
        echo json_encode(["message" => "No scores found for this quiz"]);
    }
} else {
    echo json_encode(["message" => "Missing quiz_id"]);
}

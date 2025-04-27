<?php
include 'connection.php';

// Check if quiz_id, user_id, and answers are provided
if (isset($_POST["quiz_id"], $_POST["user_id"], $_POST["answers"])) {
    $quiz_id = $_POST["quiz_id"];
    $user_id = $_POST["user_id"];
    $answers = $_POST["answers"];  // This should be an associative array with question_id => user_answer

    // Query to get the correct answers for the quiz
    $query = $connection->prepare("SELECT q.id AS question_id, a.id AS answer_id, a.is_correct
                                   FROM questions q
                                   JOIN answers a ON q.id = a.question_id
                                   WHERE q.quiz_id = :quiz_id");
    $query->bindValue(":quiz_id", $quiz_id, PDO::PARAM_INT);
    $query->execute();
    
    $correct_answers = [];
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        // Store correct answers
        $correct_answers[$row['question_id']] = $row['is_correct'];
    }

    // Calculate the score
    $score = 0;
    foreach ($answers as $question_id => $user_answer) {
        // Check if user's answer matches the correct answer
        if ($correct_answers[$question_id] == $user_answer) {
            $score++;
        }
    }

    // Check if the user already has a score for this quiz
    $query_check_score = $connection->prepare("SELECT * FROM scores WHERE quiz_id = :quiz_id AND user_id = :user_id");
    $query_check_score->bindValue(":quiz_id", $quiz_id, PDO::PARAM_INT);
    $query_check_score->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    $query_check_score->execute();

    // If score already exists, update it, else insert a new record
    if ($query_check_score->rowCount() > 0) {
        $query_update_score = $connection->prepare("UPDATE scores SET score = :score WHERE quiz_id = :quiz_id AND user_id = :user_id");
        $query_update_score->bindValue(":score", $score, PDO::PARAM_INT);
        $query_update_score->bindValue(":quiz_id", $quiz_id, PDO::PARAM_INT);
        $query_update_score->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $query_update_score->execute();

        echo json_encode(["message" => "Score updated successfully", "score" => $score]);
    } else {
        $query_insert_score = $connection->prepare("INSERT INTO scores (quiz_id, user_id, score) VALUES (:quiz_id, :user_id, :score)");
        $query_insert_score->bindValue(":score", $score, PDO::PARAM_INT);
        $query_insert_score->bindValue(":quiz_id", $quiz_id, PDO::PARAM_INT);
        $query_insert_score->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $query_insert_score->execute();

        echo json_encode(["message" => "Score recorded successfully", "score" => $score]);
    }
} else {
    echo json_encode(["message" => "Missing required data"]);
}

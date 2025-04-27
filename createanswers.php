<?php
include 'connection.php';

if (isset($_GET["id"], $_GET["answer_text"], $_GET["is_correct"])) {
    $id = $_GET["id"];
    $answer_text = $_GET["answer_text"];
    $is_correct = $_GET["is_correct"];

    $query = $connection->prepare("UPDATE answers SET answer_text = :answer_text, is_correct = :is_correct WHERE id = :id");

    $query->bindValue(":answer_text", $answer_text, PDO::PARAM_STR);
    $query->bindValue(":is_correct", $is_correct, PDO::PARAM_INT);
    $query->bindValue(":id", $id, PDO::PARAM_INT);

    if ($query->execute()) {
        echo json_encode(["message" => "Answer updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update answer"]);
    }
} else {
    echo json_encode(["message" => "Missing input"]);
}

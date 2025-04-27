    <?php
    include 'connection.php';
    
    if (isset($_GET["quiz_id"], $_POST["question_text"])) {
        // Retrieving quiz_id and question_text from GET and POST
        $quiz_id = $_GET["quiz_id"];
        $question_text = $_POST["question_text"];
    
        $query = $connection->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)");
    
        $query->bindValue(":quiz_id", $quiz_id ,PDO::PARAM_INT);
        $query->bindValue(":question_text", $question_text ,PDO::PARAM_STR);
    
        $query->execute();
    
        echo json_encode(["message" => "Question created successfully"]);
    } else {
        echo json_encode(["message" => "Question not created, please make sure you didn't miss any input"]);
    }

    
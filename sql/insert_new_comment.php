<?php
    // Get parameters from POST
    session_start();
    $user_ID = $_SESSION['user_id'];
    $post_ID = $_POST['post_id'];
    $commentText = $_POST['comment'];

    // SQL statement to insert new user
    $sql = "INSERT INTO Comments (user_ID, post_ID, commentText) 
                VALUES (:user_ID, :post_ID, :commentText)";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':user_ID', $user_ID);
    $statement->bindvalue(':post_ID', $post_ID);
    $statement->bindvalue(':commentText', $commentText);
?>
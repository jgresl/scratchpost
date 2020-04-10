<?php
    // Get parameters from POST
    $post_ID = $_POST['post_id'];
    $postStatus = $_POST['post_status'];

    // SQL statement to insert new user
    $sql = "UPDATE Post SET postStatus = :postStatus WHERE post_ID = :post_ID";
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':postStatus', $postStatus);
    $statement->bindvalue(':post_ID', $post_ID);
?>
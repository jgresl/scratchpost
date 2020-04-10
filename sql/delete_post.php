<?php
    // Get parameters from POST
    $post_ID = $_POST['post_id'];

    // SQL statement to delete scratches
    $sql = "DELETE FROM Scratches WHERE post_ID = :post_ID";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':post_ID', $post_ID);

    // Execute prepared SQL statement
    $statement->execute();

    // SQL statement to comments
    $sql = "DELETE FROM Comment WHERE post_ID = :post_ID";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':post_ID', $post_ID);

    // Execute prepared SQL statement
    $statement->execute();

    // SQL statement to post
    $sql = "DELETE FROM Post WHERE post_ID = :post_ID";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':post_ID', $post_ID);
?>
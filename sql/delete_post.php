<?php
    // Get parameters from POST
    $post_ID = $_POST['post_id'];

    // SQL statement to delete a psot
    $sql = "DELETE FROM Post WHERE post_ID = :post_ID";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':post_ID', $post_ID);
?>
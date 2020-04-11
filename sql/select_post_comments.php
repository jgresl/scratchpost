<?php
    // Get parameters from GET
    $post_ID = $_GET['post_id'];

    // Prepared SQL statement to return all comments for a single post
    $sql = "SELECT userName, commentText, commentDate, commentStatus FROM Comments
            INNER JOIN Post ON Post.post_ID = Comments.post_ID AND Post.post_ID = :post_ID
            INNER JOIN User ON User.user_ID = Comments.user_ID
            ORDER BY commentDate DESC";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(":post_ID", $post_ID);
?>
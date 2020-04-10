<?php
    // Get parameters from GET
    $post_ID = $_GET['post_id'];

    // Prepared SQL statement to return the post information and image
    $sql = "SELECT post_ID, userName, postDate, postTitle, postImage 
            FROM Post 
            INNER JOIN User ON User.user_ID = Post.user_ID 
            WHERE post_ID = :post_ID";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(":post_ID", $post_ID);
?>
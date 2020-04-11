<?php
    // Get parameters from POST
    $post_ID = $_GET['post_id'];

    // SQL query to return the total number of posts
    $sql = "SELECT COUNT(user_ID) AS posts
            FROM Post
            WHERE user_ID = (SELECT user_ID FROM Post WHERE post_ID = :post_ID)";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(":post_ID", $post_ID);

    // Execute prepared SQL statement
    $statement->execute();

    // Build class to store result set attributes
    class Posts{
        public $posts;
    }

    // Store the result set
    $posts = $statement->fetchObject('Posts');
?>
<?php
    // SQL query to return the total number of comments for all posts
    $sql = "SELECT COUNT(user_ID) AS comments
            FROM Comments";
            
    $statement = $pdo->prepare($sql);

    // Execute prepared SQL statement
    $statement->execute();

    // Build class to store result set attributes
    class Comments{
        public $comments;
    }

    // Store the result set
    $comments = $statement->fetchObject('Comments');
?>
<?php
    // SQL query to return the total number of posts
    $sql = "SELECT COUNT(user_ID) AS posts
            FROM Post";
            
    $statement = $pdo->prepare($sql);

    // Execute prepared SQL statement
    $statement->execute();

    // Build class to store result set attributes
    class Posts{
        public $posts;
    }

    // Store the result set
    $posts = $statement->fetchObject('Posts');
?>
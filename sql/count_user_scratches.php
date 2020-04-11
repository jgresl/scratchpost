<?php
    // SQL query to return the total number of comments for all posts
    $sql = "SELECT COUNT(user_ID) AS scratches
            FROM Scratches
            WHERE user_ID = (SELECT user_ID FROM Post WHERE post_ID = :post_ID)";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(":post_ID", $post_ID);

    // Execute prepared SQL statement
    $statement->execute();

    // Build class to store result set attributes
    class Scratches{
        public $scratches;
    }

    // Store the result set
    $scratches = $statement->fetchObject('Scratches');
?>
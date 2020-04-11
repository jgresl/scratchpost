<?php
    // Get parameters
    session_start();
    $user_ID = $_SESSION['user_id'];
    $post_ID = $_GET['post_id'];

    // SQL query to count how many times a user has scracthed a post (max 1)
    $sql = "SELECT COUNT(user_ID) AS isScratched
            FROM Scratches
            WHERE user_ID = :user_ID
            AND post_ID = :post_ID";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':user_ID', $user_ID);
    $statement->bindvalue(':post_ID', $post_ID);

    // Execute prepared SQL statement and store the result set
    $statement->execute();

    // Build class to store result set attributes
    class Post {
        public $isScratched;
    }
    
    // Execute prepared SQL statement and store the result set
    $post = $statement->fetchObject('Post');

    echo $user_ID;
    echo $post_ID;
    echo $post->isScratched;
    // Determine if the post has already been scratched
    if ($post->isScratched == 0) {

        // SQL statement to scratch a post
        $sql = "INSERT INTO Scratches (user_ID, post_ID)
                VALUES (:user_ID, :post_ID)";

        $statement = $pdo->prepare($sql);
        $statement->bindvalue(':user_ID', $user_ID);
        $statement->bindvalue(':post_ID', $post_ID);
    } else {

        // SQL statement to unscratch a post
        $sql = "DELETE FROM Scratches 
                WHERE user_ID = :user_ID 
                AND post_ID = :post_ID";

        $statement = $pdo->prepare($sql);
        $statement->bindvalue(':user_ID', $user_ID);
        $statement->bindvalue(':post_ID', $post_ID);
    }   
?>
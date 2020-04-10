<?php
    // Get parameters from POST
    $userName = $_SESSION['username'];

    // Prepared SQL statement to return all posts with the newest on top (for the logged in user)
    $sql = "SELECT User.user_ID, userName, post_ID, postDate, postTitle, postImage 
            FROM Post
            INNER JOIN User ON User.user_ID = Post.user_ID 
            WHERE userName = :userName 
            ORDER BY postDate DESC";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(":userName", $userName);
?>
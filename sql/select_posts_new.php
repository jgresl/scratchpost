<?php
    // Prepared SQL statement to return all posts with the newest on top
    $sql = "SELECT userName, post_ID, postDate, postTitle, postImage,
            (SELECT COUNT(user_ID) FROM Scratches WHERE Scratches.post_ID = Post.post_id) AS scratches,
            (SELECT COUNT(user_ID) FROM Comments WHERE Comments.post_ID = Post.post_id) AS comments
            FROM Post 
            INNER JOIN User ON User.user_id = Post.user_id 
            WHERE postStatus = 'Enabled' 
            ORDER BY postDate DESC";
            
    $statement = $pdo->prepare($sql);
?>
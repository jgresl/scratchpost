<?php
    // Prepared SQL statement to return all posts with the newest on top
    $sql = "SELECT userName, post_ID, postDate, postTitle, postImage 
            FROM Post 
            INNER JOIN User ON User.user_id = Post.user_id 
            WHERE postStatus = 'Disabled' 
            ORDER BY postDate DESC";
            
    $statement = $pdo->prepare($sql);
?>
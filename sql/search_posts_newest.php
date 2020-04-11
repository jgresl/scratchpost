<?php
    // Get search parameters from URL
    $search = $_GET['search'];

    // Prepared SQL statement to return all posts containing the search key with the newest on top
    $sql = "SELECT userName, post_ID, postDate, postTitle, postImage
            FROM Post 
            INNER JOIN User ON User.user_id = Post.user_id 
            WHERE postStatus = 'Enabled'
                AND postTitle LIKE CONCAT('%', :search, '%') 
                OR userName LIKE CONCAT('%', :search, '%')
            ORDER BY postDate DESC";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':search', $search);
?>
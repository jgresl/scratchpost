<?php
    // Initialize from and to variables for activity date range filter
    $from = '2020-01-01';
    if(isset($_GET['from'])) {
        $from = $_GET['from'];
    }

    $to = '2040-12-31';
    if(isset($_GET['to'])) {
        $to = $_GET['to'];
    }

    // Prepared SQL statement to return all activity
    $sql = "SELECT * FROM (
                SELECT postDate AS activityDateTime, LEFT(postDate, 10) AS activityDate, RIGHT(postDate, 8) AS activityTime, userName, 'created a post' AS activityType, post_ID AS activity_ID, postTitle
                FROM Post 
                INNER JOIN User ON User.user_id = Post.user_id

                UNION ALL

                SELECT scratchDate AS activityDateTime, LEFT(scratchDate, 10) AS activityDate, RIGHT(scratchDate, 8) AS activityTime, userName, 'scratched a post' AS activityType, Post.post_ID AS activity_ID, postTitle
                FROM Scratches
                INNER JOIN User ON User.user_ID = Scratches.user_ID
                INNER JOIN Post ON Post.post_ID = Scratches.post_ID

                UNION ALL

                SELECT userFirstLogin AS activityDateTime, LEFT(userFirstLogin, 10) AS activityDate, RIGHT(userFirstLogin, 8) AS activityTime, userName, 'registered for an account' AS activityType, user_ID AS activity_ID, '' AS postTitle
                FROM User

                UNION ALL

                SELECT commentDate AS activityDateTime, LEFT(commentDate, 10) AS activityDate, RIGHT(commentDate, 8) AS activityTime, userName, 'commented on a post' AS activityType, Post.post_ID AS activity_ID, postTitle
                FROM Comments
                INNER JOIN User ON User.user_ID = Comments.user_ID
                INNER JOIN Post ON Post.post_ID = Comments.post_ID

                ) Activity WHERE activityDate BETWEEN :from AND :to ORDER BY activityDateTime DESC";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':from', $from);
    $statement->bindvalue(':to', $to);
?>
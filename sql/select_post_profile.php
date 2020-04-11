<?php
    // Get parameters from GET
    $post_ID = $_GET['post_id'];

    // Prepared SQL statement to return all posts with the newest on top (for the logged in user)
    $sql = "SELECT user_ID, userName, userEmail, userFirstName, userLastName, userBirthdate, userImage
            FROM User 
            WHERE user_ID = (SELECT user_ID FROM Post WHERE post_ID = :post_ID)";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':post_ID', $post_ID);
?>
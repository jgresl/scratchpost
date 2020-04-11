<?php
    // Get parameters from POST
    $userName = $_SESSION['username'];

    // Prepared SQL statement to return all posts with the newest on top (for the logged in user)
    $sql = "SELECT user_ID, userName, userEmail, userFirstName, userLastName, userBirthdate, userImage
            FROM User 
            WHERE userName = :userName";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':userName', $userName);
?>
<?php
    // Get parameters from POST
    $user_ID = $_POST['user_id'];
    $userType = $_POST['user_type'];

    // SQL statement to insert new user
    $sql = "UPDATE User SET userType = :userType WHERE user_ID = :user_ID";
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':userType', $userType);
    $statement->bindvalue(':user_ID', $user_ID);
?>
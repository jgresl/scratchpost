<?php
    // Get parameters from POST
    $user_ID = $_POST['user_id'];
    $userStatus = $_POST['user_status'];

    // SQL statement to insert new user
    $sql = "UPDATE User SET userStatus = :userStatus WHERE user_ID = :user_ID";
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':userStatus', $userStatus);
    $statement->bindvalue(':user_ID', $user_ID);
?>
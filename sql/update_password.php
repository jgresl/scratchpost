<?php
    // Get parameters from POST
    $userName = $_SESSION['username'];
    $userPassword = $_POST['password2'];

    // SQL statement to update password
    $sql = "UPDATE User 
            SET userPassword = :userPassword 
            WHERE userName = :userName";
            
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':userPassword', $userPassword);
    $statement->bindvalue(':userName', $userName);
?>
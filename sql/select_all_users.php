<?php
    // SQL statement to return all users
    $sql = "SELECT user_ID, userName, userEmail, userStatus, userType, userFirstName, userLastName, userBirthdate, userFirstLogin, userLastLogin 
            FROM User";
            
    $statement = $pdo->prepare($sql);
?>
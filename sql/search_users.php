<?php
    // Get search parameters from URL
    $search = $_GET['search'];

    // SQL statement to search for a list of users
    $sql = "SELECT DISTINCT User.user_ID, userName, userEmail, userStatus, userType, userFirstName, userLastName, userBirthdate, userFirstLogin, userLastLogin 
            FROM User 
            INNER JOIN Post ON Post.user_ID = User.user_ID 
            WHERE userName LIKE CONCAT('%', :search, '%')
                OR userEmail LIKE CONCAT('%', :search, '%')
                OR userStatus LIKE CONCAT('%', :search, '%')
                OR userType LIKE CONCAT('%', :search, '%')
                OR userFirstName LIKE CONCAT('%', :search, '%')
                OR userLastName LIKE CONCAT('%', :search, '%')
                OR postTitle LIKE CONCAT('%', :search, '%')";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':search', $search);
?>
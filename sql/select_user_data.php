<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Get parameters from POST
        $userEmail = $_POST['email'];

        // SQL statement to return user account information using a provided email
        $sql = "SELECT user_ID, userName, userPassword, userStatus, userType, userEmail 
        FROM User 
        WHERE userEmail = :userEmail";

        $statement = $pdo->prepare($sql);
        $statement->bindvalue(':userEmail', $userEmail);

    } else if (isset($_SESSION['username'])) {

        // SQL statement to return user account information using the session username
        $sql = "SELECT user_ID, userName, userPassword, userStatus, userType, userEmail 
        FROM User 
        WHERE userNAME = :userName";

        $statement = $pdo->prepare($sql);
        $statement->bindvalue(':userEmail', $userEmail);
    }
?>
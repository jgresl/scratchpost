<?php
    // Prepared SQL statement to return the post information and image
    $sql = "SELECT COUNT(user_ID) AS members
            FROM User";
            
    $statement = $pdo->prepare($sql);

    // Execute prepared SQL statement and store the result set
    $statement->execute();

    // Build class to store result set attributes
    class Members{
        public $members;
    }

    // Execute prepared SQL statement and store the result set
    $members = $statement->fetchObject('Members');
?>
<?php
    // Get parameters from GET
    $user_ID = $_GET['user_id'];

    include 'db_connection.php';

    // Open the database connection
    try{
        $pdo = openConnection();
    } catch (PDOException $e){
        die($e->getMessage());
    }               

    // Prepared SQL statement to return the profile image from database BLOB
    $sql = "SELECT userImage FROM User WHERE user_ID = :user_ID";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':user_ID', $user_ID);

    // Execute prepared SQL statement and store the result set
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result) {
        // Output the MIME header
        header("Content-type: image/jpeg");

        // Output the image
        echo ($result['userImage']);
    }

    // Close the database connection
    closeConnection($pdo);
?>
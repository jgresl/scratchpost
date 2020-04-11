<?php
    // Get parameters from GET
    $post_ID = $_GET['post_id'];

    include 'db_connection.php';

    // Open the database connection
    try{
        $pdo = openConnection();
    } catch (PDOException $e){
        die($e->getMessage());
    }               

    // Prepared SQL statement to return the post image from database BLOB
    $sql = "SELECT postImage FROM Post WHERE post_ID = :post_ID";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':post_ID', $post_ID);

    // Execute prepared SQL statement and store the result set
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result) {
        // Output the MIME header
        header("Content-type: image/jpeg");

        // Output the image
        echo ($result['postImage']);
    }

    // Close the database connection
    closeConnection($pdo);
?>